import { onMounted, ref } from 'vue'

const isDarkMode = ref(false)
let isInitialized = false

export default function useDarkMode() {
    onMounted(() => {
        if (isInitialized) {
            return
        }

        isDarkMode.value = localStorage.getItem('darkMode') === 'true'
        document.documentElement.classList.toggle('dark', isDarkMode.value)
        isInitialized = true
    })

    const toggleDarkMode = () => {
        isDarkMode.value = !isDarkMode.value
        document.documentElement.classList.toggle('dark', isDarkMode.value)
        localStorage.setItem('darkMode', String(isDarkMode.value))
    }

    return { isDarkMode, toggleDarkMode }
}