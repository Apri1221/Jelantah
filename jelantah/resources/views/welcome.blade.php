@extends('layouts.app')
@section('content')
@push('html')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endpush
@push('css_before')
<style>
.showcase::after {
    content: '';
    height: 60vh;
    width: 100%;
    background-image: url("http://localhost/assets/images/showcase_jelantah.jpg");
    background-size: cover, cover;
    background-position: center, center;
    background-repeat: no-repeat;
    background-position: center;
    transform: scale(0.998);
    display: block;
    filter: blur(10px);
    -webkit-filter: blur(10px);
    transition: all 1000ms;
}

.showcase:hover::after {
    transform: scale(1);
    filter: blur(0px);
    -webkit-filter: blur(0px);
}

.showcase:hover .content {
    filter: blur(2px);
    -webkit-filter: blur(2px);
}

.content {
    position: absolute;
    z-index: 1;
    top: 5%;
    left: 50%;
    margin-top: 5%;
    margin-left: -155px;
    width: 350px;
    height: 350px;
    text-align: center;
    transition: all 1000ms;
    color: white
}

.content .logo {
    height: 180px;
    width: 180px;
}

.content .title {
    font-size: 2.2rem;
    margin-top: 1rem;
}

.content .text {
    line-height: 1.7;
    margin-top: 1rem;
}
</style>
@endpush

@push('js_before')

<script>
$(document).ready(function() {
    $('.materialboxed').materialbox();

    $('.parallax').parallax();

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
        // console.log("onMessageArrived:" + message.payloadString);
        console.log("onMessageArrived:" + message.destinationName);
        msg = message.payloadString;
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
                    duration: 50000, // display data for the latest 
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
@endpush


<div class="container" style="margin-bottom:5em">

    <div class="section white">

        @if(Session::has('account'))
        <h2>Eh, hi {{ Session::get('account')['username'] }} ! Long time no see</h2>
        @else
        <h2 class="header">With
            <img style="width: 2em;" src="{{ asset('assets/images/ucok.png') }}" class="logo" alt="Traversy Media">
            , everyone can be heroes</h2>
        @endif

        @if(Session::has('gagal'))
        <script>
        M.toast({
            html: "{{ Session::get('gagal') }}",
            timeRemaining: 10000
        });
        </script>
        @endif
    </div>
    <div class="parallax-container" style="height: 500px">
        <div class="parallax" style="margin-top: -15em"><img src="{{ asset('assets/images/boy.png') }}"></div>
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
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="section">
                                        <div class="input-field">
                                            <i class="material-icons prefix">people</i>
                                            <label for="username_register">Username</label>
                                            <input type="text" id="username_register" name="username" class="validate"
                                                required="" aria-required="true" />
                                        </div>
                                        <div class="input-field">
                                            <i class="material-icons prefix">vpn_key</i>
                                            <label for="password_register">Password</label>
                                            <input type="password" id="password_register" name="password"
                                                class="validate" required="" aria-required="true" />
                                        </div>
                                        <div class="input-field">
                                            <i class="material-icons prefix">email</i>
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="validate" required=""
                                                aria-required="true" />
                                        </div>
                                    </div>
                                    <p>Jika kamu memiliki perangkat, masukkan ID perangkat yang telah kamu miliki pada
                                        kolom berikut.</p>
                                    <div class="section">
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
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="section">
                                        <div class="input-field">
                                            <i class="material-icons prefix">people</i>
                                            <label for="username_login">Username</label>
                                            <input type="text" id="username_login" name="username" class="validate"
                                                required="" aria-required="true" />
                                        </div>
                                        <div class="input-field">
                                            <i class="material-icons prefix">vpn_key</i>
                                            <label for="password_login">Password</label>
                                            <input type="password" id="password_login" name="password" class="validate"
                                                required="" aria-required="true" />
                                        </div>
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
                    <img src="{{ asset('assets/images/undraw_Chef_cu0r.svg') }}" class="splash-image">
                </div>
            </div>
        </div>
    </div>

    <div class="section white">
        <div>
            <h3>Visualisasi Data</h3>
            <canvas id="mycanvas"></canvas>
        </div>

        <h3>Bagan di atas </h3>
        <p>menunjukkan pada Anda ada data yang masuk melalui protokol MQTT dan dapat ditampilkan pada laman web ini.
            Nantinya data tersebut merupakan data yang diakuisisi dari drum milik Anda.</p>
    </div>

    <div class="section white">
        <div>
            <h3>Latar Belakang</h3>
            <p>Kami mengembangkan ide bagaimana caranya minyak jelantah (used cooking oil) menjadi memiliki nilai.
                Faktor-faktor yang mendasari kami mengembangkan ide ini ada tiga, yaitu bagaimana mensejahterakan
                masyarakat melalui ide yang sederhana, dibutuhkan solusi untuk mengelola limbah (jelantah), serta ada
                peluang untuk memanfaatkan teknologi yang ada. <br>
            </p>
            <p>
                Kami ingin mengembangkan suatu sistem pengumpulan minyak jelantah yang memanfaatkan teknologi Internet
                of Things. Sistem yang diusulkan dikombinasikan dengan produk berupa drum yang nantinya memantau dan
                memetakan di daerah mana saja minyak jelantah yang harus kami jemput berdasarkan informasi yang
                dikirimkan dari perangkat kemudian dijual kepada para pengolah minyak jelantah. <br>
            </p>
            <p>
                Keuntungan yang didapat dari penjualan minyak jelantah tersebut kemudian dibagi kepada
                kami dan para pengguna kami yaitu masyarakat yang telah mengumpulkan jelantah mereka tersebut. Harapan
                kami semua dapat diuntungkan dengan konsep bisnis ini. <br>
            </p>
            <p>Di masa yang akan datang, kami berencana untuk mengolah minyak jelantah tersebut secara mandiri. <br>
            </p>
        </div>
        
        <div>
            <h3>Alur Bisnis</h3>
            <img class="materialboxed" src="{{ asset('assets/images/alur.jpeg') }}" class="splash-image">
            <h3>Prototype</h3>
            <img class="materialboxed" src="{{ asset('assets/images/prototype.png') }}" class="splash-image">
        </div>
    </div>

</div>
@endsection