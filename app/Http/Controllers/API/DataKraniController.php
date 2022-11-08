<?php

namespace App\Http\Controllers\API;

use App\DataKrani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataKraniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('data_kranis')
        ->select('data_kranis.*', 'users.username', 'users.password')
        ->join('users', 'data_kranis.user_id', '=', 'users.id')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:25',
            'handphone' => 'required|string|max:10',
            'region' => 'required',
            'username' => 'required|string|max:10|unique:users',
            'password' => 'required',
        ]);

        $users = User::create([
            'name' => $request['nama'],
            'username' => $request['username'],
            'user_type' => 'Krani',
            'password' => Hash::make($request['password']),
        ]);

        return DataKrani::create([
            'user_id' => $users->id,
            'nama' => $request['nama'],
            'handphone' => $request['handphone'],
            'region' => $request['region'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($request['user_id']);
        $krani = DataKrani::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required|string|max:25',
            'handphone' => 'required|string|max:10',
            'region' => 'required',
            'username' => 'required|string|max:10|unique:users,username,'.$user->id,
            'password' => 'required',
        ]);
        $hashed = Hash::make($request['password']);
        if ($user->password != $hashed){
            $request['password'] = $hashed;
        }
        $user->update($request->all());
        $krani->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $krani = DataKrani::findOrFail($id);
        $user = User::findOrFail($krani->user_id);

        $krani->delete();
        $user->delete();
    }
}
