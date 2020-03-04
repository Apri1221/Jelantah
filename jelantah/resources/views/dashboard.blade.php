@extends('layouts.app')
@section('content')
@push('html')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dashboard">
@endpush

@push('js_before')
<script>
$(document).ready(function() {
    $('.modal').modal();
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
                        <h5 class="col s12 right-align">20 Febuari 2020</h5>
                    </div>

                    <div id="card-container" class="row">
                        <div class="col s12 m6 l6">
                            <div class="card">
                                <div class="card-content white-text">
                                    <div class="title-obj"><a href="/dashboard/device">Outlet
                                            KFC Cabang Medan Empire.</a>
                                    </div>
                                    <div class="divider"></div>
                                    <span class="card-subtitle grey-text text-darken-4">ID Perangkat: #501F4</span>
                                    <p class="card-subtitle grey-text text-darken-2">Jl. Bunga Lau No. 9 Medan, Sumatera
                                        Utara.</p>
                                </div>
                                <div class="card-action right-align">
                                    <a href="/dashboard/device">LIHAT</a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m6 l6">
                            <div class="card">
                                <div class="card-content white-text">
                                    <div class="title-obj"><a href="#">Outlet
                                            KFC Cabang Malang Sejagat.</a>
                                    </div>
                                    <div class="divider"></div>
                                    <span class="card-subtitle grey-text text-darken-4">ID Perangkat: #501F4</span>
                                    <p class="card-subtitle grey-text text-darken-2">Jl. Kawi No. 9 Malang, Jawa Timur.
                                    </p>
                                </div>
                                <div class="card-action right-align">
                                    <a href="#">LIHAT</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Trigger -->
                    <div style="position: relative; height: 70px;">
                        <div style="position: absolute; display: inline-block; right: 0px;">
                            <a class="btn-floating btn-large waves-effect waves-light red modal-trigger"
                                href="#modal1"><i class="material-icons">add</i></a>
                        </div>
                    </div>

                    <!-- Modal Structure -->
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <h4>Tambah perangkat Anda</h4>
                            <p>Isi informasi berikut ini</p>

                            <div class="input-field">
                                <i class="material-icons prefix">devices_other</i>
                                <label for="perangkat">ID Perangkat</label>
                                <input type="text" id="perangkat" name="perangkat" class="validate" />
                            </div>

                            <div class="input-field">
                                <i class="material-icons prefix">location_on</i>
                                <label for="lokasi">Alamat Perangkat</label>
                                <input type="text" id="lokasi" name="lokasi" class="validate" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect btn indigo lighten-1 btn">Tambah</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
@endsection