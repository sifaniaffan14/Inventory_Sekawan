<?php

namespace App\Http\Controllers;

use App\Models\driver;
use App\Models\karyawan;
use App\Models\kendaraan;
use App\Models\pemesanan;
use Illuminate\Support\Facades\DB;
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

    public function chartPemesanan(Request $request)
    {
        try {
            $data = $request->all();
            $countsByMonth = [];
            for ($month = 1; $month <= 12; $month++) {
                $count = DB::table('pemesanans')
                    ->whereYear('created_at', '=', $data)
                    ->whereMonth('created_at', '=', $month)
                    ->count();

                $countsByMonth[] = $count;
            }
            
            return $countsByMonth; 

            
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
