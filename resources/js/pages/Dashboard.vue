<script setup>
    import { computed, ref } from 'vue'
    import { router, useForm, usePage, Link } from '@inertiajs/vue3'
    import { logout } from '@/routes';

    import TheNav from '@/components/TheNav.vue';
    import AppTitleWithIcon from '@/components/AppTitleWithIcon.vue';
    import AppButtonNav from '@/components/AppButtonNav.vue';
    import BaseButton from '@/components/BaseButton.vue';
    import BaseTextInput from '@/components/BaseTextInput.vue';
    import AppProjectLine from '@/components/AppProjectLine.vue';
    import BaseFiltre from '@/components/BaseFiltre.vue';

    const user = usePage().props.auth.user

    const form = useForm({
        id: user?.id,
        search: '',
    })

    const handleLogout = () => {
        router.flushAll();
    };

     const props = defineProps({
        projects: {
            type: Array,
            default: () => [],
        },
        tags: {
            type: Array,
            default:() => [],
        },
    });

    const filtersOpen = ref(false)
     const filterTags = computed(() => [
        { id: null, color: null, name: 'Tous' },
        ...props.tags,
    ]);

    const selectedTagId = ref(null)
    const filteredProjects = computed(() => {
        const query = form.search.trim().toLocaleLowerCase('fr')

        return props.projects.filter((project) => {
            const matchesTag = selectedTagId.value === null
                || project.tag_id === selectedTagId.value
                || project.tag?.id === selectedTagId.value
            const searchableText = [
                project.title,
                project.tag?.name,
                ...project.techs.map((tech) => tech.name),
            ].join(' ').toLocaleLowerCase('fr')

            return matchesTag && searchableText.includes(query)
        })
    })

</script>

<template>
    <TheNav/>

    <section id=settings-section>
        <AppTitleWithIcon icon="dashboard" color="primary" title="Mon <span>dashboard</span>"/>
        <div id="settings-buttons">
            <AppButtonNav icon="profile" label="Mon profil" href="/settings/profile"/>
            <Link
                :href="logout()"
                @click="handleLogout"
                as="button"
                data-test="logout-button"
            >
                    <AppButtonNav icon="lock" label="Déconnexion" type="primary"/>
            </Link>
        </div>
    </section>

    <section id=buttons-section>
        <div class="recherche">
            <BaseTextInput id="search-bar" v-model="form.search" placeholder="Rechercher un projet..."/>
        </div>
        <div class="filters">
            <BaseButton
                id="filter-button"
                label="Filtrer les projets"
                color="primary-line"
                size="full"
                :aria-expanded="filtersOpen"
                aria-controls="tag-filters"
                @click="filtersOpen = !filtersOpen"
            />
        </div>
         <div v-if="filtersOpen" id="tag-filters" role="group" aria-label="Filtrer par catégorie">
            <BaseFiltre
                v-for="tag in filterTags"
                :key="tag.id"
                :tag="tag"
                :selected="selectedTagId === tag.id"
                @select="selectedTagId = $event.id"
            />
        </div>
    </section>

    <section id="projects-section">
        <div class="projects-heading">
            <h2>Mes projets</h2>
            <BaseButton
                label="Nouveau projet"
                id="create-project-link"
                @click="router.visit('/projects/create')"
            />
        </div>
        <AppProjectLine v-for="project in filteredProjects"
            :key="project.id"
            :project="project"
        />
    </section>

</template>

<style scoped>
    @reference "#app.css";

    #settings-section{
        @apply flex flex-row justify-between items-start;
        @apply mb-24;
    } 

    #settings-buttons{
        @apply flex gap-2;
    }
    
    #buttons-section{
        @apply flex flex-row items-center gap-4;
        @apply mb-12;
    }

    #tag-filters {
        @apply flex flex-wrap gap-2 items-stretch;
    }

    h2{
        @apply text-left pb-2;
    }

    .projects-heading {
        @apply mb-3 flex flex-wrap items-center justify-between gap-3;
    }
</style>