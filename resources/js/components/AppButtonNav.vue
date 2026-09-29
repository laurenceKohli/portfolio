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
  type: {
    type: String,
    default: '',
  },
  href: {
    type: String,
    default: '/',
  },
})

const iconSrc = computed(() => (props.icon ? `/img/icons/${props.icon}.svg` : ''))
const iconStyle = computed(() => ({
  '--button-nav-icon-mask': `url('${iconSrc.value}')`,
}))

const buttonClass = computed(() => {
  return {
    'button-nav-surface': props.type !== 'primary',
    'button-nav-primary': props.type === 'primary',
  }
})
</script>

<template>
  <a :href="href" :data-type="type" class="button-nav" :class="buttonClass">
    <div class="button-nav-frame">
      <span class="button-nav-icon-wrapper">
        <span v-if="icon" class="button-nav-icon-image" :style="iconStyle" aria-hidden="true"></span>
      </span>
    </div>
    <div class="button-nav-label breadcrumb">{{ label }}</div>
  </a>
</template>

<style scoped>
@reference "#app.css";

.button-nav {
  @apply size-20 px-1.5 py-2 rounded-lg inline-flex flex-col justify-center items-center gap-1 border-none cursor-pointer;
  box-shadow: var(--shadow-box);
  text-decoration: none;
  background: none;
}

.button-nav-surface {
  @apply bg-surface text-text outline outline-1 outline-offset-[-1px] outline-primary;
}

.button-nav-primary {
  @apply bg-primary text-onPrimary;
}

.button-nav-frame {
  @apply size-10 relative overflow-hidden;
}

.button-nav-icon-wrapper {
  @apply size-10 relative overflow-hidden shrink-0 flex items-center justify-center;
}

.button-nav-icon-image {
  @apply size-full bg-current;
  mask: var(--button-nav-icon-mask) center / contain no-repeat;
  -webkit-mask: var(--button-nav-icon-mask) center / contain no-repeat;
}

.button-nav-label {
  @apply self-stretch text-center justify-start font-sans leading-3;
}

@media (min-width: 768px) {
  .button-nav {
    @apply w-44 h-14 p-2 flex-row justify-start items-center gap-2;
  }

  .button-nav-label {
    @apply text-sm content-center;
  }
}

</style>