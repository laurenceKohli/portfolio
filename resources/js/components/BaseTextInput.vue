<script setup>
    import { onMounted, ref } from 'vue'

    const model = defineModel({
        type: String,
        required: true,
    })

    const input = ref(null)

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus()
        }
    })

    defineExpose({ focus: () => input.value.focus() })
</script>

<template>
     <input v-model="model" ref="input" />
</template>

<style scoped>
@reference "#app.css";
    input{
        @apply self-stretch p-2 ;
        @apply inline-flex justify-start items-start gap-2;
        @apply rounded-lg outline outline-1 outline-offset-[-1px] outline-text ;
    }


    ::placeholder {
    @apply self-stretch justify-center;
    @apply text-xs;
}
</style>
