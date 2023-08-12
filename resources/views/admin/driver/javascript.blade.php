<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var urlPath ={
        select: "{{ route('driver.select') }}",
        insert: "{{ route('driver.insert') }}",
        update: "{{ route('driver.update') }}",
        delete: "{{ route('driver.delete') }}"
    }
    inittable()

    function inittable(){
        $(document).ready(function() {
            var dataTable = $('#tabelDriver').DataTable( {
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
                    { "data": "Kode Driver" },
                    { "data": "Nama Driver" },
                    { "data": "Status" },
                    { "data": "Detail" },
                ]
            } );
            
            function processData(response) {
                var data = [];
                console.log(response)
                $.each(response.data, function( k, v ){
                    let status = (v.status=='1'?`<span class="badge bg-success">Tersedia</span>`:`<span class="badge bg-danger">Tidak Tersedia</span>`)
                    var row = {
                        "No": k + 1,
                        "Kode Driver": v.kode_driver,
                        "Nama Driver": v.nama,
                        "Status": status,
                        "Detail": `<span onclick=onEdit('${v.id}') class="btn p-1 ps-2 material-icons" style="color: rgb(38, 74, 138);" name="btn-detail" id="btn-detail">description</i></span>`
                    };
                    data.push(row);
                })
                return data;
            }

            function searchFunction() {
                const input = document.getElementById("search_driver").value;        
                dataTable.search(input).draw();
            }

            document.getElementById("search_driver").addEventListener("input", searchFunction);
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
                const formElement = $('#formDriver')[0];
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
        $(`#formDriver input`).val('');
    }

    DisplayEdit = () => {
		$('.actEdit').removeClass('d-none');
        $('.actCreate').addClass('d-none');
        $(`#formDriver input`).attr('disabled', 'disabled')
        document.getElementById("status").disabled = true;
        $('.actEdit1').addClass('d-none');
        $('.dataDriver').removeClass('d-none');
	}

    onDisplayEdit = () => {
		$('.actEdit').addClass('d-none');
        $('.actCreate').removeClass('d-none');
        $('.actEdit1').removeClass('d-none');
        $('.dataDriver').addClass('d-none');
        $('.actCreate1').addClass('d-none');
        $(`#formDriver input`).removeAttr('disabled', 'disabled')
        document.getElementById("status").disabled = false;

	}

    function onRefresh(){
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
        $('#tabelDriver').DataTable().destroy();
        inittable()
        onClear()
        document.getElementById("search_driver").value = "";
    }

    function onClear(){
        $(`#formDriver`)[0].reset();
    }

    closeForm = () => {
        $('.main_data').removeClass('d-none');
        $('.form_data').addClass('d-none');
	}

    onSubmitForm = () => {
        $(`#formDriver`).submit();
    }
</script>