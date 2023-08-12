<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var urlPath ={
        select: "{{ route('pemesanan.select') }}",
        insert: "{{ route('pemesanan.insert') }}",
        update: "{{ route('pemesanan.update') }}",
        delete: "{{ route('pemesanan.delete') }}",
        getData: "{{ route('pemesanan.getData') }}",
        onDownload: "{{ route('pemesanan.onDownload') }}"
    }
    initTabelDriver()
    initTabelPemesan() 
    initTabelKendaraan() 
    initTabelApproval()
    inittable()
    selectTahun()

    function inittable(){
        $(document).ready(function() {
            var dataTable = $('#tabelPemesanan').DataTable( {
                "ajax": {
                    "url": urlPath.select,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Nama Peminjam" },
                    { "data": "Nama Kendaraan" },
                    { "data": "Nama Driver" },
                    { "data": "Nama Approval" },
                    { "data": "Status" },
                    { "data": "Detail" }
                ]
            } );
            
            function processData(response) {
                // console.log(response)
                var data = [];
                $.each(response.data, function( k, v ){
                    let status;   
                        if (v.status == '1') {
                            status = `<span class="badge bg-info">Process</span>`;
                        } else if (v.status == '2') {
                            status = `<span class="badge bg-warning">verifikasi manager</span>`;
                        } else if (v.status == '3') {
                            status = `<span class="badge bg-danger">Ditolak manager</span>`;
                        } else if (v.status == '4'){
                            status = `<span class="badge bg-success">verifikasi direktur</span>`;
                        } else{
                            status = `<span class="badge bg-danger">Ditolak direktur</span>`;
                        }
                    var row = {
                        "No": k + 1,
                        "Nama Peminjam": v.nama_pemesan,
                        "Nama Kendaraan": v.nama_kendaraan,
                        "Nama Driver": v.nama,
                        "Nama Approval": v.nama_approval,
                        "Status": status,
                        "Detail": `<span onclick=onEdit('${v.id}') class="btn p-1 ps-2 material-icons" style="color: rgb(38, 74, 138);" name="btn-detail" id="btn-detail">description</i></span>`
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_pemesanan").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_pemesanan").addEventListener("input", searchFunction);
        } );      
    }
   
    function initTabelDriver() {  
        $(document).ready(function() {
            var dataTable = $('#tabelDriver').DataTable( {
                "ajax": {
                    "url": urlPath.getData,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Id", visible: false },
                    { "data": "Kode Driver" },
                    { "data": "Nama" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data.driver, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Id": v.id,
                        "Kode Driver": v.kode_driver,
                        "Nama": v.nama,
                    };
                    data.push(row);
                })
                return data;
            }

            $('#tabelDriver tbody').on('click', 'tr', function () {
                var data = dataTable.row(this).data();
                $('.modalDriver').modal('hide');
                selectData(data); 
            });

            function selectData(data) {

                var selectOption = $('#selectDriver');

                var newOption = $('<option>', {
                    value: data.Id,
                    text: data.Nama
                });

                selectOption.find('option[value="#"]').remove();

                selectOption.append(newOption);
                $('#driver_id').val(data.Id);
            }

            function searchFunction() {
                const input = document.getElementById("search_driver").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_driver").addEventListener("input", searchFunction);
        } );      
    }
    function initTabelPemesan() {  
        $(document).ready(function() {
            var dataTable = $('#tabelPemesan').DataTable( {
                "ajax": {
                    "url": urlPath.getData,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Id", visible: false },
                    { "data": "Nama" },
                    { "data": "Divisi" },
                    { "data": "Jabatan" },
                ]
            } );
            
            function processData(response) {
                // console.log(response.data.karyawan)
                var data = [];
                $.each(response.data.karyawan, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Id": v.id,
                        "Nama": v.nama_karyawan,
                        "Divisi": v.nama_divisi,
                        "Jabatan": v.jabatan,
                    };
                    data.push(row);
                })
                return data;
            }

            $('#tabelPemesan tbody').on('click', 'tr', function () {
                var data = dataTable.row(this).data();
                $('.modalPemesan').modal('hide');
                selectData(data); 
            });

            function selectData(data) {

                var selectOption = $('#selectKaryawan');

                var newOption = $('<option>', {
                    value: data.Id,
                    text: data.Nama
                });

                selectOption.find('option[value="#"]').remove();

                selectOption.append(newOption);
                $('#karyawan_id').val(data.Id);
            }
           
            function searchFunction() {
                const input = document.getElementById("search_pemesan").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_pemesan").addEventListener("input", searchFunction);
        } );      
    }

    function initTabelApproval() {  
        $(document).ready(function() {
            var dataTable = $('#tabelApproval').DataTable( {
                "ajax": {
                    "url": urlPath.getData,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Id", visible: false },
                    { "data": "Nama" },
                    { "data": "Divisi" },
                    { "data": "Jabatan" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data.karyawan, function( k, v ){
                    if (v.jabatan === 'manager') { 
                    var row = {
                        "No": k + 1,
                        "Id": v.id,
                        "Nama": v.nama_karyawan,
                        "Divisi": v.nama_divisi,
                        "Jabatan": v.jabatan,
                    };
                    data.push(row);
                    }
                })
                return data;
            }
            $('#tabelApproval tbody').on('click', 'tr', function () {
                var data = dataTable.row(this).data();
                $('.modalApproval').modal('hide');
                selectData(data); 
            });

            function selectData(data) {

                var selectOption = $('#selectApproval');

                var newOption = $('<option>', {
                    value: data.Id,
                    text: data.Nama
                });

                selectOption.find('option[value="#"]').remove();

                selectOption.append(newOption);
                $('#karyawan_approval_id').val(data.Id);
            }
           
            function searchFunction() {
                const input = document.getElementById("search_approval").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_approval").addEventListener("input", searchFunction);
        } );      
    }

    function initTabelKendaraan() {  
        $(document).ready(function() {
            var dataTable = $('#tabelKendaraan').DataTable( {
                "ajax": {
                    "url": urlPath.getData,
                    "type": "GET",
                    "dataSrc": function (response) {
                        var data = processData(response);
                        return data;
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Id", visible: false },
                    { "data": "kodeKendaraan" },
                    { "data": "namaKendaraan" },
                    { "data": "Merk" },
                    { "data": "Tahun" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data.kendaraan, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Id": v.id,
                        "kodeKendaraan": v.kode_kendaraan,
                        "namaKendaraan": v.nama_kendaraan,
                        "Merk": v.merk,
                        "Tahun": v.tahun,
                    };
                    data.push(row);
                })
                return data;
            }

            $('#tabelKendaraan tbody').on('click', 'tr', function () {
                var data = dataTable.row(this).data();
                console.log(data)
                $('.modalKendaraan').modal('hide');
                selectData(data); 
            });

            function selectData(data) {

                var selectOption = $('#selectKendaraan');

                var newOption = $('<option>', {
                    value: data.Id,
                    text: data.namaKendaraan
                });

                selectOption.find('option[value="#"]').remove();

                selectOption.append(newOption);
                $('#kendaraan_id').val(data.Id);
            }

            function searchFunction() {
                const input = document.getElementById("search_kendaraan").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_kendaraan").addEventListener("input", searchFunction);
        } );      
    }

    function onEdit(id){
        $.ajax({
            url: urlPath.select,
            type: 'GET',
            data: {
                id: id
            },
            success: function(response){
                console.log(response)
                if(response.status == true){
                    loadForm();
                    DisplayEdit();
                    $.each(response.data[0], function( k, v ){
                        var selectOption = $('#selectKaryawan');

                        var newOption = $('<option>', {
                            value: v.id,
                            text: v.nama_pemesan
                        });

                        selectOption.find('option[value="#"]').remove();

                        selectOption.append(newOption);
                        $('#kendaraan_id').val(v.id);

                    });
                } 
            }
        })
    }

    function onSave(event){
        event.preventDefault()
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menyimpan Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                const formElement = $('#formPemesanan')[0];
                const form = new FormData(formElement);

                urlSave = $('[name=id]').val()  == ''? urlPath.insert:urlPath.update;
                $.ajax({
                    url: urlSave,
                    data: form,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            onRefresh()
                            swal("Success !", response.message, "success");
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

    function onDelete(){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menghapus Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                $.ajax({
                    url: urlPath.delete,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('[name=id]').val()
                    },
                    type: 'POST',
                    success: function(response){
                        if(response.status == true){
                            swal("Success !", response.message, "success");
                            onRefresh()
                        } else{
                            swal("Warning", response.message, "warning");
                        }
                    }
                })
            }
        }); 
    }

  

    function selectTahun(){
        var currentYear = new Date().getFullYear();
        var select = $('#tahun');
        
        for (var i = currentYear; i > currentYear - 5; i--) {
            select.append($('<option>', {
                value: i,
                text: i
            }));
        }
    }

    function onDownload(){
        if ($('#tahun').val() == null){
            swal("Warning", 'Pilih tahun untuk cetak!', "warning")
        } else {
            swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Mencetak Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((response) => {
                if (response) {
                    $.ajax({
                        url: urlPath.onDownload,
                        type: 'GET',
                        data: {
                            tahun : $("#tahun").val()
                        },
                        success: function(response){
                            if(response.status == true){
                                var fileName = response.data.fileName;
                                var url = window.location.origin + '/upload_files/'+fileName;
                                window.open(url,'_blank');
                            } else{
                                swal("Warning", response.message, "warning");
                            }
                        }
                    })
                }
            }); 
        }
    }

    loadForm = () => {
        $('.form_data').removeClass('d-none');
        $('.main_data').addClass('d-none');
        $('.actEdit1').addClass('d-none');
        $('.actCreate1').removeClass('d-none');
        $(`#formPemesanan input`).val('');
    }

    DisplayEdit = () => {
		$('.actEdit').removeClass('d-none');
        $('.actCreate').addClass('d-none');
        $(`#formPemesanan input`).attr('disabled', 'disabled')
        $('.actEdit1').addClass('d-none');
        $('.dataPemesanan').removeClass('d-none');
	}

    onDisplayEdit = () => {
		$('.actEdit').addClass('d-none');
        $('.actCreate').removeClass('d-none');
        $('.actEdit1').removeClass('d-none');
        $('.dataPemesanan').addClass('d-none');
        $('.actCreate1').addClass('d-none');
        $(`#formPemesanan input`).removeAttr('disabled', 'disabled')

	}

    function onRefresh(){
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
        $('#tabelPemesanan').DataTable().destroy();
        inittable()
        onClear()
        document.getElementById("search_pemesanan").value = "";
    }

    function onClear(){
        $(`#formPemesanan`)[0].reset();
    }

    closeForm = () => {
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
	}

    onSubmitForm = () => {
        $(`#formPemesanan`).submit();
    }
</script>