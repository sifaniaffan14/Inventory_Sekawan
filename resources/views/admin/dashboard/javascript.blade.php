<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
var urlPath ={
    getData: "{{ route('admin-dashboard.getData') }}",
    }

    selectData()
    selectTahun()
    // tableAbsensi()
    // tablePengajuanPerpanjangan()


function selectData(){
    $.ajax({
        url: urlPath.getData,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
        // Mengakses variabel-variabel dari respons JSON
            var getKendaraan = response.getKendaraan;
            var getKaryawan = response.getKaryawan;
            var getDriver = response.getDriver;
            var getPemesanan = response.getPemesanan;
        // Menyisipkan nilai variabel ke dalam elemen HTML
            $('#getKendaraan').text(getKendaraan);
            $('#getKaryawan').text(getKaryawan);
            $('#getDriver').text(getDriver);
            $('#getPemesanan').text(getPemesanan);
        },
    })
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

    function chart(){
 
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
</script>