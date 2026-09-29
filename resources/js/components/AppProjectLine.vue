<script setup>
    import { Link, router, usePage } from '@inertiajs/vue3'
    import BaseButton from './BaseButton.vue'
    import BaseTech from './BaseTech.vue'

    const props = defineProps({
        project: {
            type: Object,
            default: () => {},
        },
    })

    const page = usePage()

    const editProject = () => router.visit(`/projects/${props.project.id}/edit`)
    const deleteProject = () => {
        if (window.confirm(`Supprimer le projet « ${props.project.title} » ?`)) {
            router.delete(`/projects/${props.project.id}`)
        }
    }
</script>

<template>
    <div
        :id="`project-${props.project.id}`"
        class="project-line"
    >
        <Link class="project-content" :href="`/projects/${props.project.id}`">
            <p class="project-title"> {{ props.project.title }}</p>
            <p class="project-tag">{{props.project.tag.name}}</p>
            <div class="project-techs">
                <BaseTech v-for="(tech, index) in props.project.techs" :key="`${tech}-${index}`" :label="tech.name" />
            </div>
        </Link>
        <BaseButton
            v-if="page.props.auth?.user"
            label="Modifier"
            color="primary-line"
            @click.stop="editProject"
        />
        <BaseButton
            v-if="page.props.auth?.user"
            label="Supprimer"
            color="secondary-line"
            @click.stop="deleteProject"
        />
    </div>
</template>

<style scoped>
    @reference "#app.css";

    .project-line {
        @apply flex flex-row items-center gap-4;
        @apply border-b-2 divide-solid border-tertiary;
        @apply py-2;
    }

    .project-content{
        @apply flex flex-row items-center justify-between gap-4;
    }

    .project-title{
        @apply font-bold text-primary text-2xl;
    }

    .project-tag {
        @apply text-xs text-onSurface2;
    }

    .project-techs {
        @apply inline-flex justify-start items-start gap-2;
    }
</style>
