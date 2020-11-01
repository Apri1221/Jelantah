<!DOCTYPE html>
@stack('html')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jelantah</title>

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

    <style>
    #loader {
        width: 100%;
        height: 100%;
        z-index: 99998;
    }

    .center {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }
    </style>

    <script>
    document.onreadystatechange = function() {
        if (document.readyState == "complete") {
            document.querySelector("#loader").style.display = "none";
            document.querySelector("body").style.visibility = "visible";
            $('.sidenav').sidenav({
                edge: 'right', // <--- CHECK THIS OUT
            });
        } else {
            document.querySelector("body").style.visibility = "hidden";
            document.querySelector("#loader").style.visibility = "visible";
        }
    };
    </script>
    @stack('js_before')

    @stack('css_before')

    <!-- Styles -->
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body style="visibility:hidden">
    <div id="loader">
        @php
        $message = array("We are working for this!", "Here we go!", "Waiting is bad idea", "Just a milisecond");
        $randIndex = array_rand($message);
        @endphp
        <h4 class="center" style="margin-top: 50%" id="msg_load">{{ $message[$randIndex] }}</h4>
        <div class="preloader-wrapper big active center">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-fixed" id="menu">
        <nav class="z-depth-0 indigo lighten-1">
            <div id="nav-mobile" class="nav-wrapper">
                <a href="#" data-target="navigasi" class="sidenav-trigger right"><i
                        class="material-icons right">menu</i>Menu</a>
                <ul class="justify hide-on-med-and-down"
                    style="position: absolute; left: 50%; transform: translate(-50%);">
                    <li class="tab col s2"><a href="/"><i class="material-icons left">home</i>Beranda</a></li>
                    <li class="tab col s2"><a href="/dashboard"><i
                                class="material-icons left">dashboard</i>Dashboard</a></li>
                    <!-- <li class="tooltipped tab col s2" data-position="top" data-tooltip="LinkedIn">
                        <a class="active" href="https://www.linkedin.com/in/apriyanto-tobing-95b4b612a/"><i class="material-icons">account_circle</i></a></li> -->
                    <li class="tab col s2"><a href="#"><i
                                class="material-icons left">account_circle</i>Personalisasi</a></li>
                </ul>
            </div>
        </nav>
        @php
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        @endphp

        <ul class="sidenav" id="navigasi">
            <li class="subheader center-align">Menu</li>
            <div class="divider"></div>
            <li><a class="waves-effect 
            @php
            if ($controller == 'HomeController'){
                echo ' active';
            }
            @endphp" href="/"><i class="material-icons left">home</i>Beranda</a></li>
            <div class="divider"></div>
            <li><a class="waves-effect 
            @php
            if ($controller == 'DashboardController'){
                echo ' active';
            }
            @endphp" href="/dashboard"><i class="material-icons left">dashboard</i>Dashboard</a></li>
            <div class="divider"></div>
            <li><a class="waves-effect 
            @php
            if ($controller == 'AccountController'){
                echo ' active';
            }
            @endphp" href="#"><i class="material-icons left">account_circle</i>Personalisasi</a></li>
            <div class="divider"></div>
        </ul>
    </div>

    @yield('content')

    <!-- MQTT websocket -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- charting with chart js -->
    <script defer type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script defer type="text/javascript"
        src="https://github.com/nagix/chartjs-plugin-streaming/releases/download/v1.1.0/chartjs-plugin-streaming.js">
    </script>

    <script>
    $(document).ready(function() {
        $('.tooltipped').tooltip({
            delay: 50
        });

    });
    </script>

</body>

</html>