<?php

namespace App\Http\Controllers;

use App\Models\driver;
use App\Models\karyawan;
use App\Models\kendaraan;
use App\Models\pemesanan;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function admin()
    {
        return view('admin/dashboard/index');
    }

    public function getData()
    {
        try {
            $getKendaraan = kendaraan::where('is_active', '=', '1')->count();
            $getKaryawan = karyawan::where('is_active', '=', '1')->count();
            $getDriver = driver::where('is_active', '=', '1')->count();
            $getPemesanan = pemesanan::count();
            return response()->json([
                'getKendaraan' => $getKendaraan,
                'getKaryawan' => $getKaryawan,
                'getDriver' => $getDriver,
                'getPemesanan' => $getPemesanan,
            ]);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function chartPemesanan()
    {
        try {
            $data = $request->all();
            
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
