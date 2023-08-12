<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\driver;
use App\Models\kendaraan;
use App\Models\pemesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VerifikasiManagerController extends Controller
{
    public function index()
    {
        return view('manager/verifikasi/index');
    }
    public function select(){
        try {
                $user_id = session('user_id');
                $operation = DB::select('SELECT pemesanans.*, karyawan_pemesan.nama_karyawan as nama_pemesan, drivers.nama, kendaraans.nama_kendaraan 
                FROM `pemesanans`
                LEFT JOIN karyawans as karyawan_pemesan ON pemesanans.karyawan_id = karyawan_pemesan.id
                LEFT JOIN karyawans as karyawan_approval ON pemesanans.karyawan_approval_id = karyawan_approval.id
                LEFT JOIN drivers ON pemesanans.driver_id = drivers.id
                LEFT JOIN kendaraans ON pemesanans.kendaraan_id = kendaraans.id
                WHERE (pemesanans.karyawan_id = karyawan_pemesan.id OR pemesanans.karyawan_approval_id = karyawan_approval.id)
                AND karyawan_approval.user_id = ?', [$user_id]);
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
                    if($data['status'] == 3){
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
