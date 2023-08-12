<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var urlPath ={
        select: "{{ route('karyawan.select') }}",
        insert: "{{ route('karyawan.insert') }}",
        update: "{{ route('karyawan.update') }}",
        delete: "{{ route('karyawan.delete') }}",
        getData: "{{ route('karyawan.getData') }}"
    }
    inittable()
    getData()

    function inittable(){
        $(document).ready(function() {
            var dataTable = $('#tabelKaryawan').DataTable( {
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
                    { "data": "Nama Karyawan" },
                    { "data": "Divisi" },
                    { "data": "Jabatan" },
                    { "data": "Detail" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                console.log(response)
                $.each(response.data, function( k, v ){
                    var row = {
                        "No": k + 1,
                        "Nama Karyawan": v.nama_karyawan,
                        "Divisi": v.nama_divisi,
                        "Jabatan": v.jabatan,
                        "Detail": `<span onclick=onEdit('${v.id}') class="btn p-1 ps-2 material-icons" style="color: rgb(38, 74, 138);" name="btn-detail" id="btn-detail">description</i></span>`
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_karyawan").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_karyawan").addEventListener("input", searchFunction);
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
                if(response.status == true){
                    loadForm();
                    DisplayEdit();
                    $.each(response.data[0], function( k, v ){
                        $('[name='+k+']').val(v)
                    });
                } 
            }
        })
    }

    function getData(){
        $.ajax({
                url: urlPath.getData,
                type: 'GET',
                success: function(response){
                    if(response.status == true){
                        var options = "";
                        $.each(response.data, function(index, value) {
                            options += "<option value='" + value.id + "'>" + value.nama_divisi + "</option>";
                        });
                        $("#divisi_id").append(options);
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
                const formElement = $('#formKaryawan')[0];
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

    loadForm = () => {
        $('.form_data').removeClass('d-none');
        $('.main_data').addClass('d-none');
        $('.actEdit1').addClass('d-none');
        $('.actCreate1').removeClass('d-none');
        $(`#formKaryawan input`).val('');
    }

    DisplayEdit = () => {
		$('.actEdit').removeClass('d-none');
        $('.actCreate').addClass('d-none');
        $(`#formKaryawan input`).attr('disabled', 'disabled')
        document.getElementById("divisi_id").disabled = true;
        $('.actEdit1').addClass('d-none');
        $('.dataKaryawan').removeClass('d-none');
	}

    onDisplayEdit = () => {
		$('.actEdit').addClass('d-none');
        $('.actCreate').removeClass('d-none');
        $('.actEdit1').removeClass('d-none');
        $('.dataKaryawan').addClass('d-none');
        $('.actCreate1').addClass('d-none');
        $(`#formKaryawan input`).removeAttr('disabled', 'disabled')
        document.getElementById("divisi_id").disabled = false;

	}

    function onRefresh(){
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
        $('#tabelKaryawan').DataTable().destroy();
        inittable()
        onClear()
        document.getElementById("search_karyawan").value = "";
    }

    function onClear(){
        $(`#formKaryawan`)[0].reset();
    }

    closeForm = () => {
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
	}

    onSubmitForm = () => {
        $(`#formKaryawan`).submit();
    }
</script>