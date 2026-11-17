<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import BaseButton from './BaseButton.vue'
import BaseTech from './BaseTech.vue'

const props = defineProps({
  project: {
        type: Object,
        default: () => {},
    },
  detailsLabel: {
    type: String,
    default: 'En savoir plus',
  },
  detailsLabelColor: {
    type: String,
    default: 'secondary',
  },
  demoLabel: {
    type: String,
    default: 'Démo',
  },
  demoLabelColor: {
    type: String,
    default: 'secondary-line',
  },
})

const img = ref()
if (props.project.imgs) {
    img.value = props.project.imgs[0].img_path
} else {
    img.value = "VaudSentiers-1"
}

const openDemo = () => window.open(props.project.url, '_blank', 'noopener,noreferrer')
const openProject = () => router.visit(`/projects/${props.project.id}`)

</script>

<template>
  <div class="project-card" role="link" tabindex="0" :aria-label="`Voir le projet ${props.project.title}`" @click="openProject" @keydown.enter.self="openProject">
    <img class="project-image" :src="`/img/projects/${img}`" />
    <div class="project-content">
      <div class="project-text-block">
        <div class="project-title">
          {{ props.project.title }}
        </div>
        <div class="project-description" v-html="props.project.desc">
        </div>
      </div>
      <div class="project-techs">
        <BaseTech v-for="(tech, index) in props.project.techs.slice(0, 5)" :key="`${tech}-${index}`" :label="tech.name" />
      </div>
      <div class="project-actions">
        <BaseButton @click.stop="openProject" :label="props.detailsLabel" :color="props.detailsLabelColor" />
        <BaseButton v-if="props.project.url" @click.stop="openDemo" :label="props.demoLabel" :color="props.demoLabelColor" />
      </div>
    </div>
  </div>
</template>

<style scoped>
  @reference "#app.css";

  .project-card {
    @apply w-96 inline-flex flex-col justify-start items-start overflow-hidden rounded-lg cursor-pointer;
    box-shadow: var(--shadow-box);
  }

  .project-image {
    @apply h-52 self-stretch;
  }

  .project-content {
    @apply self-stretch bg-surface p-6 flex flex-col justify-start items-start gap-4;
  }

  .project-text-block {
    @apply w-full flex flex-col justify-start items-start gap-2;
  }

  .project-title {
    @apply w-full text-center text-base font-semibold leading-6;
  }

  .project-description {
    @apply w-full text-xs font-normal leading-4 text-onSurface2;
  }

  .project-description :deep(*) {
    font-size: inherit !important;
    line-height: inherit;
  }

  .project-description :deep(> p) {
    @apply pb-1;
  }

  .project-techs {
    @apply inline-flex justify-start items-start gap-2;
  }

  .project-actions {
    @apply self-stretch inline-flex justify-start items-start gap-2;
  }

</style>