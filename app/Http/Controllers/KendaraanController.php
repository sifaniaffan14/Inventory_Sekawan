<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(){
        return view('admin.kendaraan.index');
    }
    public function select(){
        try {
            if(isset($_GET['id'])){
                $operation = kendaraan::where('id',$_GET['id'])->where('is_active',1)->get();
            } else{ 
                $operation = kendaraan::where('is_active',1)->get();
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }
    public function insert(Request $request){
        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'kode_kendaraan'=> 'required',
                'nama_kendaraan'=> 'required',
                'merk'=> 'required',
                'tahun'=> 'required',
                'kondisi'=> 'required',
                'status'=> 'required',
            ]);
            
            $data = $request->post();
            $operation = kendaraan::create($data);
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
                'kode_kendaraan'=> 'required',
                'nama_kendaraan'=> 'required',
                'merk'=> 'required',
                'tahun'=> 'required',
                'kondisi'=> 'required',
                'status'=> 'required',
            ]);
            
            $data = kendaraan::find(request()->id);
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
            $operation = kendaraan::find($data['id'])->update($data);

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
