<script setup>
    import { useForm } from '@inertiajs/vue3'
    import TheNav from '@/components/TheNav.vue'

    const props = defineProps({
        project: {
            type: Object,
            required: true,
        },
        tags: {
            type: Array,
            default: () => [],
        },
    })

    const form = useForm({
        tag_id: props.project.tag_id,
        title: props.project.title,
        date: String(props.project.date).slice(0, 10),
        duration: props.project.duration ?? '',
        url: props.project.url ?? '',
        goals: props.project.goals,
        desc: props.project.desc,
        team: props.project.team ?? '',
        contribution: props.project.contribution,
        proud: props.project.proud ?? '',
        on_home_page: Boolean(props.project.on_home_page),
    })

    const submit = () => form.put(`/projects/${props.project.id}`)
</script>

<template>
    <TheNav />

    <main class="project-edit">
        <h1>Modifier le projet</h1>

        <form @submit.prevent="submit">
            <label>
                Catégorie
                <select v-model="form.tag_id" required>
                    <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
                </select>
                <span v-if="form.errors.tag_id" class="error">{{ form.errors.tag_id }}</span>
            </label>

            <label>
                Titre
                <input v-model="form.title" type="text" required />
                <span v-if="form.errors.title" class="error">{{ form.errors.title }}</span>
            </label>

            <label>
                Date
                <input v-model="form.date" type="date" required />
                <span v-if="form.errors.date" class="error">{{ form.errors.date }}</span>
            </label>

            <label>
                Durée
                <input v-model="form.duration" type="text" />
                <span v-if="form.errors.duration" class="error">{{ form.errors.duration }}</span>
            </label>

            <label>
                URL du projet
                <input v-model="form.url" type="url" />
                <span v-if="form.errors.url" class="error">{{ form.errors.url }}</span>
            </label>

            <label>
                Objectifs
                <textarea v-model="form.goals" rows="4" required />
                <span v-if="form.errors.goals" class="error">{{ form.errors.goals }}</span>
            </label>

            <label>
                Description
                <textarea v-model="form.desc" rows="6" required />
                <span v-if="form.errors.desc" class="error">{{ form.errors.desc }}</span>
            </label>

            <label>
                Équipe
                <textarea v-model="form.team" rows="3" />
                <span v-if="form.errors.team" class="error">{{ form.errors.team }}</span>
            </label>

            <label>
                Contribution
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

            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Enregistrement...' : 'Enregistrer les modifications' }}
            </button>
        </form>
    </main>
</template>

<style scoped>
    @reference "#app.css";

    .project-edit {
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

    textarea {
        @apply resize-y;
    }

    .checkbox-label {
        @apply flex items-center gap-2;
    }

    .error {
        @apply text-sm text-red-700;
    }

    button[type='submit'] {
        @apply w-fit rounded-md bg-primary px-4 py-2 text-onPrimary disabled:opacity-60;
    }
</style>