<script setup>
import { computed } from 'vue'

const props = defineProps({
  icon: {
    type: String,
    default: 'roues',
  },
  label: {
    type: String,
    default: 'Mes projets',
  },
})

const iconSrc = computed(() => (props.icon ? `/img/competences/${props.icon}` : ''))

</script>

<template>
  <div class="competence">
    <div class="competence-frame">
      <span class="competence-image-wrapper">
        <img
          v-if="icon"
          :src="iconSrc"
          class="competence-image"
        />
      </span>
    </div>
    <div class="competence-label breadcrumb">{{ label }}</div>
  </div>
</template>

<style scoped>
@reference "#app.css";

.competence {
  @apply inline-flex flex-col size-20 rounded-lg border-none;
  @apply p-2 justify-center items-center gap-2;
  @apply bg-surface text-text;
  box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
  text-decoration: none;
}

.competence-frame {
  @apply size-10 relative overflow-hidden;
}

.competence-image-wrapper {
  @apply size-10 relative overflow-hidden shrink-0 flex items-center justify-center;
}

.competence-image {
  @apply w-full h-full object-contain;
}

.competence-label {
  @apply self-stretch text-center justify-start font-sans leading-3;
  @apply content-center;
}

</style>