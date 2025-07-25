@foreach ($data as $x)
<form action="/pengelolaan-penghuni/update/{{ $x->id_penghuni }}" class="windowForm postClassX" id="editForm" dataTableId="#DataPenghuniTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    
</form>
@endforeach
<script>
    function EnterButtonIsRunningNowPenghuniEdit(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            ButtonSumbitIsRunningPenghuniEdit();
        }
    }
</script>
<script>
    function showAlert(message) {
        Swal.fire({
            icon: "warning",
            title: "Peringatan",
            text: message,
            confirmButtonColor: "#2600FF",
            timer: 2000,
            timerProgressBar: true,
        });
    }

    function ButtonSumbitIsRunningPenghuniEdit() {
        const status = document.getElementById('statusEdit').value.trim();

        if (status == '' || status == null) {
            showAlert("Harap isi Status Penghuni!");
        } else {
            document.getElementById('RealSubmitButtonPenghuniEdit').click();
        }
    }
</script>
