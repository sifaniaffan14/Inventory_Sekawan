@extends('master.app')

@section('content')

<div>
    <div class="main_data row gy-5 g-xl-8">
        <div class="col-12">
            <div class="filter-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
                <div class="card-header">
                    <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                        <span class="material-icons" style="color:#264A8A"> filter_alt </span> Filter
                    </h2>
                </div>
                <div class="card-body">
                    <!-- <div class="d-flex flex-column flex-lg-row flex-stack  mx-auto"
                    style="border-bottom: 1px solid #eff2f5; width:90%"> -->
                    <div class="row">
                        <div class="col-lg-3 col-12 d-flex flex-center gap-3 mb-3 mb-lg-0">
                            <label class="form-label fw-bolder min-w-70px">Tahun : </label>
                            <select class="form-control" name="tahun" id="tahun" style="">
                                <option value="" selected disabled hidden>Pilih tahun</option>
                            </select>
                        </div>
                        <div class="col-lg-3 d-flex flex-center gap-4">
                            
                            <button type="button" class="btn btn-sm text-light w-50"
                                    style="background-color:#009d37;"
                                    onclick="onDownload()">
                                    <span class="material-icons fs-6 pt-2"> print </span>
                                    <span class="fs-6">Cetak</span>
                                </button>
                        </div>
                </div>
                </div>  
            </div>
            <div class="data-card card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
border-radius: 10px;">
                <div class="card-header">
                    <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0">
                        <span class="material-icons" style="color:#264A8A"> text_snippet </span> Data Kendaraan
                    </h2>
                </div>
                <div class="d-flex flex-column flex-lg-row flex-stack py-5 px-9"
                    style="border-bottom: 1px solid #eff2f5">
                    <div class="d-flex flex-column flex-lg-row gap-5 align-items-lg-center w-100">
                        <label for="search_pemesanan" class="fs-4">Search</label>
                        <div class="position-relative w-lg-50">
                            <input type="search" name="search_pemesanan" id="search_pemesanan"
                                placeholder="Ketik untuk mencari" class="border-0 py-4 ps-12 pe-5 fs-5 w-100"
                                style="background-color: #fafafa;border-radius: 6px;" />
                            <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                style="left: 10px"> search </span>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-5">
                        <button type="button"
                            class="btn btn-outline-primary btn-outline border-2 text-body m-0 fw-bolder w-100 d-flex flex-center p-3"
                            onclick="onRefresh(this)">
                            <span class="material-icons fs-2"> refresh </span>
                        </button>
                        <button type="button" class="btn m-0 d-flex flex-center gap-2 fw-bolder w-100 text-light"
                            style="background-color:#264A8A"
                            onclick="loadForm()">
                            <span class="material-icons fs-2"> add </span> Tambah </button>
                    </div>
                </div>
                <div class="card-body py-0">
                    <table id="tabelPemesanan" class="table">
                        <thead>
                            <tr>
                                <th class="fw-bolder" style="max-width: 37px"> No </th>
                                <th class="fw-bolder">Nama Karyawan</th>
                                <th class="fw-bolder">Nama Kendaraan</th>
                                <th class="fw-bolder">Nama Driver</th>
                                <th class="fw-bolder">Nama Approval</th>
                                <th class="fw-bolder">Status</th>
                                <th class="fw-bolder">Detail</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pemesanan.form')
</div>

@endsection

@section('js')
@include('admin.pemesanan.javascript')
@endsection