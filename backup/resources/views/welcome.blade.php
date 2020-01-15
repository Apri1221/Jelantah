<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Styles -->
    <style>
    body {
        font-family: 'Raleway', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        display: flex;
        font-size: 18px !important;
        min-height: 100vh;
        flex-direction: column;
    }

    .navbar-fixed nav {
        padding: env(safe-area-inset-top) env(safe-area-inset-right) env(safe-area-inset-bottom) env(safe-area-inset-left);
    }

    .footer-fixed footer {
        padding: env(safe-area-inset-top) env(safe-area-inset-right) env(safe-area-inset-bottom) env(safe-area-inset-left);
    }

    main {
        flex: 1 0 auto;
    }

    .footer-fixed {
        position: fixed;
        bottom: 0;
        z-index: 1080;
        width: 100%;
    }

    footer ul.justify {
        text-align: center;
        display: table;
        overflow: hidden;
        margin: 0 auto;
    }

    footer ul.justify li {
        margin-left: auto;
        margin-right: auto;
        width: 82px;
    }

    .splash-image-container {
        width: 100%;
        max-width: 740px;
    }

    @media only screen and (max-width: 992px) {
        .splash-image-container {
            margin-top: 0;
            padding-top: 0px;
            width: 100%;
            height: 100%;
            text-align: center;
            max-width: initial
        }
    }

    .splash-image-kbremote {
        height: 100%;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        -ms-border-radius: 8px;
        -o-border-radius: 8px;
        border-radius: 8px
    }

    .splash-image {
        width: 100%;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        -ms-border-radius: 8px;
        -o-border-radius: 8px;
        border-radius: 8px
    }

    @media only screen and (max-width: 992px) {
        .splash-image {
            width: 100%;
            max-width: 740px;
            max-height: 100%;
            margin-bottom: -44px
        }

        .splash-image-kbremote {
            width: 100%;
            max-width: 740px;
            max-height: 100%;
            margin-bottom: -44px
        }
    }


    /* label focus color */
    .input-field input:focus+label {
        color: #5c6bc0 !important;
    }

    /* label underline focus color */
    .row .input-field input:focus {
        border-bottom: 1px solid #5c6bc0 !important;
        box-shadow: 0 1px 0 0 #5c6bc0 !important
    }

    .input-field .prefix.active {
        color: #ffb300 !important;
    }

    .sidenav li>a,
    .subheader {
        font-size: 20px !important
    }

    .sidenav li>a.active {
        background-color: #00bcd4 !important;
        color: #fff
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        padding: 20px 0;
    }

    .btn-block {
        width: 100%;
    }


    /* created by apri, make flip card */
    .flipbutton {
        cursor: pointer;
    }

    @keyframes no-show {
        0% {
            transform: rotateY(0deg);
            height: 100%;
            width: 100%;
        }

        49% {
            height: 100%;
            width: 100%;
        }

        50% {
            transform: rotateY(90deg);
            height: 0;
            width: 0;
        }

        100% {
            transform: rotateY(180deg);
            height: 0;
            width: 0;
        }
    }

    @keyframes show {
        0% {
            transform: rotateY(-180deg);
            height: 0;
            width: 0;
        }

        49% {
            transform: rotateY(-90deg);
            height: 0;
            width: 0;
        }

        50% {
            height: 100%;
            width: 100%;
        }

        100% {
            transform: rotateY(0deg);
            height: 100%;
            width: 100%;
        }
    }

    .card-y {
        position: relative;
    }

    .front,
    .back {
        position: relative;
        transform-style: preserve-3d;
        perspective-origin: top center;
        animation-duration: 1s;
        animation-timing-function: linear;
        transition-property: transform;
        animation-fill-mode: forwards;
        -webkit-animation-fill-mode: forwards;
        padding: 2px;
        overflow: hidden;
    }

    /* front pane, placed above back */
    .front {
        z-index: 2;
        transform: rotateY(0deg);
        animation-name: show;
    }

    .card-y.active .front {
        animation-name: no-show;
    }

    /* back, initially hidden pane */
    .back {
        transform: rotateY(-180deg);
        animation-name: no-show;
    }

    .card-y.active .back {
        animation-name: show;
    }

    /* end of the flip */

    /* modified of toast materialize */
    @media only screen and (min-width : 480px) and (max-width : 1000px) {
        #toast-container {
            min-width: 30%;
            bottom: 60%;
            top: 10%;
        }
    }

    @media only screen and (min-width : 480px) {
        #toast-container {
            top: auto !important;
            right: auto !important;
            bottom: 10%;
            left: 10%;
        }
    }
    </style>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.parallax').parallax();

        $('.sidenav').sidenav({
            edge: 'right', // <--- CHECK THIS OUT
        });

        $('.scrollspy').scrollSpy();

        // Create a client instance
        client = new Paho.MQTT.Client("tailor.cloudmqtt.com", 36503, "web_" + parseInt(Math.random() * 100,
            10));
        // client = new Paho.MQTT.Client("host", port, "client_id");
        //Example client = new Paho.MQTT.Client("m11.cloudmqtt.com", 32903, "web_" + parseInt(Math.random() * 100, 10));

        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;
        var options = {
            useSSL: true,
            userName: "lvntsnrq",
            password: "79W8iNWE4G9i",
            onSuccess: onConnect,
            onFailure: doFail
        }

        // connect the client
        client.connect(options);

        // called when the client connects
        function onConnect() {
            // Once a connection has been made, make a subscription and send a message.
            console.log("onConnect");
            // client.subscribe("sensor/#");
            client.subscribe("/cloudmqtt");

            // publish
            var i = 1;

            function myLoop() {
                setTimeout(function() {
                    var numRandom = Math.floor(Math.random() * 35).toString();
                    message = new Paho.MQTT.Message(numRandom);
                    message.destinationName = "/cloudmqtt";
                    client.send(message);
                    i++;
                    if (20) {
                        myLoop();
                    }
                }, 3000)
            }

            myLoop();
        }

        function doFail(e) {
            console.log(e);
        }

        // called when the client loses its connection
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("onConnectionLost:" + responseObject.errorMessage);
            }
        }

        var msg;
        // subscribe
        // called when a message arrives
        function onMessageArrived(message) {
            console.log("onMessageArrived:" + message.payloadString);
            msg = message.payloadString;
            var ul = document.getElementById("kontenMQTT");
            var li = document.createElement("li");
            var span = document.createElement("span");
            span.innerHTML = moment().format('<br> MMMM Do YYYY, h:mm:ss a');
            li.appendChild(document.createTextNode(msg));
            li.appendChild(span);
            li.setAttribute("class", "collection-item");
            ul.appendChild(li);
        }



        // used for example purposes
        function getRandomIntInclusive(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // create initial empty chart
        var ctx_live = document.getElementById("mycanvas");
        var myChart = new Chart(ctx_live, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    fill: false,
                    borderWidth: 1,
                    borderColor: '#00c0ef',
                    label: 'detakJantung',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        type: 'realtime' // auto-scroll on X axis
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                plugins: {
                    streaming: {
                        duration: 100000, // display data for the latest 
                        delay: 100,
                        onRefresh: function(myChart) { // callback on chart
                            myChart.data.datasets.forEach(function(dataset) {
                                dataset.data.push({
                                    x: Date.now(),
                                    y: parseFloat(msg)
                                });
                            });
                        }
                    }
                }
            }
        });


        // used for onclick flip a href
        // end of click function flipped object

        $('.flipbutton').click(function() {
            $(".card-y").toggleClass("active");
        });

    });
    </script>
</head>

<body>


    <div class="footer-fixed" id="menu">
        <nav class="z-depth-0 indigo lighten-1">
            <div id="nav-mobile" class="nav-wrapper">
                <a href="#" data-target="navigasi" class="sidenav-trigger right"><i
                        class="material-icons right">menu</i>Menu</a>
                <ul class="justify hide-on-med-and-down"
                    style="position: absolute; left: 50%; transform: translate(-50%);">
                    <li class="tab col s2"><a href="sass.html"><i class="material-icons left">search</i>Link with
                            Left Icon</a></li>
                    <li class="tooltipped tab col s2" data-position="top" data-tooltip="Github">
                        <a href="https://github.com/Apri1221?tab=repositories"><i class="material-icons">code</i></a>
                    </li>
                    <li class="tooltipped tab col s2" data-position="top" data-tooltip="LinkedIn">
                        <a class="active" href="https://www.linkedin.com/in/apriyanto-tobing-95b4b612a/"><i
                                class="material-icons">account_circle</i></a></li>
                    <li class="tooltipped tab col s2" data-position="top" data-tooltip="Medium">
                        <a href="https://medium.com/@apriyantotobing8"><i class="material-icons">book</i></a></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="navigasi">
            <li class="subheader center-align">Features</li>
            <li><a class="waves-effect active" href="#">Beranda</a></li>
            <div class="divider"></div>
            <li><a class="waves-effect" href="badges.html">Apri</a></li>
            <div class="divider"></div>
            <li><a class="waves-effect" href="collapsible.html">Kezia dan Dolin</a></li>
            <div class="divider"></div>
            <li><a class="waves-effect" href="mobile.html">Bersatu</a></li>
        </ul>
    </div>

    <div class="white no-pad-top">
        <div class="section amber darken-1 no-pad-bot z-depth-1 start-splash-section">
            <div class="container start-splash-container" style="margin-top:5em">
                <div class="row">
                    <div class="col s12 l6">
                        <div class="white-text">
                            <h4 class="white-text">
                                Create public kiosks, interactive digital signage and more with any Android&trade;
                                device. Display your web page(s) and prevent access to system settings &amp; other
                                applications.
                            </h4>
                            <a
                                href="https://play.google.com/store/apps/details?id=com.procoit.kioskbrowser&amp;utm_source=global_co&amp;utm_medium=prtnr&amp;utm_content=Mar2515&amp;utm_campaign=PartBadge&amp;pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"><img
                                    alt="Get it on Google Play"
                                    src="https://www.android-kiosk.com/wp-content/themes/androidkioskcom/images/google-play-badge.png"
                                    width="148"></a>
                            <!--<a class="waves-effect waves-light btn white text-primarycolor" style="margin-bottom:50px;margin-right: 10px;margin-top:0px;" href="http://sites.fastspring.com/androidkiosk/product/kioskbrowserpro"><i class="mdi mdi-credit-card left" ></i>Buy</a>-->
                            <a class="waves-effect waves-light btn white modal-trigger"
                                style="margin-bottom:50px;margin-right: 10px;margin-top:0px; color:black;"
                                href="#">Selengkapnya</a>
                        </div>
                        </p>
                    </div>
                    <div class="col s12 l6">
                        <div class="splash-image-container">
                            <img src="https://www.android-kiosk.com/wp-content/themes/androidkioskcom/images/splash5.png"
                                class="splash-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" style="margin-bottom:5em">

        <div class="section white">
            @if(Session::has('account'))
            <h2>Eh, hi {{ Session::get('account')['nama'] }} ! Long time no see</h2>
            @else
            <h2 class="header">Every heroes didnt wear a capes</h2>
            @endif
            <p class="grey-text text-darken-3 lighten-3">Love the process.</p>

            @if(Session::has('gagal'))
            <script>
            M.toast({
                html: "{{ Session::get('gagal') }}",
                timeRemaining: 10000
            });
            </script>
            @endif
        </div>
        <div class="parallax-container">
            <div class="parallax"><img src="https://brandjaws.com/images/boy.png"></div>
        </div>

        <div class="section white">
            <h3 class="header">Tertarik menggunakan layanan kami?</h3>

            <div class="row">
                <div class="col s12 l5">

                    <div class="card-y">
                        <div class="front">

                            <div class="card amber lighten-5">
                                <div class="card-content">
                                    <h5 class="center-align">Buat akun kamu</h5>
                                    <form action="{{ route('daftar') }}" method="POST">
                                        @csrf
                                        <div class="section">
                                            <div class="input-field">
                                                <i class="material-icons prefix">people</i>
                                                <label for="username_register">Username</label>
                                                <input type="text" id="username_register" name="nama" class="validate"
                                                    required="" aria-required="true" />
                                            </div>
                                            <div class="input-field">
                                                <i class="material-icons prefix">vpn_key</i>
                                                <label for="password_register">Password</label>
                                                <input type="password" id="password_register" name="password"
                                                    class="validate" required="" aria-required="true" />
                                            </div>
                                        </div>
                                        <p>Izinkan kami memberikan informasi terbaru terkait produk jelantah kepada kamu
                                            melalui
                                            email. Kami tidak akan spam</p>
                                        <div class="section">
                                            <div class="input-field">
                                                <i class="material-icons prefix">email</i>
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" class="validate" />
                                            </div>
                                            <div class="input-field">
                                                <i class="material-icons prefix">devices_other</i>
                                                <label for="perangkat">Perangkat</label>
                                                <input type="text" id="perangkat" name="perangkat" class="validate" />
                                            </div>
                                        </div>

                                        <div class="center-align">
                                            <button
                                                class="btn btn-block waves-effect waves-light indigo lighten-1 btn-large"
                                                type="submit" name="action">Daftar
                                            </button>
                                        </div>
                                        <br>
                                        <div class="center-align">
                                            <a class="flipbutton" id="registerButton">Sudah punya akun? Silakan masuk
                                                disini</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Login form -->
                        <div class="back">
                            <div class="card amber lighten-5">
                                <div class="card-content">
                                    <h5 class="center-align">Masuk ke akun kamu</h5>
                                    <form action="{{ route('masuk') }}" method="POST">
                                        @csrf
                                        <div class="section">
                                            <div class="input-field">
                                                <i class="material-icons prefix">people</i>
                                                <label for="username_login">Username</label>
                                                <input type="text" id="username_login" name="nama" class="validate"
                                                    required="" aria-required="true" />
                                            </div>
                                            <div class="input-field">
                                                <i class="material-icons prefix">vpn_key</i>
                                                <label for="password_login">Password</label>
                                                <input type="password" id="password_login" name="password"
                                                    class="validate" required="" aria-required="true" />
                                            </div>
                                            <!-- <div class="g-recaptcha"
                                                data-sitekey="6LeSSc4UAAAAABtMqxnHm15hXyxl6g9I-QQuFD_P"></div> -->
                                        </div>

                                        <div class="center-align">
                                            <button
                                                class="btn btn-block waves-effect waves-light indigo lighten-1 btn-large"
                                                type="submit" name="action">Masuk
                                            </button>
                                        </div>
                                        <br>
                                        <div class="center-align">
                                            <a class="flipbutton" id="loginButton">Belum punya akun? Silakan daftar
                                                disini</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 l7">
                    <div class="splash-image-container">
                        <img src="{{ asset('assets/image/undraw_Chef_cu0r.svg') }}" class="splash-image">
                    </div>
                </div>
            </div>
        </div>

        <div class="section white">

            <div>
                <h3>Visualisasi Data</h3>
                <canvas id="mycanvas"></canvas>
            </div>

            <ul class="collection with-header" id="kontenMQTT">
                <li class="collection-header">
                    <h4>Data Masuk</h4>
                </li>
            </ul>
        </div>

    </div>

    <!-- MQTT websocket -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- charting with chart js -->
    <script defer type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script defer type="text/javascript"
        src="https://github.com/nagix/chartjs-plugin-streaming/releases/download/v1.1.0/chartjs-plugin-streaming.js">
    </script>

    <!-- google captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
    $(document).ready(function() {
        $('.tooltipped').tooltip({
            delay: 50
        });

    });
    </script>

</body>

</html>