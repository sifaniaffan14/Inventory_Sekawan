<?php

namespace App\Http\Controllers;

use App\Models\divisi;
use App\Models\karyawan;
use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(){
        return view('admin.karyawan.index');
    }
    public function select(){
        try {
            if(isset($_GET['id'])){
                $operation = db::select('SELECT karyawans.*,divisis.nama_divisi FROM `karyawans`
                LEFT JOIN divisis
                ON karyawans.divisi_id = divisis.id
                WHERE karyawans.id = "' . $_GET['id'] . '" AND karyawans.is_active = 1');
            } else{ 
                $operation = db::select('SELECT karyawans.*,divisis.nama_divisi FROM `karyawans`
                LEFT JOIN divisis
                ON karyawans.divisi_id = divisis.id
                WHERE karyawans.is_active = 1');
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }
    public function getData()
    {
        $divisi = divisi::select('nama_divisi', 'id')->where('is_active', 1)->orderBy('nama_divisi', 'asc')->get();
        return $this->response($divisi);
    }
    public function insert(Request $request){
        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'nama_karyawan'=> 'required',
                'divisi_id'=> 'required',
                'jabatan'=> 'required',
            ]);
            DB::transaction(function () use ($data) {
                $role = role::where('nama_role', '=', $data['jabatan'])->first();
                $add = User::create([
                    'role_id' => $role['id'],
                    'username' => $data['nama_karyawan'],
                    'password' => bcrypt($data['jabatan'].'_123'),
                ]);

                $data['user_id'] = $add['id'];
                $anggota = karyawan::create($data);

            });

            $operation['success'] = true;
            return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }    
    public function update(Request $request){

        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'nama_karyawan'=> 'required',
                'divisi_id'=> 'required',
                'jabatan'=> 'required',
            ]);
            
            $data = karyawan::find(request()->id);
            $operation = $data->update($request->post());
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }
    public function delete(Request $request){
        
        try {            
            $data = $request->all();
            $data['is_active'] = 0;
            $operation = karyawan::find($data['id'])->update($data);

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
