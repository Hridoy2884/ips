import './bootstrap'
import 'preline'

// Initial load
document.addEventListener('DOMContentLoaded', () => {
    window.HSStaticMethods?.autoInit();
});

// Livewire navigation re-init (very important for SPA)
document.addEventListener('livewire:navigated', () => {
    // Reset Preline behavior
    window.HSStaticMethods?.autoInit();

    // 💡 Ensure hamburger menu is closed after navigation
    const collapse = document.querySelector('#navbar-collapse-with-animation');
    if (collapse && collapse.classList.contains('block')) {
        collapse.classList.remove('block');
        collapse.classList.add('hidden');
    }
});
