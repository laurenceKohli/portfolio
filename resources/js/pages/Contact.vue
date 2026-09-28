<script setup>
 import { useForm } from '@inertiajs/vue3';
 import BaseTextInput from '@/components/BaseTextInput.vue';
 import TheNav from '@/components/TheNav.vue';
 import AppTitleWithIcon from '@/components/AppTitleWithIcon.vue';

    const form = useForm({
        nom: '',
        prenom: '',
        email: '',
        no: '',
        message: '',
    });

    const email = ['contact', '@', 'votre-site.com'].join('');
    const emailHref = `mailto:${email}`;
</script>

<template>
    <TheNav/>
    
    <div id="intro-section">
        <p>Vous avez un projet en tête ?</p>
        <p>Vous avez besoin d'une ingénieure en médias ?</p>
    </div>

    <AppTitleWithIcon 
            icon="contact"
            color="primary"
            title="Formulaire de <span>contact</span>"
    />

    
    <section id=contact-section>
        <div id="contact-img">
        <img src="/img/perso/perso-light.jpg"/>
        </div>

        <div id="contact-form">
            <div>
                <p id="contact-me">N'hésitez pas à m'envoyer un <a :href="emailHref">mail</a></p>
                <p>ou à me contacter sur LinkedIn</p>
            </div>

            <a id="linkedin" href="https://www.linkedin.com/in/laurence-kohli" target="_blank" rel="noopener noreferrer">
                <img src="/img/competences/linkedin.svg" alt="linkedin" />
            </a>
        </div>
        <!-- <BaseTextInput id="nom" v-model="form.nom" placeholder="Nom" required />
        <BaseTextInput id="prenom" v-model="form.prenom" placeholder="Prénom" required />
        <BaseTextInput id="email" v-model="form.email" placeholder="Email" required />
        <BaseTextInput id="no" v-model="form.no" placeholder="Numéro de téléphone" />
        <BaseTextInput id="message" v-model="form.message" placeholder="Message" required /> -->
    </section>

</template>

<style scoped>
    @reference "#app.css";

    #intro-section{
        @apply my-16 flex flex-col justify-center items-center;
    }

    h1{
        @apply justify-center items-center;
    }

    #contact-section{
        @apply flex flex-col-reverse md:flex-row md:gap-6 md:items-center md:justify-center;
    }

    #contact-form{
        @apply flex flex-row md:flex-col justify-center items-center gap-4;
    }


    #contact-me>a{
        @apply text-primary font-bold;
    }

    #contact-img{
        @apply block mt-16 md:mt-0;
    }

    #contact-img>img{
        @apply block h-full rounded-lg md:h-[360px];
    }

    

</style>
