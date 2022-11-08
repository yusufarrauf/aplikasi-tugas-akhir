<?php

namespace App\Http\Controllers\API;

use App\DataSupir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DataSupirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('data_supirs')
        ->select('data_supirs.*', 'data_kendaraans.jenis')
        ->join('data_kendaraans', 'data_supirs.nopol_kendaraan', '=', 'data_kendaraans.nopol')
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
            'alamat' => 'required|max:50',
            'handphone' => 'required|max:15',
            'tanggal_lahir' => 'required',
            'nopol_kendaraan' => 'required',
        ]);
        return DataSupir::create([
            'nama' => $request['nama'],
            'alamat' => $request['alamat'],
            'handphone' => $request['handphone'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'nopol_kendaraan' => $request['nopol_kendaraan'],
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
        $supir = DataSupir::findOrFail($id);
        return $supir->nopol_kendaraan;
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
        $supir = DataSupir::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required|string|max:25',
            'alamat' => 'required|max:50',
            'handphone' => 'required|max:15',
            'tanggal_lahir' => 'required',
            'nopol_kendaraan' => 'required',
        ]);
        $supir->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supir = DataSupir::findOrFail($id);
        $supir->delete();
    }
}
