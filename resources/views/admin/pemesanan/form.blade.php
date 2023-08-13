<div class="form_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
            <div class="card-header border-0 d-flex align-items-center justify-content-between position-sticky top-0 bg-white" style="z-index: 99;">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 actCreate actCreate1">Tambah Data</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none actEdit actEdit1">Edit Data</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none dataPemesanan">Data Pemesanan</h2>
                <div class="form-action-wrapper d-flex gap-4 align-items-center mt-5 w-50 justify-content-end">
                    <button type="button" class="btn text-body m-0 fw-bolder w-25 actCreate" style="border:1px solid #264A8A;" onclick="closeForm()"> <span style="color:#264A8A">Batal</span> </button>
                    <button type="button" class="btn m-0 d-flex flex-center gap-2 fw-bolder w-25 text-light actCreate" style="background-color:#264A8A" onclick="onSubmitForm()">
                        <span class="material-icons-outlined fs-2">save</span> Simpan 
                    </button>
                    <button type="button" onclick="onDisplayEdit(this)" class="btn btn-warning text-light border-2 d-flex flex-center gap-2 m-0 fw-bolder w-25 d-none actEdit">
                        <span class="material-icons-outlined">edit</span> Ubah
                    </button>
                    <button type="button" onclick="onDelete(this)" class="btn btn-danger m-0 d-flex flex-center gap-2 fw-bolder w-25 d-none actEdit" data-roleable="true" data-role="Bandara.Delete">
                        <span class="material-icons-outlined">delete</span> Hapus
                    </button>
                </div>
            </div>
            <div class="card-body py-0 mt-5 pt-5">
                <form onsubmit="onSave(event)" class="d-flex flex-wrap gap-5 justify-content-center" id="formPemesanan" name="formPemesanan" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="d-flex flex-column gap-1 pe-5 mdl" style="width:49%" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalPemesan">
                        <label for="selectKaryawan" class="fw-bolder">Nama Pemesan</label>
                        <select id="selectKaryawan" style="width: 100%" disabled>
                            <option value="#" selected disabled>Silahkan Pilih Pemesan</option>
                        </select>
                        <input type="hidden" name="karyawan_id" id="karyawan_id" value="">
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5 mdl" style="width:49%" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalKendaraan">
                        <label for="selectKendaraan" class="fw-bolder">Nama Kendaraan</label>
                        <select id="selectKendaraan" style="width: 100%" disabled>
                            <option value="#" selected disabled>Silahkan Pilih Kendaraan</option>
                        </select>
                        <input type="hidden" name="kendaraan_id" id="kendaraan_id" value="">
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5 mdl" style="width:49%" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalDriver">
                        <label for="selectDriver" class="fw-bolder">Nama Driver</label>
                        <select id="selectDriver" style="width: 100%" disabled>
                            <option value="#" selected disabled>Silahkan Pilih Driver</option>
                        </select>
                        <input type="hidden" name="driver_id" id="driver_id" value="">
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5 mdl" style="width:49%" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalApproval">
                        <label for="selectApproval" class="fw-bolder">Nama Approval</label>
                        <select id="selectApproval" style="width: 100%" disabled>
                            <option value="#" selected disabled>Silahkan Pilih Pihak Approval</option>
                        </select>
                        <input type="hidden" name="karyawan_approval_id" id="karyawan_approval_id" value="">
                    </div>
                   <!-- Modal Pemesanan-->
                    <div class="modal fade modalPemesan" id="modalPemesan" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content p-5">
                            <div class="modal-body">
                                <div class="position-relative">
                                    <input type="search" name="search_pemesan" id="search_pemesan"
                                        placeholder="Ketik untuk mencari" class="py-3 ps-12 pe-5 fs-6 w-100"
                                        style="background-color: #fafafa;border-radius: 6px; border-width:1.5px" />
                                    <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                        style="left: 10px"> search </span>
                                </div>
                                <table class="table" id="tabelPemesan" style="cursor:pointer">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder" style="max-width: 37px"> No </th>
                                            <th class="fw-bolder d-none">Id</th>
                                            <th class="fw-bolder">Nama</th>
                                            <th class="fw-bolder">Divisi</th>
                                            <th class="fw-bolder">Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal Pemesanan-->
                    <!-- Modal Kendaraan-->
                     <div class="modal fade modalKendaraan" id="modalKendaraan" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content p-5">
                            <div class="modal-body">
                                <div class="position-relative">
                                    <input type="search" name="search_kendaraan" id="search_kendaraan"
                                        placeholder="Ketik untuk mencari" class="py-3 ps-12 pe-5 fs-6 w-100"
                                        style="background-color: #fafafa;border-radius: 6px; border-width:1.5px" />
                                    <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                        style="left: 10px"> search </span>
                                </div>
                                <table class="table" id="tabelKendaraan" style="cursor:pointer">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder" style="max-width: 37px"> No </th>
                                            <th class="fw-bolder d-none">Id</th>
                                            <th class="fw-bolder">Kode Kendaraan</th>
                                            <th class="fw-bolder">Nama Kendaraan</th>
                                            <th class="fw-bolder">Merk</th>
                                            <th class="fw-bolder">Tahun</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal Kendaraan-->
                    <!-- Modal Driver-->
                     <div class="modal fade modalDriver" id="modalDriver" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content p-5">
                            <div class="modal-body">
                                <div class="position-relative">
                                    <input type="search" name="search_driver" id="search_driver"
                                        placeholder="Ketik untuk mencari" class="py-3 ps-12 pe-5 fs-6 w-100"
                                        style="background-color: #fafafa;border-radius: 6px; border-width:1.5px" />
                                    <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                        style="left: 10px"> search </span>
                                </div>
                                <table class="table" id="tabelDriver" style="cursor:pointer">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder" style="max-width: 37px"> No </th>
                                            <th class="fw-bolder d-none">Id</th>
                                            <th class="fw-bolder">Kode Driver</th>
                                            <th class="fw-bolder">Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal Driver-->
                    <!-- Modal Approval-->
                    <div class="modal fade modalApproval" id="modalApproval" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content p-5">
                            <div class="modal-body">
                                <div class="position-relative">
                                    <input type="search" name="search_approval" id="search_approval"
                                        placeholder="Ketik untuk mencari" class="py-3 ps-12 pe-5 fs-6 w-100"
                                        style="background-color: #fafafa;border-radius: 6px; border-width:1.5px" />
                                    <span class="material-icons position-absolute top-50 translate-middle-y text-light-gray"
                                        style="left: 10px"> search </span>
                                </div>
                                <table class="table" id="tabelApproval" style="cursor:pointer">
                                    <thead>
                                        <tr>
                                            <th class="fw-bolder" style="max-width: 37px"> No </th>
                                            <th class="fw-bolder d-none">Id</th>
                                            <th class="fw-bolder">Nama</th>
                                            <th class="fw-bolder">Jabatan</th>
                                            <th class="fw-bolder">Divisi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- End Modal Approval-->
                </form>
            </div>
        </div>
    </div>
</div>
