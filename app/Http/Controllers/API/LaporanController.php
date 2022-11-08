<?php

namespace App\Http\Controllers\API;

use App\BongkarMuat;
use App\BongkarMuatDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function inputBongkarMuat(Request $request)
    {
        $dataKontainer = $request['data_kontainer'];
        $bongkar_muat = BongkarMuat::create([
            'id_krani' => $request['krani'],
            'tujuan' => $request['tujuan'],
            'kota' => $request['kota'],
            'jenis' => $request['jenis'],
            'status' => 'Created'
        ]);

        for($i =0; $i < count($dataKontainer); $i++){
            BongkarMuatDetail::create([
                'id_bongkar_muat' => $bongkar_muat->id,
                'id_supir' => $dataKontainer[$i]['supir'],
                'nomor_kontainer' => $dataKontainer[$i]['nomor_kontainer'],
                'nomor_segel' => $dataKontainer[$i]['nomor_segel'],
                'status' => 'Created'
            ]);
        }
    }
    public function dataBongkarMuat()
    {
        return DB::table('bongkar_muats')
        ->select('bongkar_muats.*', 'data_kranis.nama as nama_krani')
        ->join('data_kranis', 'bongkar_muats.id_krani', '=', 'data_kranis.id')
        ->get();
    }
    public function filterBongkarMuat(Request $request)
    {
        if($request['jenis'] == "Semua"){
            $op_jenis = "!=";
        } else {
            $op_jenis = "=";
        }
        if ($request['krani'] == "Semua") {
            $op_krani = "!=";
        } else {
            $op_krani = "=";
        }
        return DB::table('bongkar_muats')
        ->select('bongkar_muats.*', 'data_kranis.nama as nama_krani')
        ->join('data_kranis', 'bongkar_muats.id_krani', '=', 'data_kranis.id')
        ->where('bongkar_muats.id_krani', $op_krani, $request['krani'])
        ->where('bongkar_muats.jenis', $op_jenis, $request['jenis'])
        ->whereMonth('bongkar_muats.created_at', '=', $request['bulan']+1)
        ->whereYear('bongkar_muats.created_at', '=', $request['tahun'])
        ->get();
    }
    public function detailBongkarMuat($id)
    {
        return
        DB::table('bongkar_muat_details')
        ->select('bongkar_muat_details.*', 'data_supirs.nama as nama_supir', 'data_kendaraans.nopol', 'data_kendaraans.jenis')
        ->join('data_supirs', 'bongkar_muat_details.id_supir', '=', 'data_supirs.id')
        ->join('data_kendaraans', 'data_supirs.nopol_kendaraan', '=', 'data_kendaraans.nopol')
        ->where('bongkar_muat_details.id_bongkar_muat', '=', $id)
        ->get();
    }

    public function bongkarMuat()
    {
        return DB::table('bongkar_muat_details')
        ->select('bongkar_muat_details.*', 'data_kranis.user_id as id_user', 'bongkar_muats.tujuan', 'bongkar_muats.kota', 'bongkar_muats.jenis', 'data_supirs.nama as nama_supir', 'data_kendaraans.nopol', 'data_kendaraans.jenis as jenis_kontainer')
        ->join('data_supirs', 'bongkar_muat_details.id_supir', '=', 'data_supirs.id')
        ->join('data_kendaraans', 'data_supirs.nopol_kendaraan', '=', 'data_kendaraans.nopol')
        ->join('bongkar_muats', 'bongkar_muat_details.id_bongkar_muat', '=', 'bongkar_muats.id')
        ->join('data_kranis', 'bongkar_muats.id_krani', '=', 'data_kranis.id')
        ->get();
    }

    public function updateBongkarMuat(Request $request)
    {
        $gambar = "";
        $status = $request['status'];
        if($status == 'Inspection' || $status == 'Unload' || $status == 'Load'){
            $this->validate($request, [
                'photo' => 'required',
            ]);

            $photo = $request['photo'];
            $gambar = time() . '.' . explode('/', explode(':', substr($photo, 0, strpos($photo, ';')))[1])[1];
            \Image::make($request->get('photo'))->save(public_path('img/') . $gambar);
        }
        $data = BongkarMuatDetail::findOrFail($request['id']);
        $data->update($request->all());

        if ($status == 'Inspection') {
            $data->form_inspeksi = $gambar;
        } else if ($status == 'Unload' || $status == 'Load'){
            $data->form_tally = $gambar;
        }
        $data->save();

        $all_data = BongkarMuatDetail::where('id_bongkar_muat', '=', $data->id_bongkar_muat)->get();
        $done_data = BongkarMuatDetail::where('id_bongkar_muat', '=', $data->id_bongkar_muat)
        ->where('status', '=', 'Done')->get();

        if (count($done_data) == count($all_data)){
            $done = BongkarMuat::findOrFail($data->id_bongkar_muat);
            $done->status = 'Done';
            $done->save();
        }
    }
}
