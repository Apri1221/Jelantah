<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengguna;

class PenggunaController extends Controller
{
    //
    public function index(){
        return pengguna::all();
    }


    public function create(request $request){
        $pengguna = new pengguna;
        $pengguna->nama = $request->nama;
        $pengguna->password = bcrypt($request->password);
        $pengguna->perangkat = $request->perangkat;
        $pengguna->save();

        return "Data berhasil disimpan";
    }


    public function update(request $request, $nama){
        $pengguna = pengguna::find($nama);
        $pengguna->nama = $request->nama;
        $pengguna->password = bcrypt($request->password);
        $pengguna->perangkat = $request->perangkat;
        $pengguna->save();

        return "Data berhasil diubah";
    }

    public function delete($nama){
        $pengguna = pengguna::find($nama);
        $pengguna->delete();

        return "Data berhasil dihapus";
    }

    public function get($nama){
        return pengguna::find($nama);
    }
}
