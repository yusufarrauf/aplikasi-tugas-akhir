<?php

namespace App\Http\Controllers\API;

use App\DataKendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataKendaraan::all();
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
            'nopol' => 'required|string|max:10|unique:data_kendaraans',
            'jenis' => 'required',
        ]);
        return DataKendaraan::create([
            'nopol' => $request['nopol'],
            'jenis' => $request['jenis'],
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
        $kendaraan = DataKendaraan::findOrFail($id);
        $this->validate($request, [
            'nopol' => 'required|string|max:10|unique:data_kendaraans,nopol,'.$kendaraan->id,
            'jenis' => 'required',
        ]);
        $kendaraan->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kendaraan = DataKendaraan::findOrFail($id);
        $kendaraan->delete();
    }
}
