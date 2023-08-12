<div class="form_data row gy-5 g-xl-8 d-none">
    <div class="col-12">
        <div class="card pb-6 mb-5 mb-xl-8" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;">
            <div class="card-header border-0 d-flex align-items-center justify-content-between position-sticky top-0 bg-white" style="z-index: 99;">
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 actCreate actCreate1">Tambah Data</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none actEdit actEdit1">Edit Data</h2>
                <h2 class="text-dark-gray fw-bolder fs-3 d-flex align-items-center gap-5 mb-0 d-none dataKendaraan">Data Kendaraan</h2>
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
                <form onsubmit="onSave(event)" class="d-flex flex-wrap gap-5 justify-content-center" id="formKendaraan" name="formKendaraan" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="kode_kendaraan" class="fw-bolder">Kode Kendaraan</label>
                        <input type="text" name="kode_kendaraan" id="kode_kendaraan" required placeholder="Masukkan Kode Kendaraan" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="nama_kendaraan" class="fw-bolder">Nama Kendaraan</label>
                        <input type="text" name="nama_kendaraan" id="nama_kendaraan" required placeholder="Masukkan Nama Kendaraan" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="merk" class="fw-bolder">Merk Kendaraan</label>
                        <input type="text" name="merk" id="merk" required placeholder="Masukkan Merk Kendaraan" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="tahun" class="fw-bolder">Tahun</label>
                        <input type="text" name="tahun" id="tahun" required placeholder="Masukkan Tahun" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="kondisi" class="fw-bolder">Kondisi</label>
                        <input type="text" name="kondisi" id="kondisi" required placeholder="Kondisi" class="border-0 py-4 px-5" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required />
                    </div>
                    <div class="d-flex flex-column gap-1 pe-5" style="width:49%">
                        <label for="status" class="fw-bolder">Status Kendaraan</label>
                        <select name="status" id="status" class="py-4 ps-5 pe-12 border-0 text-gray w-100 fs-6 text-light-gray" style="
                                    background-color: #fafafa;
                                    border-radius: 6px;
                                    " required>
                            <option id="1" value="1">Tersedia</option>
                            <option id="2" value="2">Tidak Tersedia</option>
                        </select>
                    </div>   
                    
                </form>
            </div>
        </div>
    </div>
</div>
