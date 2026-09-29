<script setup>
    import ApplicationLogo from '@/components/ApplicationLogo.vue';
    import BaseNavLink from './BaseNavLink.vue';
    import { onMounted, onUnmounted, ref } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { Moon, Sun } from 'lucide-vue-next'
    import useDarkMode from '@/composables/darkMode'

    const isMobileMenuOpen = ref(false)
    const { isDarkMode, toggleDarkMode } = useDarkMode()
    const navElement = ref(null)
    const navHeight = ref(88)
    let navResizeObserver

    const updateNavHeight = () => {
        if (!navElement.value) {
            return
        }

        const styles = window.getComputedStyle(navElement.value)
        navHeight.value = navElement.value.offsetHeight + Number.parseFloat(styles.marginBottom)
    }

    onMounted(() => {
        updateNavHeight()
        navResizeObserver = new ResizeObserver(updateNavHeight)
        navResizeObserver.observe(navElement.value)
    })

    onUnmounted(() => navResizeObserver?.disconnect())

    const navLinks = [
        { icon: 'home', href: '/', label: 'Accueil' },
        { icon: 'projects', href: '/projects', label: 'Mes projets' },
        { icon: 'contact', href: '/contact', label: 'Me contacter' },
    ]

    const toggleMobileMenu = () => {
        isMobileMenuOpen.value = !isMobileMenuOpen.value
    }

    const closeMobileMenu = () => {
        isMobileMenuOpen.value = false
    }

    const user = usePage().props.auth.user
    const isUserLoggedIn = user && Object.keys(user).length > 0

</script>

<template>
    <div class="nav-space" :style="{ height: `${navHeight}px` }" aria-hidden="true"></div>
    <nav ref="navElement" class="the-nav box-shadow-sm">
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
                <BaseNavLink v-if="isUserLoggedIn" icon="dashboard" href="/dashboard">
                    Dashboard
                </BaseNavLink>
            </div>

            <button
                type="button"
                class="theme-toggle"
                :aria-label="isDarkMode ? 'Activer le thème clair' : 'Activer le thème sombre'"
                :title="isDarkMode ? 'Activer le thème clair' : 'Activer le thème sombre'"
                @click="toggleDarkMode"
            >
                <Sun v-if="isDarkMode" aria-hidden="true" />
                <Moon v-else aria-hidden="true" />
            </button>

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
        @apply fixed left-1/2 top-0 z-50 -translate-x-1/2;
        @apply bg-surface dark:bg-surface p-3 mb-6;
        @apply rounded-lg;
        box-shadow: var(--shadow-box);
        width: calc(100% - 2rem);
        max-width: 80rem;
    }

    .nav-content {
        @apply flex items-center gap-4;
    }

    .desktop-links {
        @apply ml-auto hidden items-center gap-6 md:flex;
    }

    .mobile-menu-button {
        @apply ml-auto inline-flex items-center justify-center rounded-md p-2 md:hidden;
        @apply rounded-lg;
        box-shadow: var(--shadow-box);
    }

    .theme-toggle {
        @apply inline-flex size-10 shrink-0 items-center justify-center rounded-lg text-text;
        box-shadow: var(--shadow-box);
    }

    .theme-toggle :deep(svg) {
        @apply size-5;
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