@foreach ($data as $x)
<form action="/pengelolaan-penghuni/update/{{ $x->id_penghuni }}" class="windowForm postClassX" id="editForm" dataTableId="#DataPenghuniTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    <div class="card-body" style="padding: 5px;">
        <div class="row">
            <div class="mb-1 col-6">
                <label for="noktp" class="form-label fw-semibold">No KTP</label>
                <input readonly value="{{ $x->no_ktp }}" type="text" name="noktp" id="noktpEdit" class="form-control">
            </div>

            <div class="mb-1 col-6">
                <label for="namapenghuni" class="form-label fw-semibold">Nama Penghuni</label>
                <input readonly value="{{ $x->nama }}" type="text" name="namapenghuni" id="namapenghuniEdit" class="form-control">
            </div>

            <div class="mb-1 col-6">
                <label for="nohp" class="form-label fw-semibold">No. HP</label>
                <input readonly value="{{ $x->no_hp}}" type="text" name="nohp" id="nohpEdit" class="form-control">
            </div>

            <div class="mb-1 col-6">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input readonly value="{{ $x->email }}" type="text" name="email" id="emailEdit" class="form-control">
            </div>

            <div class="mb-1 col-12">
                <label for="alamat" class="form-label fw-semibold">Alamat</label>
                <textarea name="alamat" id="alamatEdit" rows="2" class="form-control">{{ $x->alamat }}</textarea>
            </div>

            <div class="mb-1 col-12">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select onkeydown="EnterButtonIsRunningNowPenghuniEdit(event)" name="status" id="statusEdit" class="form-group form-control" aria-label="Default select example">
                    <option value="{{ $x->status_penghuni }}" selected>{{ $x->status_penghuni }}</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Menunggu">Menunggu</option>
                </select>
            </div>

        </div>
      <div class="row">
        <div class="col-12 mt-3" style="justify-content:flex-end; display:flex;">
            <button onclick="ButtonSumbitIsRunningPenghuniEdit()" type="button" style="width:120px; text-align:center; font-weight:600; background-color: #2600FF;" class="btn btn-primary">Simpan</button>
            <button hidden type="submit" id="RealSubmitButtonPenghuniEdit" style="width:120px; text-align:center; font-weight:600; background-color: #2600FF;" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
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