<?php

namespace App\Http\Controllers\direktur;

use App\Http\Controllers\Controller;
use App\Models\driver;
use App\Models\kendaraan;
use App\Models\pemesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VerifikasiDirekturController extends Controller
{
    public function index()
    {
        return view('direktur/verifikasi/index');
    }
    public function select(){
        try {
                $operation = DB::select('SELECT pemesanans.*,karyawans.nama_karyawan, drivers.nama, kendaraans.nama_kendaraan 
                FROM `pemesanans`
                LEFT JOIN karyawans ON pemesanans.karyawan_id = karyawans.id
                LEFT JOIN drivers ON pemesanans.driver_id = drivers.id
                LEFT JOIN kendaraans ON pemesanans.kendaraan_id = kendaraans.id');
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }

    public function update(Request $request){

        try {
            $data = $request->all();  
            $operation = DB::transaction(function () use ($data) {
                    $find = pemesanan::find(request()->id);
                    if($data['status'] == 5){
                        kendaraan::where('id', $find['kendaraan_id'])->update([
                            'status' => '1'
                        ]);
                        driver::where('id', $find['driver_id'])->update([
                            'status' => '1'
                        ]);
                    }
                    return $find->update($data);
            }); 
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }
}
