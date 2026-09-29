<script setup>
    const props = defineProps({
        tag: {
            type: Object,
            default: () => ({}),
        },
        selected: {
            type: Boolean,
            default: false,
        },
    });

    const emit = defineEmits(['select']);
</script>

<template>
    <div 
        class="base-filtre" 
        :class="{ selected: props.selected }"
        @click="emit('select', props.tag)"
    >
        <div class="base-filtre-label breadcrumb">{{ props.tag.name }}</div>
    </div>
</template>

<style scoped>
    @reference "#app.css";

    .base-filtre {
        @apply inline-flex justify-center items-center gap-1;
        @apply w-27 px-2 py-1 rounded-[50px] ;
        @apply outline outline-1 outline-offset-[-1px] outline-tertiary;
    }

    .selected {
        @apply bg-tertiary font-bold ;
    }

    .selected>div{
        @apply dark:text-onTertiary;
    }

    .base-filtre-label {
        @apply text-center justify-center text-onTertiary dark:text-onSurface2;
        @apply w-26 leading-3;
    }
</style>
