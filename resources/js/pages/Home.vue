<script setup>
  import AppProjectCard from '@/components/AppProjectCard.vue';
  import TheNav from '@/components/TheNav.vue';
  import AppTitleWithIcon from '@/components/AppTitleWithIcon.vue';
  import AppButtonNav from '@/components/AppButtonNav.vue';
  import AppCompetence from '@/components/AppCompetence.vue';
  import BaseButton from '@/components/BaseButton.vue';

 const props = defineProps({
        projects: {
        type: Array,
        default: () => [],
        },
        skills: {
        type: Array,
        default:() => [],
        },
    });

</script>

<template>
  <TheNav/>
  <section id="perso-section">
    <div>
      <div id="perso-accounts">
        <a href="https://www.linkedin.com/in/laurence-kohli" target="_blank" rel="noopener noreferrer">
          <img src="/img/competences/linkedin.svg" alt="linkedin" />
        </a>
        <a href="https://github.com/laurenceKohli" target="_blank" rel="noopener noreferrer">
          <img src="/img/competences/github.svg" alt="github" />
        </a>
      </div>

      <div>
        <p id="name">Laurence Kohli</p>
        <div id="perso-intro"> 
          <p>Ingénieure des médias</p>
          <p>Gestion de projets - Création de sites - Innovation</p>
        </div>
      </div>
  </div>
 
    <div id="presentation">
      <div id="perso-nav">
        <AppButtonNav icon="projects" label="Mes projets"/>
        <AppButtonNav icon="skills" label="Compétences"/>   
        <AppButtonNav icon="cv" label="CV"/>
        <AppButtonNav icon="contact" label="Me contacter"/>
      </div>
      <div id="perso-img">
        <img src="/img/perso/perso-light.jpg" alt="Laurence Kohli" />
      </div>
    </div>

  </section>

  <section id="projects-section">
    <AppTitleWithIcon icon="projects" color="secondary" title="Mes <span>projets</span>" diffMobile/>
    <p>Voici quelques uns de mes projets récents</p>
    
    <div id="projects">
        <AppProjectCard
            v-for="project in projects"
            :key="project.id"
            :project="project"
            />
        <BaseButton @click="$inertia.visit(`/projects`)" label="Voir d'autres projets" color="secondary-line" size="full" />
    </div>
  </section>

  <section id="skills-section">
    <AppTitleWithIcon icon="skills" color="primary" title="Mes <span>compétences</span>" diffMobile/>
    <div id="skills">
      <AppCompetence v-for="skill in skills" :key="skill.id" :icon="skill.logo_path" :label="skill.name"/>
    </div>
  </section>
</template>

<style scoped>
@reference "#app.css";
  #perso-section{
    @apply flex flex-col md:flex-row justify-center items-center gap-15;
    @apply mb-25;
  }

  #perso-section>:first-child{
    @apply md:flex md:flex-col-reverse md:justify-center md:items-center md:gap-6;
  }

  #perso-accounts{
    @apply flex justify-center items-center gap-14 md:gap-1;
    @apply mb-8;
  }

  #name{
    @apply text-center text-6xl font-bold font-heading;
  }

  #perso-intro{
    @apply text-center;
  }

  #presentation{
    @apply flex justify-center items-center gap-4;
  }

  #perso-nav{
    @apply flex flex-col items-center gap-5;
  }

  #perso-img>img{
    @apply block h-full rounded-lg md:h-[360px];
  }

  section{
    @apply mb-9;
  }

  #projects-section>p{
    @apply mb-4 text-xs md:text-center;
  }

  #projects, #skills{
    @apply flex flex-wrap gap-6;
  }
</style>