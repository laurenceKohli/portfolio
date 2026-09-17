<script setup>
    import TheNav from '@/components/TheNav.vue';
    import BaseTech from '@/components/BaseTech.vue';
    import AppCarousel from '@/components/AppCarousel.vue';
    
    const props = defineProps({
        project: {
        type: Object,
        default: () => {},
        },
    });

    const carrouselEvent = {
        images: props.project.imgs.map(img => img.img_path),
    }

    const goBack = () => {
    if (window.history.length > 1) {
        window.history.back()
    } else {
        window.location.href = '/'
    }
}

</script>

<template>
  <TheNav/>

  <div id="project">
    <div id="project-carrousel">
        <AppCarousel :currentEvent="carrouselEvent" />
    </div>

    <div id="project-images">
        <div v-for="(image, index) in project.imgs" :key="index" class="project-image">
            <img :src="image.img_path" :alt="image.desc" />
        </div>
    </div>

    <div>
        <p class="project-tag">{{ project.tag.name }}</p>
        <h1 class="text-primary">{{ project.title }}</h1>

        <div id="project-summary">
            <div id="project-techs">
                <BaseTech v-for="(tech, index) in project.techs" :key="`${tech}-${index}`" :label="tech.name" />
            </div>
            <p v-if="project.duration" id="project-duration breadcrumb">
                {{ project.duration }}
            </p>  
            <a v-if="project.url" id="project-link breadcrumb" :href="project.url" target="_blank" rel="noopener noreferrer">
            Voir le résultat
            </a>
        </div>

  
        
        <div id="project-goals">
            <h2>Objectifs</h2>
            <ul>
                {{project.goals}}
            </ul>
        </div>

        <div id="project-details">
            <h2>Le projet</h2>
            <div>
                <p>{{ project.desc }}</p>
            </div>
            <div v-if="project.team" class="project-part">
                <h3>Équipe</h3>
                <p>{{ project.team }}</p>
            </div>
            <div class="project-part">
                <h3>Les technologies utilisées</h3>
                <ul>
                    <li v-for="(tech, index) in project.techs" :key="index">{{ tech.name }}</li>
                </ul>
            </div>
            <div class="project-part">
                <h3>Ma contribution</h3>
                <p>{{ project.contribution }}</p>
            </div>
            <div v-if="project.proud" class="project-part">
                <h3>Ma plus grande fierté</h3>
                <p>{{ project.proud }}</p>
            </div>
        </div>
    </div>  
  </div>
</template>

<style scoped>
    @reference "#app.css";

    #project {
        @apply flex flex-col md:flex-row-reverse flex-wrap justify-end gap-x-6;
        @apply w-full;
    }

    #project > div:last-child {
        @apply md:w-1/2;
    }
    .project-tag {
        @apply text-xs text-onSurface2 py-1 md:py-2;
    }

    h1 {
        @apply text-left;
    }

    h2 {
        @apply text-left pb-2 md:pb-4;
    }

    h3 {
        @apply text-left pb-1 md:pb-2;
    }

    #project-summary {
        @apply flex flex-wrap items-center gap-x-4 gap-y-3 py-2 md:py-4;
    }

    #project-techs {
        @apply flex gap-1;
    }

    #project-duration {
        @apply italic;
    }

    #project-link {
        @apply text-onSurface1;
    }


    #project-goals {
        @apply py-5 md:py-10;
    }

    #project-details > div {
        @apply pb-4 md:pb-8;
    }

    #project-carrousel {
        @apply md:hidden;
    }
    
    #project-images {
        @apply hidden md:visible flex flex-col flex-wrap gap-4 pt-5 md:pt-10;
    }

    .project-image {
        @apply rounded-lg h-35 md:h-70 self-stretch;
    }

</style>