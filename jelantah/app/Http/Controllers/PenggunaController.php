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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    
    public function create(request $request){
        if($request->wantsJson()){
            $pengguna = new pengguna;
            $pengguna->nama = $request->nama;
            $pengguna->password = bcrypt($request->password);
            $pengguna->email = $request->email;
            $pengguna->perangkat = $request->perangkat;
            $pengguna->save();

            return "Data berhasil disimpan";
        
        } else {
            // I'm from HTTP
            $pengguna = pengguna::create([
                'nama' => $request->nama,
                'password'=> bcrypt($request->password),
                'email' => $request->email,
                'perangkat' => $request->perangkat
            ]);
            return back();
        }
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