declare const self: ServiceWorkerGlobalScope;

const APP_VERSION = "";
const ASSETS: Array<string> = [];
const ROUTES: Array<string> = [];
const OFFLINE_PAGE: string = "";

/**
 * Shows the offline page.
 */
const showOfflinePage = (): Response =>
  new Response(OFFLINE_PAGE, {
    headers: { "Content-Type": "text/html" },
    status: 503,
  });

/**
 * Dispatches an action to the client.
 *
 * @param client - The client to dispatch the action to.
 * @param event - The notification event.
 */
const dispatchEventToClient = (
  client: WindowClient | null,
  event: NotificationEvent
): void => {
  client?.postMessage({ event });
};

self.oninstall = (event) => {
  self.skipWaiting();

  event.waitUntil(
    caches.open(APP_VERSION).then((cache) => cache.addAll(ASSETS))
  );
};

self.onerror;

self.onactivate = (event) => {
  event.waitUntil(
    caches.keys().then(function (cacheNames) {
      return Promise.all(
        cacheNames.map(function (cacheName) {
          if (cacheName !== APP_VERSION) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
};

self.onfetch = (event) => {
  const url = new URL(event.request.url);
  const pathname =
    (url.pathname.endsWith("/") ? url.pathname.slice(0, -1) : url.pathname) ||
    "/";

  if (ASSETS.includes(pathname) || ROUTES.includes(pathname)) {
    const request = new Request(url.origin + pathname);

    event.respondWith(
      caches
        .open(APP_VERSION)
        .then((cache) =>
          cache.match(request).then(function (fromCache) {
            const fromNetwork = fetch(request)
              .then((networkResponse) => {
                cache.put(request, networkResponse.clone());
                return networkResponse;
              })
              .catch(showOfflinePage);

            return fromCache || fromNetwork;
          })
        )
        .catch(() =>
          fetch(request)
            .then((response) => response)
            .catch(showOfflinePage)
        )
    );
  } else {
    event.respondWith(fetch(event.request).catch(showOfflinePage));
  }
};

self.onnotificationclick = (event) => {
  event.waitUntil(
    self.clients
      .matchAll({
        type: "window",
        includeUncontrolled: true,
      })
      .then(function (clientList) {
        for (var i = 0; i < clientList.length; i++) {
          const client = clientList[i];

          if (
            client.url === event.notification.data.redirect_to &&
            "focus" in client
          ) {
            return client
              .focus()
              .then((client) => dispatchEventToClient(client, event));
          }
        }

        return self.clients
          .openWindow(event.notification.data.redirect_to)
          .then((client) => dispatchEventToClient(client, event));
      })
  );
};

export {};
