const CACHE_NAME = 'roca-himnos-v1';
const BASE_URLS = [
  '/',
  '/himnos',
  '/iglesias',
  '/coros',
  '/estudios',
  '/actividades'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches
      .open(CACHE_NAME)
      .then((cache) => cache.addAll(BASE_URLS))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches
      .keys()
      .then((keys) => Promise.all(keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))))
      .then(() => self.clients.claim())
  );
});

self.addEventListener('message', (event) => {
  if (!event.data) {
    return;
  }

  if (event.data.type === 'CLEAR_CACHE') {
    event.waitUntil(caches.delete(CACHE_NAME));
    return;
  }

  if (event.data.type !== 'CACHE_URLS' && event.data.type !== 'CACHE_ASSETS') {
    return;
  }

  const urls = Array.isArray(event.data.urls) ? event.data.urls : [];
  const requestId = event.data.requestId || null;

  event.waitUntil(
    caches.open(CACHE_NAME).then(async (cache) => {
      const total = urls.length;

      for (let i = 0; i < urls.length; i += 1) {
        const url = urls[i];
        try {
          const response = await fetch(url, { cache: 'no-cache' });
          if (response && response.status === 200) {
            await cache.put(url, response.clone());
          }
        } catch (e) {
          // Ignore single failures.
        }

        if (requestId) {
          const progress = { type: 'CACHE_PROGRESS', requestId, current: i + 1, total };
          const clients = await self.clients.matchAll();
          clients.forEach((client) => client.postMessage(progress));
        }
      }

      if (requestId) {
        const done = { type: 'CACHE_DONE', requestId };
        const clients = await self.clients.matchAll();
        clients.forEach((client) => client.postMessage(done));
      }
    })
  );
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') {
    return;
  }

  const url = new URL(event.request.url);
  if (url.origin !== self.location.origin) {
    return;
  }

  event.respondWith(
    caches.match(event.request).then((cachedResponse) => {
      const fetchPromise = fetch(event.request)
        .then((response) => {
          if (!response || response.status !== 200) {
            return response;
          }

          const shouldCache =
            event.request.destination === 'document' ||
            event.request.destination === 'script' ||
            event.request.destination === 'style' ||
            event.request.destination === 'image' ||
            event.request.destination === 'font' ||
            url.pathname.startsWith('/himnos');

          if (shouldCache) {
            const responseClone = response.clone();
            caches.open(CACHE_NAME).then((cache) => cache.put(event.request, responseClone));
          }

          return response;
        })
        .catch(() => cachedResponse);

      return cachedResponse || fetchPromise;
    })
  );
});
