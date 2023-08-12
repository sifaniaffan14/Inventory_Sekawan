<?php

namespace App\Http\Controllers;

use App\Models\driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(){
        return view('admin.driver.index');
    }
    public function select(){
        try {
            if(isset($_GET['id'])){
                $operation = driver::where('id',$_GET['id'])->where('is_active',1)->get();
            } else{ 
                $operation = driver::where('is_active',1)->get();
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
                'kode_driver'=> 'required',
                'nama'=> 'required',
                'status'=> 'required',
            ]);
            
            $data = $request->post();
            $operation = driver::create($data);
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
                'kode_driver'=> 'required',
                'nama'=> 'required',
                'status'=> 'required',
            ]);
            
            $data = driver::find(request()->id);
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
            $operation = driver::find($data['id'])->update($data);

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
