<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var chartInstance;

var urlPath ={
    getData: "{{ route('admin-dashboard.getData') }}",
    chartPemesanan: "{{ route('admin-dashboard.chartPemesanan') }}",
    }

    selectData()
    selecTahun()
    createChart()


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

function selecTahun(){
        var currentYear = new Date().getFullYear();
        var select = $('#tahun');
        
        for (var i = currentYear; i > currentYear - 5; i--) {
            select.append($('<option>', {
                value: i,
                text: i
            }));
        }
    }

function chartPemesanan(){
    var tahun = $("#tahun").val()

    $.ajax({
        url: urlPath.chartPemesanan,
        type: 'GET',
        data: {
            tahun : tahun
        },
        success: function(response){
            // Hancurkan instance chart sebelum membuat yang baru
            if (chartInstance) {
                chartInstance.destroy();
            }
            
            createChart(response);

        }  
    })

}

function createChart(data){
    const ctx = $('#myChart');
    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: '# of Votes',
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
</script>