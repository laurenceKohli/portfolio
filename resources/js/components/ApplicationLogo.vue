<script setup>
const isDarkMode = JSON.parse(localStorage.getItem('darkMode'))
</script>

<template>
    <img
        v-if="isDarkMode"
        src="/img/logo/Logo_RGB_Blanc_grand.png"
        alt="Logo de lkohli"
        @click="$inertia.visit('/')"
    />
    <img
        v-else
        src="/img/logo/Logo_RGB_grand.png"
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