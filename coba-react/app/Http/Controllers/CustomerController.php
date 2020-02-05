<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Hash;
use Session;

// Let the same controllers handle api and web requests is not the best decision. Sooner or later this logic will lead to the mess in your code.

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->is('api/*')) {
            return Customer::all();
        }
        else {
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // this code to create user Customer
        if ($request->is('api/*')) {
            $customer = new Customer;
            $customer->username = $request->username;
            $customer->password = bcrypt($request->password);
            $customer->email = $request->email;
            $customer->save();

            return "Data berhasil disimpan";
        } else {
            // I'm from HTTP
            $whereClause = ['username' => $request->username];
            $result = Customer::where($whereClause)->first();

            if ($result) {
                $request->session()->flash('gagal', 'Daftar gagal, username sudah ada');
                return back();
            } else {
                $data = [
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'email' => $request->email,
                ];
                $customer = Customer::create($data);
                Session::put('account', $data);
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Customer $customer)
    public function update(Request $request, $username)
    {
        //
        $whereClause = ['username' => $username];
        $customer = Customer::where($whereClause)->get();
        $customer->username = $request->username;
        $customer->password = bcrypt($request->password);
        $customer->save();

        return "Data berhasil diubah";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Customer $customer)
    public function destroy($username)
    {
        //
        $whereClause = ['username' => $username];
        Customer::where($whereClause)->delete();

        return "Data berhasil dihapus";
    }


    public function get($username)
    {
        $whereClause = ['username' => $username];
        return Customer::where($whereClause)->first();
    }


    public function login(Request $request)
    {
        // I'm from HTTP
        $whereClause = ['username' => $request->username];
        $result = Customer::where($whereClause)->first();
        $boolPass = Hash::check($result['password'], $request->password);

        if ($result && $boolPass) {
            $request->session()->flash('gagal', $request->password);
            return back();
        } else {
            $data = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
            ];
            Session::put('account', $data);
            return back();
        }
    }
}