import { PubSub } from './pubsub.js';

if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
        navigator.serviceWorker
            .register("../service-worker.js")
            .then(function (registration) {
                console.log("Pendaftaran ServiceWorker berhasil: ", registration.scope);
            })
            .catch(function () {
                console.log("Pendaftaran ServiceWorker gagal");
            });
    });
} else {
    console.log("ServiceWorker belum didukung browser ini.");
}


document.addEventListener("DOMContentLoaded", function () {
    // flip card
    $(document).on("click", ".flipbutton", () => {
        $(".card-y").toggleClass("active")
    });

    // initiate navigation
    $('.sidenav').sidenav();
    loadNav();

    function loadNav() {
        var xhttp = new XMLHttpRequest();
        // apakah open, send dan onready state bisa diletakkan random?
        xhttp.open("GET", 'nav.html', true);
        xhttp.send();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status != 200) return;

                // Muat daftar tautan menu
                document.querySelectorAll(".nav, .sidenav")
                    .forEach(function (elm) {
                        // += karena untuk tidak merubah konten di dalam
                        elm.innerHTML += xhttp.responseText;
                    });

                // Daftarkan event listener untuk setiap tautan menu
                document.querySelectorAll('.sidenav a, .nav a')
                    .forEach(function (elm) {
                        elm.addEventListener('click', function (event) {
                            // Tutup sidenav ketika di klik
                            var sidenav = document.querySelector('.sidenav');
                            M.Sidenav.getInstance(sidenav).close();

                            // Muat konten halaman yang dipanggil 
                            page = event.target.getAttribute('href').substr(1);
                            loadPage(page);
                        });
                    });
            }
        }
    }

    // Load page content
    let page = window.location.hash.substr(1);
    let capasityPubSub, qualityPubSub = null;
    if (page == '') page = 'home';
    loadPage(page);


    function loadPage(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            $(document).ready(() => {
                $('.parallax').parallax();
                $('.modal').modal();
                

                document.querySelectorAll('.link-page')
                    .forEach((elm) => {
                        elm.addEventListener('click', (event) => {
                            page = event.target.getAttribute('href').substr(1);
                            loadPage(page);
                        })
                    })

                if (page == 'device') {
                    $('.collapsible').collapsible();
                    setTimeout(() => {
                        if(capasityPubSub == null) {
                            capasityPubSub = new PubSub(
                                document.querySelector("#capacity")
                            );
                        }
                        if(qualityPubSub == null) {
                            qualityPubSub = new PubSub(
                                document.querySelector("#quality"),
                                '/quality'
                            );
                        }
                    }, 5000);
                } else {
                    try {
                        capasityPubSub.disconnect();
                        qualityPubSub.disconnect();
                        capasityPubSub = null, qualityPubSub = null;
                    } catch (e) {}
                }
            })
            if (this.readyState == 4) {
                var content = document.querySelector(".body-content");
                if (this.status == 200) {
                    content.innerHTML = xhttp.responseText;
                } else if (this.status == 404) {
                    content.innerHTML = "<p>Halaman tidak ditemukan.</p>";
                } else {
                    content.innerHTML = "<p>Ups.. halaman tidak dapat diakses.</p>";
                    // location.reload();
                }
            }
        };
        xhttp.open("GET", 'pages/' + page + '.html', true);
        xhttp.send();
    }
});