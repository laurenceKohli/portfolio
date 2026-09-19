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
            <img :src="`/img/projects/${image.img_path}`" :alt="image.desc" />
        </div>
    </div>

    <div>
        <p class="project-tag">{{ project.tag.name }}</p>
        <h1 class="text-primary">{{ project.title }}</h1>

        <div id="project-summary">
            <div id="project-techs">
                <BaseTech v-for="(tech, index) in project.techs" :key="`${tech}-${index}`" :label="tech.name" />
            </div>
            <p v-if="project.duration" id="project-duration" class="breadcrumb">
                {{ project.duration }}
            </p>  
            <a v-if="project.url" id="project-link" class="breadcrumb" :href="project.url" target="_blank" rel="noopener noreferrer">
            Voir le résultat
            </a>
        </div>

  
        
        <div id="project-goals">
            <h2>Objectifs</h2>
            <ul v-html="project.goals">
            </ul>
        </div>

        <div id="project-details">
            <h2>Le projet</h2>
            <div v-html="project.desc">
            </div>
            <div v-if="project.team" class="project-part">
                <h3>Équipe</h3>
                <p>{{ project.team }}</p>
            </div>
            <div class="project-part">
                <h3>Les technologies utilisées</h3>
                <ul>
                    <li v-for="(exp, index) in project.exps" :key="index">{{ exp.name }}</li>
                </ul>
            </div>
            <div class="project-part">
                <h3>Ma contribution</h3>
                <p v-html="project.contribution">
                </p>
            </div>
            <div v-if="project.proud" class="project-part">
                <h3>Ma plus grande fierté</h3>
                <p v-html="project.proud">
                </p>
            </div>
        </div>
    </div>  
  </div>
</template>

<style scoped>
    @reference "#app.css";

    #project {
        @apply flex flex-col gap-y-6 md:grid md:grid-cols-2 md:items-start md:gap-x-6;
        @apply w-full;
    }

    #project > div:last-child {
        @apply md:col-start-1 md:row-start-1 md:w-full;
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

    :deep(p) {
        @apply pb-1 md:pb-2;
    }

    ul{
        @apply list-inside ml-8 -indent-6 pl-0;
    }

    
    #project-summary {
        @apply flex flex-wrap items-center gap-x-4 gap-y-3 py-2 md:py-4;
    }
    #project-summary p {
        @apply pb-0 md:pb-0;
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
        @apply hidden md:col-start-2 md:row-start-1 md:flex md:w-full md:flex-col md:gap-6 md:pt-10;
    }

    .project-image {
        @apply h-35 w-full self-stretch overflow-hidden  md:h-70;
    }

    .project-image img {
        @apply block h-full  object-contain rounded-lg;
    }

</style>