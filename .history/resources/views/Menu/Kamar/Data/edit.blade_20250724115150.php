@foreach ($data as $x)
<form action="/pengelolaan-kamar/update/{{ $x->id_kamar }}" class="windowForm postClassX" id="editForm" dataTableId="#DataKamarTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    <div class="card-body" style="padding: 3px;">
        <div class="row">
            <div class="col-12">
                <label for="tipeKamarEdit" class="form-label fw-semibold">Tipe Kamar</label>
                <input type="text" value="{{ $x->tipe }}" readonly name="tipeKamar" id="tipeKamarEdit" style="font-weight: bold;" class="form-control">
            </div>

            <div class="col-12 mt-2">
                <label for="nomorKamarEdit" class="form-label fw-semibold">Nomor Kamar</label>
                <input type="text" value="{{ $x->nomor_kamar }}" readonly name="nomorKamar" id="nomorKamarEdit" style="font-weight: bold;" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="ukuranEdit" class="form-label fw-semibold">Ukuran</label>
                <input value="{{ $x->ukuran }}" onkeydown="EnterButtonKamarIsStartingEdit(event)" type="text" name="ukuran" id="ukuranEdit" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="hargaSewaEdit" class="form-label fw-semibold">Harga Sewa</label>
                <input value="{{number_format($x->hargaSewa,0,',' , '.')}}" onkeydown="EnterButtonKamarIsStartingEdit(event)" type="text" name="hargaSewa" id="hargaSewaEdit" class="form-control text-right classRp">
            </div>

            {{-- <div class="col-12 mt-2">
                <label for="statusKamar" class="form-label fw-semibold">Status Kamar</label>
                <input readonly value="Tersedia" type="text" name="statusKamar" id="statusKamar" class="form-control">
            </div> --}}

            <div class="col-12">
                <label for="statusKamarEdit" class="form-label fw-semibold">Status Kamar</label>
                <select onkeydown="EnterButtonKamarIsStartingEdit(event)" name="statusKamar" id="statusKamarEdit" class="form-group form-control" aria-label="Default select example">
                    <option value="{{ $x->status_kamar }}" selected>{{ $x->status_kamar }}</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Terisi">Terisi</option>
                    <option value="Dipesan">Dipesan</option>
                </select>
            </div>

        </div>
      <div class="row">
        <div class="col-12 mt-3" style="justify-content:flex-end; display:flex;">
            <button onclick="ButtonSumKamarIsStartingEdit()" type="button" style="width:120px; text-align:center; font-weight:600; background-color: #343a40;" class="btn btn-primary">Simpan</button>
            <button hidden type="submit" id="RealSubmitButtonKamarIdEdit" style="width:120px; text-align:center; font-weight:600; background-color: #343a40;" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</form>
@endforeach
<script>
    function EnterButtonKamarIsStartingEdit(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            ButtonSumKamarIsStartingEdit();
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

    function ButtonSumKamarIsStartingEdit() {
        const tipeKamar = document.getElementById('tipeKamarEdit').value.trim();
        const nomorKamar = document.getElementById('nomorKamarEdit').value.trim();
        const ukuran = document.getElementById('ukuranEdit').value.trim();
        const hargaSewa = document.getElementById('hargaSewaEdit').value.trim();

        if (tipeKamar === "Tipe Kamar" || !tipeKamar) {
            showAlert("Harap pilih Tipe Kamar!");
        } else if (!nomorKamar) {
            showAlert("Nomor Kamar belum terisi. Silakan pilih tipe kamar untuk generate nomor.");
        } else if (!ukuran) {
            showAlert("Harap isi Ukuran Kamar!");
        } else if (!hargaSewa) {
            showAlert("Harap isi Harga Sewa!");
        } else {
            // Semua validasi sukses, trigger tombol submit asli
            document.getElementById('RealSubmitButtonKamarIdEdit').click();
        }
    }
</script>
