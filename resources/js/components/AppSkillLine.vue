<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'
import BaseButton from './BaseButton.vue'

const props = defineProps({
  skill: {
    type: Object,
    required: true,
  },
  estVide : {
    type : String,
    default : 'Aucun projet associé',
  }
})

const page = usePage()
const editSkill = () => router.visit(`/dashboard/skills/${props.skill.id}/edit`)
</script>

<template>
  <div class="skill-line">
    <img class="skill-logo" :src="`/img/competences/${props.skill.logo_path}`" :alt="`Logo ${props.skill.name}`" />
    <div class="skill-info">
      <p class="skill-name">{{ props.skill.name }}</p>
      <p class="skill-category">{{ props.skill.category?.name ?? 'Sans catégorie' }}</p>
      <div v-if="props.skill.projects?.length" class="skill-projects">
        <span>Projets :</span>
        <Link v-for="project in props.skill.projects" :key="project.id" :href="`/projects/${project.id}`">
          {{ project.title }}
        </Link>
      </div>
      <p v-else class="skill-projects">{{ props.estVide }}</p>
    </div>
    <span v-if="page.props.auth?.user && props.skill.on_home_page" class="home-badge">Accueil</span>
    <BaseButton v-if="page.props.auth?.user" label="Modifier" color="primary-line" @click="editSkill" />
  </div>
</template>

<style scoped>
@reference "#app.css";

.skill-line {
  @apply flex flex-wrap items-center gap-3 border-b-2 border-tertiary py-3;
}

.skill-logo {
  @apply size-10 shrink-0 object-contain;
}

.skill-info {
  @apply min-w-0 flex-1;
}

.skill-name {
  @apply font-semibold text-text;
}

.skill-category {
  @apply text-xs text-onSurface2;
}

.skill-projects {
  @apply mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-onSurface2;
}

.skill-projects a {
  @apply text-primary underline underline-offset-2;
}

.home-badge {
  @apply rounded-full bg-primary px-3 py-1 text-xs text-onPrimary;
}
</style>