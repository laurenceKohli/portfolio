<script setup>
    import { computed } from 'vue'

    const props = defineProps({
        icon: {
            type: String,
            default: '',
        },
        href: {
            type: String,
            default: '',
        },
    })

    const iconSrc = computed(() => (props.icon ? `/img/icons/${props.icon}.svg` : ''))
</script>

<template>
    <a :href="href" class="inline-flex items-center gap-2">
        <span class="w-10 h-8 relative overflow-hidden shrink-0 flex items-center justify-center">
            <img
                v-if="icon"
                :src="iconSrc"
                :alt="`Icone ${icon}`"
                class="w-full h-full object-contain"
            />
        </span>
        <span class="text-center justify-start text-base font-normal leading-6">
            <slot />
        </span>
    </a>
</template>

<style scoped>

</style>