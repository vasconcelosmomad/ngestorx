import axios from 'axios';
window.axios = axios;

// Definir o token CSRF para todas as requisições
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Registrar Service Worker para PWA
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('Service Worker registrado com sucesso:', registration);
            })
            .catch(error => {
                console.log('Falha ao registrar Service Worker:', error);
            });
    });
}
