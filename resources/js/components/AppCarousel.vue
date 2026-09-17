<script setup>
import { computed, ref } from 'vue'
import BaseButton from './BaseButton.vue'

const props = defineProps({
    currentEvent: {
        type: Object,
        default: () => ({ images: [] }),
    },
})

const currentImage = ref(0)

const images = computed(() => props.currentEvent?.images ?? [])

const nextImage = () => {
    if (images.value.length > 0) {
        currentImage.value = (currentImage.value + 1) % images.value.length
    }
}

const prevImage = () => {
    if (images.value.length > 0) {
        currentImage.value = currentImage.value === 0
            ? images.value.length - 1
            : currentImage.value - 1
    }
}
</script>

<template>
    <div class="carousel" v-if="images.length > 0">
        <BaseButton
            class="carousel-btn prev"
            size="icon"
            color="primary-line"
            icon="<"
            type="button"
            aria-label="Image précédente"
            @click="prevImage"
        />
        <img :src="images[currentImage]" alt="Image du projet" />
        <BaseButton
            class="carousel-btn next"
            size="icon"
            color="primary-line"
            icon=">"
            type="button"
            aria-label="Image suivante"
            @click="nextImage"
        />
        <div class="dots">
            <span
                v-for="(_, index) in images"
                :key="index"
                :class="{ active: currentImage === index }"
                @click="currentImage = index"
            ></span>
        </div>
    </div>
</template>

<style scoped>
@reference "#app.css";
.carousel {
    @apply relative w-full h-[200px] flex items-center justify-center overflow-hidden rounded-lg mb-8 bg-surface;
}

.carousel img {
    @apply block max-w-full max-h-full w-auto h-auto object-contain;
}

.carousel-btn {
    @apply absolute top-1/2 -translate-y-1/2 z-10;
}

.prev {
    @apply left-4;
}

.next {
    @apply right-4;
}
.dots {
    @apply absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2;
}

.dots span {
    @apply size-2.5 rounded-full bg-tertiary cursor-pointer;
}

.dots span.active {
    @apply bg-primary;
}

</style>