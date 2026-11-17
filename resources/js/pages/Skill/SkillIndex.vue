<script setup>
import { computed, ref } from 'vue';
import AppSkillLine from '@/components/AppSkillLine.vue';
import BaseFiltre from '@/components/BaseFiltre.vue';
import TheNav from '@/components/TheNav.vue';
import AppTitleWithIcon from '@/components/AppTitleWithIcon.vue';

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
    skills: {
        type: Array,
        default: () => [],
    },
});

const selectedCategoryId = ref(null);

const filterCategories = computed(() => [
    { id: null, name: 'Toutes' },
    ...props.categories,
]);

const filteredSkills = computed(() => {
    if (selectedCategoryId.value === null) {
        return props.skills;
    }

    return props.skills.filter((skill) => skill.category_id === selectedCategoryId.value);
});

const selectCategory = (category) => {
    selectedCategoryId.value = category.id;
};

</script>

<template>
    <TheNav />
    <AppTitleWithIcon
        icon="skills"
        color="primary"
        title="Mes <span>compétences</span>"
    />

    <div id="intro-section">
        <p>Je me vois comme un <span id="couteau-suisse">couteau suisse digital</span> : polyvalente, créative et technique à la fois.</p>
        <p>De l'idée à la réalisation, j'imagine, conçois et donne vie à des projets numériques en jonglant entre design, développement web, communication et gestion de projet. Je sais aussi bien créer une identité visuelle, développer une expérience interactive, vulgariser un concept complexe que planifier une production.</p>
        <p>Je crée des ponts entre technologie, créativité et besoins humains pour transformer des idées en expériences concrètes.</p>
    </div>

    <div id="filtres">
        <BaseFiltre
            v-for="category in filterCategories"
            :key="category.id ?? 'all'"
            :tag="category"
            :selected="selectedCategoryId === category.id"
            @select="selectCategory"
        />
    </div>

    <main class="skills-list">
        <AppSkillLine
            v-for="skill in filteredSkills"
            :key="skill.id"
            :skill="skill"
            est-vide="Compétence globale"
        />
    </main>

</template>

<style scoped>
    @reference "#app.css";

     #intro-section{
        @apply my-8 flex flex-col gap-2;
    }

    #couteau-suisse{
        @apply text-primary font-bold;
    }

    #filtres {
        @apply flex flex-wrap gap-2;
    }

    .skills-list {
        @apply mt-6 flex flex-col;
    }
</style>