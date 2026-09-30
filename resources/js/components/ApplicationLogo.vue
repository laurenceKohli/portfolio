<script setup>
import useDarkMode from '@/composables/darkMode'

const { isDarkMode } = useDarkMode()
</script>

<template>
    <img
        v-if="isDarkMode"
        src="/img/logo/Logo_RGB_grand-dark.png"
        alt="Logo de lkohli"
        @click="$inertia.visit('/')"
    />
    <img
        v-else
        src="/img/logo/Logo_RGB_grand-light.png"
        alt="Logo de lkohli"
        @click="$inertia.visit('/')"
    />
</template>

<style scoped>
img {
    width: 5rem;
    height: auto;
}
</style>