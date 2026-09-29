<script setup>
import { computed } from 'vue'

const props = defineProps({
  label: {
    type: String
  },
  color: {
    type: String,
    default: 'primary'
  },
  size: {
    type: String,
    default: 'button',
  },
  icon: {
    type: String,
    default: null,
  },
})

const iconSrc = computed(() => {
  if (!props.icon) {
    return ''
  }

  if (props.icon.includes('/') || props.icon.endsWith('.svg')) {
    return props.icon
  }

  return ''
})

const hasImageIcon = computed(() => iconSrc.value !== '')

const buttonClass = computed(() => {
  return {
    'button-primary': props.color === 'primary',
    'button-secondary': props.color === 'secondary',
    'button-primary-line': props.color === 'primary-line',
    'button-secondary-line': props.color === 'secondary-line',
    'button-icon': props.size === 'icon',
    'button-full':props.size === 'full',
  }
})
</script>

<template>
  <button :data-color="color" :data-size="size" class="base-button" :class="buttonClass">
    <template v-if="label">
      <span class="button-label">{{ label }}</span>
    </template>
    <template v-if="icon">
      <span v-if="size === 'icon'" class="button-icon-box" aria-hidden="true">
        <span v-if="hasImageIcon" class="button-icon-image" :style="{ '--button-icon-mask': `url('${iconSrc}')` }" />
        <span v-else class="button-icon-text">{{ icon }}</span>
      </span>
      <template v-else>
        <span v-if="hasImageIcon" class="button-icon-image" :style="{ '--button-icon-mask': `url('${iconSrc}')` }" aria-hidden="true" />
        <span v-else class="button-icon-text" aria-hidden="true">{{ icon }}</span>
      </template>
    </template>
  </button>
</template>

<style scoped>
@reference "#app.css";

.base-button {
  @apply w-36 px-1.25 py-2 rounded-[50px] flex justify-center items-center gap-1.25 border-none cursor-pointer;
}

.button-icon {
  @apply size-7 px-1.5 py-2 bg-surface rounded-lg shadow-[0px_4px_4px_0px_rgba(155,35,128,0.25)] outline outline-1 outline-offset-[-1px] outline-primary inline-flex flex-col justify-center items-center gap-1;
}

.button-full {
  width: fit-content;
  @apply px-4 py-2;
}

.button-label {
  @apply flex-1 text-center text-base font-normal leading-6;
  font-family: 'Yatra One', cursive;
}

.button-primary {
  @apply bg-primary text-onPrimary;
}

.button-secondary {
  @apply bg-secondary text-OnSecondary;
}
.button-primary-line {
  @apply outline-solid outline-2 -outline-offset-2 outline-primary;
}

.button-secondary-line {
  @apply outline-solid outline-2 -outline-offset-2 outline-secondary;
}


.button-icon-image {
  @apply w-4 h-4 bg-current;
  mask: var(--button-icon-mask) center / contain no-repeat;
  -webkit-mask: var(--button-icon-mask) center / contain no-repeat;
}

.button-icon-box {
  @apply size-3.5 flex items-center justify-center;
}

.button-icon-text {
  @apply text-current text-base font-bold leading-none;
}
</style>