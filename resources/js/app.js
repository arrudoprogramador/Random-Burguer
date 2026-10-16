import Alpine from 'alpinejs'

window.Alpine = Alpine

// Gerenciador global de tema (Dark / Light)
window.themeManager = {
    isDark() {
        return document.documentElement.classList.contains('dark')
    },
    set(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark')
            localStorage.setItem('theme', 'dark')
        } else {
            document.documentElement.classList.remove('dark')
            localStorage.setItem('theme', 'light')
        }
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: { dark: this.isDark() } }))
    },
    toggle() {
        this.set(this.isDark() ? 'light' : 'dark')
    }
}

// Componente reativo do Alpine para botões de alternância de tema
Alpine.data('themeToggle', () => ({
    dark: document.documentElement.classList.contains('dark'),
    init() {
        window.addEventListener('theme-changed', (e) => {
            this.dark = e.detail.dark
        })
    },
    toggle() {
        window.themeManager.toggle()
        this.dark = window.themeManager.isDark()
    }
}))

Alpine.start()