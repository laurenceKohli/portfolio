<script setup>

const props = defineProps({
    icon: {
        type: String,
        default: '',
    },
    color: {
        type: String,
        default: 'primary',
    },
    title: {
        type: String,
        default: '',
    },
})

</script>

<template>
    <h1>
        <span
            class="title-content"
            :style="{ '--title-color': `var(--color-${props.color})` }"
            v-html="title"
        ></span>
        <span
            class="app-icon-in-title"
            role="img"
            :aria-label="icon"
            :style="{
                '--icon-color': `var(--color-${props.color})`,
                '--icon-mask': `url('/img/icons/${icon}.svg')`,
            }"
        ></span>
        
    </h1>
</template>

<style scoped>
    @reference "#app.css";

    h1 {
        @apply flex items-center md:justify-center gap-3;
    }

    .title-content {
        @apply inline-block;
    }

    .app-icon-in-title {
        @apply inline-block size-10 shrink-0 bg-primary;
        background-color: var(--icon-color);
        mask: var(--icon-mask) center / contain no-repeat;
        -webkit-mask: var(--icon-mask) center / contain no-repeat;
    }

    .title-content :deep(> span) {
        color: var(--title-color);
    }
</style>
