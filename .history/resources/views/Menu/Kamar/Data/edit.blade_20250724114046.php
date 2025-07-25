@foreach ($data as $x)
<form action="/pengelolaan-kamar/update/{{ $x->id_kamar }}" class="windowForm postClassX" id="editForm" dataTableId="#DataPenghuniTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    <div class="card-body" style="padding: 3px;">
        <div class="row">
            <div class="col-12">
                <label for="tipeKamar" class="form-label fw-semibold">Tipe Kamar</label>
                <select onchange="CheckLastNomorKamar(this.value)" onkeydown="EnterButtonKamarIsStarting(event)" name="tipeKamar" id="tipeKamar" class="form-group form-control" aria-label="Default select example">
                    <option selected>Tipe Kamar</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Premium">Premium</option>
                </select>
            </div>

            <div class="col-12">
                <label for="nomorKamar" class="form-label fw-semibold">Nomor Kamar</label>
                <input type="text" readonly name="nomorKamar" id="nomorKamar" style="font-weight: bold;" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="ukuran" class="form-label fw-semibold">Ukuran</label>
                <input onkeydown="EnterButtonKamarIsStarting(event)" type="text" name="ukuran" id="ukuran" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="hargaSewa" class="form-label fw-semibold">Harga Sewa</label>
                <input onkeydown="EnterButtonKamarIsStarting(event)" type="text" name="hargaSewa" id="hargaSewa" class="form-control text-right classRp">
            </div>

            <div class="col-12 mt-2">
                <label for="statusKamar" class="form-label fw-semibold">Status Kamar</label>
                <input readonly value="Tersedia" type="text" name="statusKamar" id="statusKamar" class="form-control">
            </div>

            {{-- <div class="col-12">
                <label for="status" class="form-label fw-semibold">Status Kamar</label>
                <select name="status" id="statusEdit" class="form-group form-control" aria-label="Default select example">
                    <option selected></option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Menunggu">Menunggu</option>
                </select>
            </div> --}}

        </div>
      <div class="row">
        <div class="col-12 mt-3" style="justify-content:flex-end; display:flex;">
            <button onclick="ButtonSumKamarIsStarting()" type="button" style="width:120px; text-align:center; font-weight:600; background-color: #343a40;" class="btn btn-primary">Simpan</button>
            <button hidden type="submit" id="RealSubmitButtonKamarId" style="width:120px; text-align:center; font-weight:600; background-color: #343a40;" class="btn btn-primary">Simpan</button>
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
