<script setup>
    import { useForm } from '@inertiajs/vue3'
    import TheNav from '@/components/TheNav.vue'

    const props = defineProps(['tags', 'techs'])

    const form = useForm({
        tag_id: props.tags[0]?.id ?? '',
        title: '',
        date: new Date().toISOString().slice(0, 10),
        duration: '',
        url: '',
        goals: '',
        desc: '',
        team: '',
        contribution: '',
        proud: '',
        on_home_page: false,
        tech_ids: [],
        new_techs: [],
        exps: [],
        imgs: [],
    })

    const addNewTech = () => form.new_techs.push({ name: '', logo_file: null })
    const removeNewTech = (index) => form.new_techs.splice(index, 1)
    const addExp = () => form.exps.push({ name: '' })
    const removeExp = (index) => form.exps.splice(index, 1)
    const addImg = () => form.imgs.push({ file: null, desc: '' })
    const removeImg = (index) => form.imgs.splice(index, 1)

    const setFile = (items, index, field, event) => {
        items[index][field] = event.target.files[0] ?? null
    }

    const submit = () => form.post('/projects')
</script>

<template>
    <TheNav />

    <main class="project-create">
        <h1>Créer un projet</h1>

        <form @submit.prevent="submit">
            <label>
                Catégorie *
                <select v-model="form.tag_id" required>
                    <option disabled value="">Choisir une catégorie</option>
                    <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
                </select>
                <span v-if="form.errors.tag_id" class="error">{{ form.errors.tag_id }}</span>
            </label>

            <label>
                Titre *
                <input v-model="form.title" type="text" required />
                <span v-if="form.errors.title" class="error">{{ form.errors.title }}</span>
            </label>

            <div class="field-row">
                <label>
                    Date *
                    <input v-model="form.date" type="date" required />
                    <span v-if="form.errors.date" class="error">{{ form.errors.date }}</span>
                </label>
                <label>
                    Durée
                    <input v-model="form.duration" type="text" />
                    <span v-if="form.errors.duration" class="error">{{ form.errors.duration }}</span>
                </label>
            </div>

            <label>
                URL du projet
                <input v-model="form.url" type="url" />
                <span v-if="form.errors.url" class="error">{{ form.errors.url }}</span>
            </label>

            <label>
                Objectifs *
                <textarea v-model="form.goals" rows="4" required />
                <span v-if="form.errors.goals" class="error">{{ form.errors.goals }}</span>
            </label>

            <label>
                Description *
                <textarea v-model="form.desc" rows="6" required />
                <span v-if="form.errors.desc" class="error">{{ form.errors.desc }}</span>
            </label>

            <label>
                Équipe
                <textarea v-model="form.team" rows="3" />
                <span v-if="form.errors.team" class="error">{{ form.errors.team }}</span>
            </label>

            <label>
                Contribution *
                <textarea v-model="form.contribution" rows="5" required />
                <span v-if="form.errors.contribution" class="error">{{ form.errors.contribution }}</span>
            </label>

            <label>
                Ma plus grande fierté
                <textarea v-model="form.proud" rows="4" />
                <span v-if="form.errors.proud" class="error">{{ form.errors.proud }}</span>
            </label>

            <label class="checkbox-label">
                <input v-model="form.on_home_page" type="checkbox" />
                Afficher sur la page d’accueil
            </label>

            <section class="related-section">
                <div class="section-heading">
                    <h2>Technologies</h2>
                    <button type="button" class="add-button" @click="addNewTech">Créer une technologie</button>
                </div>
                <label>
                    Technologies existantes
                    <select v-model="form.tech_ids" multiple size="5">
                        <option v-for="tech in techs" :key="tech.id" :value="tech.id">{{ tech.name }}</option>
                    </select>
                    <span v-if="form.errors.tech_ids" class="error">{{ form.errors.tech_ids }}</span>
                </label>
                <div v-for="(tech, index) in form.new_techs" :key="index" class="related-row">
                    <label>
                        Nouvelle technologie *
                        <input v-model="tech.name" type="text" required />
                        <span v-if="form.errors[`new_techs.${index}.name` ]" class="error">{{ form.errors[`new_techs.${index}.name`] }}</span>
                    </label>
                    <label>
                        Logo *
                        <input type="file" accept="image/png,image/jpeg,image/webp" required @change="setFile(form.new_techs, index, 'logo_file', $event)" />
                        <span v-if="form.errors[`new_techs.${index}.logo_file` ]" class="error">{{ form.errors[`new_techs.${index}.logo_file`] }}</span>
                    </label>
                    <button type="button" class="remove-button" aria-label="Retirer cette technologie" @click="removeNewTech(index)">Retirer</button>
                </div>
            </section>

            <section class="related-section">
                <div class="section-heading">
                    <h2>Expériences et compétences</h2>
                    <button type="button" class="add-button" @click="addExp">Ajouter une expérience</button>
                </div>
                <div v-for="(exp, index) in form.exps" :key="index" class="related-row">
                    <label>
                        Nom *
                        <input v-model="exp.name" type="text" required />
                        <span v-if="form.errors[`exps.${index}.name` ]" class="error">{{ form.errors[`exps.${index}.name`] }}</span>
                    </label>
                    <button type="button" class="remove-button" aria-label="Retirer cette expérience" @click="removeExp(index)">Retirer</button>
                </div>
            </section>

            <section class="related-section">
                <div class="section-heading">
                    <h2>Images</h2>
                    <button type="button" class="add-button" @click="addImg">Ajouter une image</button>
                </div>
                <div v-for="(img, index) in form.imgs" :key="index" class="related-row">
                    <label>
                        Fichier image *
                        <input type="file" accept="image/png,image/jpeg,image/webp" required @change="setFile(form.imgs, index, 'file', $event)" />
                        <span v-if="form.errors[`imgs.${index}.file` ]" class="error">{{ form.errors[`imgs.${index}.file`] }}</span>
                    </label>
                    <label>
                        Description de l’image
                        <input v-model="img.desc" type="text" />
                        <span v-if="form.errors[`imgs.${index}.desc` ]" class="error">{{ form.errors[`imgs.${index}.desc`] }}</span>
                    </label>
                    <button type="button" class="remove-button" aria-label="Retirer cette image" @click="removeImg(index)">Retirer</button>
                </div>
            </section>

            <span v-if="form.errors.on_home_page" class="error">{{ form.errors.on_home_page }}</span>
            <button class="submit-button" type="submit" :disabled="form.processing">
                {{ form.processing ? 'Création...' : 'Créer le projet' }}
            </button>
        </form>
    </main>
</template>

<style scoped>
    @reference "#app.css";

    .project-create {
        @apply mx-auto w-full max-w-3xl;
    }

    h1 {
        @apply mb-6 text-left text-3xl font-bold;
    }

    form {
        @apply grid gap-4;
    }

    label {
        @apply grid gap-1 text-sm font-medium;
    }

    input:not([type='checkbox']),
    select,
    textarea {
        @apply w-full rounded-md border border-text bg-surface p-2 text-base;
    }

    input[type='file'] {
        @apply cursor-pointer;
    }

    textarea {
        @apply resize-y;
    }

    .field-row,
    .related-row {
        @apply grid gap-3 md:grid-cols-2;
    }

    .checkbox-label {
        @apply flex items-center gap-2;
    }

    .related-section {
        @apply grid gap-3 border-t border-text/30 pt-4;
    }

    .section-heading {
        @apply flex flex-wrap items-center justify-between gap-2;
    }

    h2 {
        @apply text-left text-lg font-bold;
    }

    .add-button,
    .remove-button {
        @apply w-fit rounded-md border border-primary px-3 py-2 text-sm;
    }

    .remove-button {
        @apply self-end;
    }

    .error {
        @apply text-sm text-red-700;
    }

    .submit-button {
        @apply w-fit rounded-md bg-primary px-4 py-2 text-onPrimary disabled:opacity-60;
    }
</style>