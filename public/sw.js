// Importação do Workbox via CDN
importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.5.4/workbox-sw.js');

// Desabilitar logs em produção (remova esta linha durante o desenvolvimento)
workbox.setConfig({ debug: false });

// Nome do cache
const CACHE_VERSION = 'ngestorx-v2';
const HTML_CACHE = `${CACHE_VERSION}-html`;
const CSS_CACHE = `${CACHE_VERSION}-css`;
const JS_CACHE = `${CACHE_VERSION}-js`;
const IMAGE_CACHE = `${CACHE_VERSION}-images`;
const FONT_CACHE = `${CACHE_VERSION}-fonts`;
const STATIC_CACHE = `${CACHE_VERSION}-static`;

// Página fallback para quando estiver offline
const OFFLINE_PAGE = '/offline.html';

// Pré-cache da página offline
workbox.precaching.precacheAndRoute([
  { url: OFFLINE_PAGE, revision: '1.0' },
  { url: '/manifest.json', revision: '1.0' },
  // Adicione aqui outros arquivos essenciais para a experiência offline
]);

// Estratégia para páginas HTML: Network First, com fallback para offline
workbox.routing.registerRoute(
  ({ request }) => request.mode === 'navigate',
  new workbox.strategies.NetworkFirst({
    cacheName: HTML_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 50, // Máximo de 50 páginas em cache
        maxAgeSeconds: 24 * 60 * 60, // 1 dia
        purgeOnQuotaError: true,
      }),
      // Fallback para página offline se a rede falhar
      {
        handlerDidError: async () => caches.match(OFFLINE_PAGE),
      },
    ],
  })
);

// Estratégia para CSS: Stale While Revalidate (usa cache, mas atualiza em segundo plano)
workbox.routing.registerRoute(
  ({ request }) => request.destination === 'style',
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: CSS_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 50,
        maxAgeSeconds: 7 * 24 * 60 * 60, // 7 dias
        purgeOnQuotaError: true,
      }),
    ],
  })
);

// Estratégia para JavaScript: Stale While Revalidate
workbox.routing.registerRoute(
  ({ request }) => request.destination === 'script',
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: JS_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 50,
        maxAgeSeconds: 7 * 24 * 60 * 60, // 7 dias
        purgeOnQuotaError: true,
      }),
    ],
  })
);

// Estratégia para imagens: Cache First
workbox.routing.registerRoute(
  ({ request }) => request.destination === 'image',
  new workbox.strategies.CacheFirst({
    cacheName: IMAGE_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 100, // Máximo de 100 imagens em cache
        maxAgeSeconds: 30 * 24 * 60 * 60, // 30 dias
        purgeOnQuotaError: true,
      }),
    ],
  })
);

// Estratégia para fontes: Cache First
workbox.routing.registerRoute(
  ({ request }) => request.destination === 'font',
  new workbox.strategies.CacheFirst({
    cacheName: FONT_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 20,
        maxAgeSeconds: 60 * 24 * 60 * 60, // 60 dias
        purgeOnQuotaError: true,
      }),
    ],
  })
);

// Estratégia para recursos estáticos (manifestos, json, etc)
workbox.routing.registerRoute(
  ({ url }) => url.pathname.endsWith('.json') || url.pathname.includes('/assets/'),
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: STATIC_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 50,
        maxAgeSeconds: 7 * 24 * 60 * 60, // 7 dias
        purgeOnQuotaError: true,
      }),
    ],
  })
);

// Estratégia para API - Network Only (sem cache)
workbox.routing.registerRoute(
  ({ url }) => url.pathname.startsWith('/api/'),
  new workbox.strategies.NetworkOnly()
);

// Lidar com instalação e ativação do service worker
self.addEventListener('install', (event) => {
  console.log('Service Worker instalado com sucesso');
  self.skipWaiting(); // Força a ativação imediata
});

self.addEventListener('activate', (event) => {
  console.log('Service Worker ativado com sucesso');
  // Limpa caches antigos que não são mais necessários
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames
          .filter((cacheName) => !cacheName.startsWith(CACHE_VERSION))
          .map((cacheName) => {
            console.log('Eliminando cache antigo:', cacheName);
            return caches.delete(cacheName);
          })
      );
    })
  );
});

// Tratamento de mensagens enviadas ao Service Worker
self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});
