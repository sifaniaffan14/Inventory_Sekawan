<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var urlPath ={
        select: "{{ route('verifikasiPemesanan.select') }}",
        update: "{{ route('verifikasiPemesanan.update') }}",
    }

    tableBelumverif()
    tableSudahverif()
    
    function tableBelumverif(){
        $(document).ready(function() {
            var dataTable = $('#belumverif').DataTable( {
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
                    { "data": "Status" },
                    { "data": "Action" }
                ]
            } );
            
            function processData(response) {
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
                    if (v.status === '2') { 
                        var row = {
                            "No": k + 1,
                            "Nama Peminjam": v.nama_karyawan,
                            "Nama Kendaraan": v.nama_kendaraan,
                            "Nama Driver": v.nama,
                            "Status": status,
                            "Action": `<button type="button" onclick="onSubmit('${v.id}',4)" class="btn btn-success btn-detail p-2 ps-3 ms-1" name="btn-detail" id="btn-detail"><i class="bi bi-check-lg fs-2"></i></button>
                                        <button type="button" onclick="onSubmit('${v.id}',5)" class="btn btn-danger btn-detail p-2 ps-3" name="btn-detail" id="btn-detail"><i class="bi bi bi-x-lg fs-2"></i></button>`
                        };
                        data.push(row);
                    }
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_verififikasi").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_verififikasi").addEventListener("input", searchFunction);
        } );      
    }
   
    function onSubmit(id, status){
        swal({
            title: "Peringatan",
            text: "Apakah Anda Yakin Untuk Menyimpan Data?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((response) => {
            if (response) {
                $.ajax({
                    url: urlPath.update,
                    data: {
                        id:id,
                        status:status
                    },
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

    function tableSudahverif(){
        $(document).ready(function() {
            var dataTable = $('#verif').DataTable( {
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
                    { "data": "Status" }
                ]
            } );
            
            function processData(response) {
                var data = [];
                $.each(response.data, function( k, v ){
                console.log(v.status == '4' || v.status == '5')
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
                    if (v.status == '4' || v.status == '5') { 
                        var row = {
                            "No": k + 1,
                            "Nama Peminjam": v.nama_karyawan,
                            "Nama Kendaraan": v.nama_kendaraan,
                            "Nama Driver": v.nama,
                            "Status": status,
                        };
                        data.push(row);
                    }
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_verififikasi2").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_verififikasi2").addEventListener("input", searchFunction);
        } );      
    }

    function changeTab(name){
        if (name == 'verif'){
            $('.menu2').removeClass('menu-nonaktif');
            $('.menu2').addClass('menu-aktif');
            $('.menu1').removeClass('menu-aktif');
            $('.menu1').addClass('menu-nonaktif');
            $('.verif').removeClass('d-none');
            $('.belum_verif').addClass('d-none');
            table = 'verif';
            $('#belumverif').DataTable().destroy();
        } 
        if (name == 'belum_verif'){
            $('.menu1').removeClass('menu-nonaktif');
            $('.menu1').addClass('menu-aktif');
            $('.menu2').removeClass('menu-aktif');
            $('.menu2').addClass('menu-nonaktif');
            $('.belum_verif').removeClass('d-none');
            $('.verif').addClass('d-none');
            table = 'belumverif';
            $('#verif').DataTable().destroy();
        }
    }

    function onRefresh(){
        $('#belumverif').DataTable().destroy();
        tableBelumverif()
        document.getElementById("search_verif").value = "";
    }

</script>