<script setup>
    import ApplicationLogo from '@/components/ApplicationLogo.vue';
    import BaseNavLink from './BaseNavLink.vue';
    import { onMounted, ref } from 'vue'

    const isMobileMenuOpen = ref(false)

    const navLinks = [
        { icon: 'cv', href: '/', label: 'Accueil' },
        { icon: 'projects', href: '/projects', label: 'Mes projets' },
        { icon: 'skills', href: '/skills', label: 'Compétences' },
        { icon: 'cv', href: '/cv', label: 'CV' },
        { icon: 'contact', href: '/contact', label: 'Me contacter' },
    ]

    const toggleMobileMenu = () => {
        isMobileMenuOpen.value = !isMobileMenuOpen.value
    }

    const closeMobileMenu = () => {
        isMobileMenuOpen.value = false
    }

    const addActiveClass = (path) => {
        document
            .querySelectorAll(`nav a[href="/${path}"]`)
            .forEach((link) => link.querySelector('span')?.classList.add('active'))
    }

    onMounted(() => {
        const url = window.location.pathname.split('/')
        if (url.some((el) => el === 'home') || url.every((el) => el === '')) {
            addActiveClass('')
        }
        if (url.some((el) => el === 'projects')) {
            addActiveClass('projects')
        }
        if (url.some((el) => el === 'skills')) {
            addActiveClass('skills')
        }
        if (url.some((el) => el === 'contact')) {
            addActiveClass('contact')
        }
    })

</script>

<template>
    <nav class="the-nav box-shadow-sm">
        <div class="nav-content">
            <ApplicationLogo />

            <div class="desktop-links">
                <BaseNavLink
                    v-for="link in navLinks"
                    :key="`desktop-${link.href}`"
                    :icon="link.icon"
                    :href="link.href"
                >
                    {{ link.label }}
                </BaseNavLink>
            </div>

            <button
                type="button"
                class="mobile-menu-button"
                :aria-expanded="isMobileMenuOpen"
                aria-label="Ouvrir ou fermer le menu"
                @click="toggleMobileMenu"
            >
                <svg
                    v-if="!isMobileMenuOpen"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="mobile-menu-icon"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="mobile-menu-icon"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div v-if="isMobileMenuOpen" class="mobile-links">
            <BaseNavLink
                v-for="link in navLinks"
                :key="`mobile-${link.href}`"
                :icon="link.icon"
                :href="link.href"
                class="mobile-link"
                @click="closeMobileMenu"
            >
                {{ link.label }}
            </BaseNavLink>
        </div>
    </nav>
</template>

<style scoped>
    @reference "#app.css";

    .the-nav {
        @apply sticky top-4 z-50 w-full;
        @apply bg-surface dark:bg-surface p-3 mb-6;
        @apply rounded-lg shadow-box;
    }

    .nav-content {
        @apply flex items-center gap-4;
    }

    .desktop-links {
        @apply ml-auto hidden items-center gap-4 md:flex;
    }

    .mobile-menu-button {
        @apply ml-auto inline-flex items-center justify-center rounded-md p-2 md:hidden;
        @apply rounded-lg shadow-box;
    }

    .mobile-menu-icon {
        @apply size-6;
    }

    .mobile-links {
        @apply mt-3 flex flex-col gap-2 md:hidden;
    }

    .mobile-link {
        @apply w-full;
    }

</style>