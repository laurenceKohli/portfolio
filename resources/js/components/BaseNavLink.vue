<script setup>
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/vue3'

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

    const iconStyle = computed(() => ({
        '--nav-icon-mask': `url('/img/icons/${props.icon}.svg')`,
    }))
    const page = usePage()
    const isActive = computed(() => {
        const currentPath = page.url.split('?')[0].replace(/\/$/, '') || '/'
        const targetPath = props.href.replace(/\/$/, '') || '/'

        return targetPath === '/'
            ? currentPath === '/'
            : currentPath === targetPath || currentPath.startsWith(`${targetPath}/`)
    })
</script>

<template>
    <a :href="href" class="inline-flex items-center gap-1">
        <span class="w-10 h-8 relative overflow-hidden shrink-0 flex items-center justify-center">
            <span v-if="icon" class="nav-link-icon" :style="iconStyle" aria-hidden="true"></span>
        </span>
        <span class="nav-link-label text-center justify-start text-base font-normal leading-6" :class="{ active: isActive }">
            <slot />
        </span>
    </a>
</template>

<style scoped>
    @reference "#app.css";

    .active {
        @apply text-primary;
    }

    .nav-link-icon {
        @apply size-full bg-primary;
        mask: var(--nav-icon-mask) center / contain no-repeat;
        -webkit-mask: var(--nav-icon-mask) center / contain no-repeat;
    }
</style>