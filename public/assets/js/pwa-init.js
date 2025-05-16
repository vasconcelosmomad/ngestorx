// Inicialização do PWA
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('Service Worker registrado com sucesso:', registration.scope);
                
                // Verifica atualizações do Service Worker
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            // Nova versão disponível - podemos notificar o usuário
                            showUpdateNotification();
                        }
                    });
                });
            })
            .catch(error => {
                console.error('Erro ao registrar Service Worker:', error);
            });
    });
}

// Função para mostrar notificação de atualização
function showUpdateNotification() {
    const notification = document.createElement('div');
    notification.className = 'update-notification';
    notification.innerHTML = `
        <p>Uma nova versão está disponível!</p>
        <button id="update-app">Atualizar agora</button>
    `;
    document.body.appendChild(notification);
    
    document.getElementById('update-app').addEventListener('click', () => {
        // Envia mensagem para o service worker atualizar
        navigator.serviceWorker.controller.postMessage({ type: 'SKIP_WAITING' });
        // Recarrega a página para usar a nova versão
        window.location.reload();
        notification.remove();
    });
    
    // Estilo para a notificação
    const style = document.createElement('style');
    style.textContent = `
        .update-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4a90e2;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            z-index: 9999;
        }
        .update-notification p {
            margin: 0 0 10px 0;
        }
        .update-notification button {
            background-color: white;
            color: #4a90e2;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
    `;
    document.head.appendChild(style);
}

// Evento para instalação do PWA
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    
    // Opcional: Mostrar um botão ou UI para instalar o PWA
    const installButton = document.getElementById('install-pwa');
    if (installButton) {
        installButton.style.display = 'block';
        installButton.addEventListener('click', installPWA);
    }
});

// Função para instalar o PWA
function installPWA() {
    if (!deferredPrompt) return;
    
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then(choiceResult => {
        if (choiceResult.outcome === 'accepted') {
            console.log('Usuário aceitou a instalação do PWA');
            // Esconder o botão de instalação após aceitar
            const installButton = document.getElementById('install-pwa');
            if (installButton) {
                installButton.style.display = 'none';
            }
        }
        deferredPrompt = null;
    });
}

// Evento quando o PWA é instalado com sucesso
window.addEventListener('appinstalled', (evt) => {
    console.log('PWA instalado com sucesso');
});