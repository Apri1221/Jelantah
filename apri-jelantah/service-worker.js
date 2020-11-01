const CACHE_NAME = "jelantuy-v" + Date.now();

let urlsToCache = [
    "/",
    "/manifest.json",
    "/nav.html",
    "/index.html",
    "/js/script.js",
    "/css/style.css",
    "/pages/home.html",
    "/pages/about.html",
    "/pages/dashboard.html",
    "/pages/device.html",
    "/images/boy.png",
    "/images/prototype.png",
    "/images/ucok.png",
    "/images/icon/icon-512.png",
    "/images/icon/android-icon-192.png",
    "/images/icon/apple-icon-152.png",
    "https://code.jquery.com/jquery-3.5.1.min.js",
    "https://fonts.googleapis.com/icon?family=Material+Icons",
    "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css",
    "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js",
    "https://fonts.gstatic.com/s/materialicons/v54/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2"
]

self.addEventListener("install", event => {
    /**
     *  https://developers.google.com/web/fundamentals/primers/service-workers/lifecycle#skip_the_waiting_phase
     * It's needed to force the SW to change the stage from installation to activation
     */

    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(cache => cache.addAll(urlsToCache))
        .then(() => self.skipWaiting()) // force to activation
    );
});

// cache terdaftar, lihat di application > Cache > Cache Storage


/**
 * Menghapus Cache Lama dengan cara mengganti nama cache yang digunakan
 * Biasa kita cukup menambahkan penanda versi
 * Semakin sering mengganti nama cache, maka akan banyak cache di browser pengguna
 * berikut mekanisme penghapusan cache lama
 * 
 * bacaan lain : https://www.monterail.com/blog/pwa-working-offline
 */

self.addEventListener("activate", function (event) {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName != CACHE_NAME) {
                        console.log(`SW: cache ${cacheName} dihapus`);
                        return caches.delete(cacheName);
                    }
                })
            )
        }).then(() => self.clients.claim())
    )
})


/**
 * https://developers.google.com/web/ilt/pwa/caching-files-with-service-worker#cache_falling_back_to_the_network
 * 
 * Teknik caching : https://jakearchibald.com/2014/offline-cookbook/
 * 
 * is the browser intelligent enough to see through cache and omit sending requests?
 * 
 * ada 2 cara, di script js untuk bagian else page this.status, kita reload
 * atau gunakan cara ini : https://developers.google.com/web/fundamentals/primers/service-workers#cache_and_return_requests
 */

self.addEventListener("fetch", function (event) {
    if (event.request.url.startsWith("chrome-extension://")) return;

    regexAsset = new RegExp('(.*).js|(.*).css|(.*).woff$')

    event.respondWith(
        caches.match(event.request, {
            cacheName: CACHE_NAME
        })
        .then(response => {
            // Cache hit - return response
            return response || fetch(event.request)
                .then(response => {
                    let responseToCache = response.clone();
                    caches.open(CACHE_NAME).then(cache => {
                        cache.put(event.request, responseToCache);
                    });
                    return response;
                });
        })
    );
});