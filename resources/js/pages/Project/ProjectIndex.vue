<script setup>
import { computed, ref } from 'vue';
import TheNav from '@/components/TheNav.vue';
import BaseFiltre from '@/components/BaseFiltre.vue';
import AppProjectCard from '@/components/AppProjectCard.vue';
import AppTitleWithIcon from '@/components/AppTitleWithIcon.vue';

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

    const selectedTagId = ref(null);

    const filterTags = computed(() => [
        { id: null, color: null, name: 'Tous' },
        ...props.tags,
    ]);

    const filteredProjects = computed(() => {
        if (selectedTagId.value === null) {
            return props.projects;
        }

        return props.projects.filter((project) => (
            project.tag_id === selectedTagId.value
            || project.tag?.id === selectedTagId.value
        ));
    });

    const selectTag = (tag) => {
        selectedTagId.value = tag.id;
    };

</script>

<template>
     <TheNav/>
    <AppTitleWithIcon 
            icon="projects"
            color="secondary"
            title="Mes <span>projets</span>"
    />

    <div id="filtres">
        <BaseFiltre
            v-for="tag in filterTags"
            :key="tag.id"
            :tag="tag"
            :selected="selectedTagId === tag.id"
            @select="selectTag"
        />
    </div>

    <div id="projects">
        <AppProjectCard
            v-for="project in filteredProjects"
            :key="project.id"
            :project="project"
            />
    </div>

</template>

<style scoped>
    @reference "#app.css";

    #filtres {
        @apply flex flex-wrap gap-2 mt-6;
    }

    #projects{
        @apply flex flex-wrap gap-6 mt-6;
    }
</style>