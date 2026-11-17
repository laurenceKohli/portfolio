<script setup>
import { useForm } from '@inertiajs/vue3'
import TheNav from '@/components/TheNav.vue'

const props = defineProps({
  tech: {
    type: Object,
    required: true,
  },
  categories: {
    type: Array,
    default: () => [],
  },
  projects: {
    type: Array,
    default: () => [],
  },
})

const form = useForm({
  name: props.tech.name,
  category_id: props.tech.category_id,
  on_home_page: Boolean(props.tech.on_home_page),
  logo_file: null,
  project_ids: props.tech.projects.map((project) => project.id),
})

const submit = () => form.put(`/dashboard/skills/${props.tech.id}`, { forceFormData: true })
</script>

<template>
  <TheNav />
  <main class="skill-edit">
    <h1>Modifier une compétence</h1>

    <form @submit.prevent="submit">
      <label>
        Nom
        <input v-model="form.name" type="text" required />
        <span v-if="form.errors.name" class="error">{{ form.errors.name }}</span>
      </label>

      <label>
        Catégorie
        <select v-model="form.category_id" required>
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
        <span v-if="form.errors.category_id" class="error">{{ form.errors.category_id }}</span>
      </label>

      <div class="logo-field">
        <span>Logo actuel</span>
        <img :src="`/img/competences/${props.tech.logo_path}`" :alt="`Logo ${props.tech.name}`" />
      </div>

      <label>
        Remplacer le logo (facultatif)
        <input type="file" accept="image/png,image/jpeg,image/webp" @input="form.logo_file = $event.target.files[0] ?? null" />
        <span v-if="form.errors.logo_file" class="error">{{ form.errors.logo_file }}</span>
      </label>

      <label>
        Projets utilisant cette compétence
        <select v-model="form.project_ids" multiple size="6">
          <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.title }}</option>
        </select>
        <span v-if="form.errors.project_ids" class="error">{{ form.errors.project_ids }}</span>
      </label>

      <label class="checkbox-label">
        <input v-model="form.on_home_page" type="checkbox" />
        Afficher sur la page d’accueil
      </label>

      <div class="form-actions">
        <a href="/dashboard">Retour au dashboard</a>
        <button type="submit" :disabled="form.processing">
          {{ form.processing ? 'Enregistrement...' : 'Enregistrer les modifications' }}
        </button>
      </div>
    </form>
  </main>
</template>

<style scoped>
@reference "#app.css";

.skill-edit {
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
select {
  @apply w-full rounded-md border border-text bg-surface p-2 text-base;
}

.checkbox-label {
  @apply flex items-center gap-2;
}

.logo-field {
  @apply flex items-center gap-4 text-sm font-medium;
}

.logo-field img {
  @apply size-12 object-contain;
}

.form-actions {
  @apply flex flex-wrap items-center justify-between gap-3;
}

.form-actions a {
  @apply text-primary underline;
}

.form-actions button {
  @apply rounded-md bg-primary px-4 py-2 text-sm text-onPrimary disabled:opacity-50;
}

.error {
  @apply text-sm text-red-600;
}
</style>