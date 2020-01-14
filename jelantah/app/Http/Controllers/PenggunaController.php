<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengguna;
use Hash;

class PenggunaController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\pengguna  $infographic
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if ($request->wantsJson()) {
            return pengguna::all();
        }
        else {
            return view('welcome');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(request $request)
    {
        if ($request->wantsJson()) {
            $pengguna = new pengguna;
            $pengguna->nama = $request->nama;
            $pengguna->password = bcrypt($request->password);
            $pengguna->email = $request->email;
            $pengguna->perangkat = $request->perangkat;
            $pengguna->save();

            return "Data berhasil disimpan";
        } else {
            // I'm from HTTP
            $whereClause = ['nama' => $request->nama];
            $result = pengguna::where($whereClause)->first();

            if ($result) {
                $request->session()->flash('gagal', 'Daftar gagal, username sudah ada');
                return back();
            } else {
                $pengguna = pengguna::create([
                    'nama' => $request->nama,
                    'password' => bcrypt($request->password),
                    'email' => $request->email,
                    'perangkat' => $request->perangkat
                ]);
                return back()->with('account', $result);
            }
            
        }
    }


    public function update(request $request, $nama)
    {
        // sepertinya belum work
        $whereClause = ['nama' => $nama];
        $pengguna = pengguna::where($whereClause)->get();
        $pengguna->nama = $request->nama;
        $pengguna->password = bcrypt($request->password);
        $pengguna->perangkat = $request->perangkat;
        $pengguna->save();

        return "Data berhasil diubah";
    }

    public function delete($nama)
    {
        $whereClause = ['nama' => $nama];
        pengguna::where($whereClause)->delete();

        return "Data berhasil dihapus";
    }

    public function get($nama)
    {
        $whereClause = ['nama' => $nama];
        return pengguna::where($whereClause)->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(request $request)
    {
        request()->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        $whereClause = ['nama' => $request->nama];
        
        $result = pengguna::where($whereClause)->first();
        $boolPass = Hash::check($request->password, $result->password);
        // kembaliannya berupa array karena sudah pakai where clause, maka disini kembaliannya pasti hanya 1 index
        // catatan, jika data ini di parsing ke view, gunakan ini --> @foreach ($collection as $object) 
        // {{ $object->title }}
        // @endforeach

        
        if ($result && $boolPass) { // return true jika ada        
            // Session::put('login', 'Selamat anda berhasil login');
            return redirect('/')->with('account', $result);
        } else {
            $request->session()->flash('gagal', 'Login gagal, data salah');
            return redirect('/');
        }
    }
}
