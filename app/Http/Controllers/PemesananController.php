<?php

namespace App\Http\Controllers;

use App\Models\driver;
use App\Models\karyawan;
use App\Models\kendaraan;
use App\Models\pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PemesananController extends Controller
{
    public function index(){
        return view('admin.pemesanan.index');
    }
    public function select(){
        try {
            if(isset($_GET['id'])){
                $operation = db::select('SELECT pemesanans.*,karyawan_pemesan.nama_karyawan as nama_pemesan, karyawan_approval.nama_karyawan as nama_approval, 
                drivers.nama, kendaraans.nama_kendaraan 
                FROM `pemesanans`
                LEFT JOIN karyawans as karyawan_pemesan ON pemesanans.karyawan_id = karyawan_pemesan.id
                LEFT JOIN karyawans as karyawan_approval ON pemesanans.karyawan_approval_id = karyawan_approval.id
                LEFT JOIN drivers ON pemesanans.driver_id = drivers.id
                LEFT JOIN kendaraans ON pemesanans.kendaraan_id = kendaraans.id
                WHERE pemesanans.id = "' . $_GET['id'] . '" ');
            } else{ 
                $operation = db::select('SELECT pemesanans.*,karyawan_pemesan.nama_karyawan as nama_pemesan, karyawan_approval.nama_karyawan as nama_approval, 
                drivers.nama, kendaraans.nama_kendaraan 
                FROM `pemesanans`
                LEFT JOIN karyawans as karyawan_pemesan ON pemesanans.karyawan_id = karyawan_pemesan.id
                LEFT JOIN karyawans as karyawan_approval ON pemesanans.karyawan_approval_id = karyawan_approval.id
                LEFT JOIN drivers ON pemesanans.driver_id = drivers.id
                LEFT JOIN kendaraans ON pemesanans.kendaraan_id = kendaraans.id');
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }
    public function getData()
    {
        $kendaraan = kendaraan::select('kode_kendaraan', 'nama_kendaraan', 'merk', 'tahun', 'kendaraans.id')->where('is_active', 1)->where('status', 1)->orderBy('nama_kendaraan', 'asc')->get();
        $driver = driver::select('kode_driver', 'nama', 'drivers.id')->where('is_active', 1)->where('status', 1)->orderBy('nama', 'asc')->get();
        $karyawan = karyawan::select('nama_karyawan', 'divisi_id','jabatan', 'karyawans.id', 'divisis.nama_divisi')->join('divisis', 'divisis.id', 'karyawans.divisi_id')->where('karyawans.is_active', 1)->orderBy('nama_karyawan', 'asc')->get();
        // $approval = karyawan::select('nama_karyawan', 'divisi_id', 'jabatan', 'karyawans.id', 'divisis.nama_divisi')
        //                     ->join('divisis', 'divisis.id', 'karyawans.divisi_id')
        //                     ->where('karyawans.is_active', 1)
        //                     ->where('jabatan', 'Manager')
        //                     ->orderBy('nama', 'asc')->get();
        return $this->response(
            [
                'kendaraan'  => $kendaraan,
                'driver'   =>  $driver,
                'karyawan'   =>  $karyawan,
                // 'approval'   =>  $approval,
            ]
        );
    }
    public function insert(Request $request){
        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'karyawan_id'=> 'required',
                'driver_id'=> 'required',
                'karyawan_approval_id'=> 'required',
                'kendaraan_id'=> 'required',
            ]);
            $operation= DB::transaction(function () use ($data) {
                kendaraan::where('id', $data['kendaraan_id'])->update([
                    'status' => '2'
                ]);
                driver::where('id', $data['driver_id'])->update([
                    'status' => '2'
                ]);
                $data['status']=1;
                return pemesanan::create($data);

            });
            return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }      
    public function update(Request $request){

        try {
            $data = $request->all();
            $request->validate([
                'karyawan_id'=> 'required',
                'driver_id'=> 'required',
                'karyawan_approval_id'=> 'required',
                'kendaraan_id'=> 'required',
            ]);
            
            $data = pemesanan::find(request()->id);
            $operation = $data->update($request->post());
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }
    public function delete(Request $request){
        
        try {            
            $data = $request->all();
            $operation= DB::transaction(function () use ($data) {
                $find = karyawan::find($data['id']);
                kendaraan::where('id', $data['kendaraan_id'])->update([
                    'status' => '2'
                ]);
                driver::where('id', $data['driver_id'])->update([
                    'status' => '2'
                ]);
                return pemesanan::deleted($find);

            });
            print_r($operation);exit;
            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }

    public function onDownload(Request $request){
        try {
            $data = $request->all();
            $operation = Collection::make($data);

            $countsByMonth = [];
            for ($month = 1; $month <= 12; $month++) {
                $count = DB::table('pemesanans')
                    ->whereYear('created_at', '=', $_GET['tahun'])
                    ->whereMonth('created_at', '=', $month)
                    ->count();

                $countsByMonth[] = $count;
            }
            // print_r($_GET['tahun']);exit;
            // Mengubah hasil query builder menjadi koleksi Laravel
            

            $spreadsheet = IOFactory::load($_SERVER['DOCUMENT_ROOT'].'/template_laporan/template_laporan.xlsx');;
            $sheet = $spreadsheet->getActiveSheet();
            
            $sheet->setCellValue('B12', $_GET['tahun']);
            $column = 'C';
            foreach ($countsByMonth as $count) {
                $sheet->setCellValue($column.'12', $count);
                $sheet->getStyle($column.'12')->getBorders()->getAllBorders();
                $column++;
            }


            $writer = new Xlsx($spreadsheet);

            $folderPath = $_SERVER['DOCUMENT_ROOT'].'/upload_files';
            if (!is_dir($folderPath)) {
                mkdir($folderPath);
            }
            $fileName = 'Laporan_Peminjaman_'.$_GET['tahun'].'_'.time().'.xlsx';
            $url = $folderPath.'/'.$fileName;
            $writer->save($url);

            $operation['fileName'] = $fileName;
            return $this->response($operation);
        } catch (\Exception $e) {
            // return $this->responseCreate('Data yang dipilih kosong!',true);
            return $this->responseCreate($e->getMessage(),true);
        }
        
    }
}
