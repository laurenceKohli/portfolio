<script setup>
const props = defineProps({
  label: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <div class="base-tech">
    <div class="tech-label">{{ label }}</div>
  </div>
</template>

<style scoped>
@reference "#app.css";

.base-tech {
  @apply rounded-[50px] bg-tertiary px-2 py-1 flex justify-center items-center gap-1.25;
}

.tech-label {
  @apply text-center text-2xs md:text-xs font-normal leading-3 text-onTertiary;
}
</style>
