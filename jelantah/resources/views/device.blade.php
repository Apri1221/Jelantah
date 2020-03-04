@extends('layouts.app')
@section('content')
@push('html')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dashboard">
@endpush

@push('js_before')
<script>
$(document).ready(function() {
    $('.modal').modal();
    $('.collapsible').collapsible();
});
</script>
@endpush
<div class="container" style="margin-bottom:5em;">

    <div class="section">
        <h3 class="header">Dashboard
            <img style="width: 2em;" src="{{ asset('assets/images/ucok.png') }}" class="logo" alt="Traversy Media">
        </h3>

        <div class="row">
            <div class="col s12 l3">
                <div class="box sidebox center-align">
                    <div class="container-img">
                        <img class="circle"
                            src="https://d2hhj3gz5jljkm.cloudfront.net/assets2/149/753/007/616/normal/avatar.jpg" alt="">
                    </div>
                    <h5 class="title-obj">Ibunda {{ Session::get('account')['username'] }}</h5>
                    <p class="desc-obj grey-text text-darken-2">{{ Session::get('account')['email'] }}</p>
                </div>
                <div class="box sidebox">
                    <div class="site-nav">
                        <a class="nav-link" href="#">Riwayat Transaksi</a>
                        <a class="nav-link" href="#">Berlangganan</a>
                    </div>
                </div>

            </div>
            <div class="col s12 l9">
                <div class="box white">
                    <div class="row">
                        <a href="/dashboard"><h5 class="col s4 l4 left-align">Kembali</h5></a>
                        <h5 class="col s8 l8 right-align">20 Febuari 2020</h5>
                    </div>

                    <div id="modded" class="row">
                        <div class="col s12">
                            <h5>Outlet KFC Cabang Medan Empire.</h5>
                            <p>Klik bar untuk mengetahui informasi minyak jelantah yang kamu kumpulkan</p>
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header">

                                        <div class="progress blue lighten-4">
                                            <span>Tangki<i class="material-icons">info_outline</i></span>
                                            <div class="determinate blue" style="width: 60%; animation: grow 5s;">60%
                                            </div>
                                        </div>

                                    </div>
                                    <div class="collapsible-body">Ini adalah informasi terkait minyak jelantah yang
                                        telah kamu kumpulkan. Semakin besar persentasenya, maka sebaiknya kamu harus
                                        beritahu kami untuk menjemputnya.</div>
                                </li>
                            </ul>
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header">

                                        <div class="progress blue lighten-4">
                                            <span>Kualitas<i class="material-icons">info_outline</i></span>
                                            <div class="determinate blue" style="width: 85%; animation: grow 4s;">85%
                                            </div>
                                        </div>

                                    </div>
                                    <div class="collapsible-body">Informasi ini terkait kualitas minyak jelantah yang
                                        telah kamu kumpulkan. Kualitas bisa menjadi buruk jika kamu memasukkan hal-hal
                                        aneh ke dalamnya.</div>
                                </li>
                            </ul>

                            <br>
                            <div class="divider">
                            </div>
                            <div class="right-align">
                                <a class="btn waves-effect waves-light indigo lighten-1 btn-large modal-trigger"
                                    href="#modal1">Jemput</a>
                            </div>

                            <!-- Modal Structure -->
                            <div id="modal1" class="modal">
                                <div class="modal-content">
                                    <h4>Kamu ingin kami menjemput jelantah Anda?</h4>
                                    <p>Kamu boleh tambahkan informasi berikut ini agar kami tidak tersesat</p>

                                    <div class="input-field">
                                        <i class="material-icons prefix">phone</i>
                                        <label for="phone">Nomor telfon yang bisa dihubungi</label>
                                        <input type="tel" id="phone" name="phone" class="validate" />
                                    </div>
                                    <div class="input-field">
                                        <i class="material-icons prefix">location_on</i>
                                        <label for="lokasi">Alamat</label>
                                        <input type="text" id="lokasi" name="lokasi" class="validate" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!"
                                        class="modal-close waves-effect btn indigo lighten-1 btn">Konfirmasi</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection