@foreach ($data as $x)
<form action="/pengelolaan-kamar/update/{{ $x->id_kamar }}" class="windowForm postClassX" id="editForm" dataTableId="#DataKamarTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    <div class="card-body" style="padding: 3px;">
        <div class="row">
            <div class="col-12">
                <label for="tipeKamarEdit" class="form-label fw-semibold">Tipe Kamar</label>
                <select onchange="CheckLastNomorKamar(this.value)" onkeydown="EnterButtonKamarIsStarting(event)" name="tipeKamar" id="tipeKamarEdit" class="form-group form-control" aria-label="Default select example">
                    <option value="{{ $x->tipe }}" selected>{{ $x->tipe }}</option>
                    <option value="Reguler">Reguler</option>
                    <option value="Premium">Premium</option>
                </select>
            </div>

            <div class="col-12">
                <label for="nomorKamarEdit" class="form-label fw-semibold">Nomor Kamar</label>
                <input type="text" value="{{ $x->nomor_kamar }}" readonly name="nomorKamar" id="nomorKamarEdit" style="font-weight: bold;" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="ukuranEdit" class="form-label fw-semibold">Ukuran</label>
                <input value="{{ $x->ukuran }}" onkeydown="EnterButtonKamarIsStarting(event)" type="text" name="ukuran" id="ukuranEdit" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="hargaSewaEdit" class="form-label fw-semibold">Harga Sewa</label>
                <input value="" onkeydown="EnterButtonKamarIsStarting(event)" type="text" name="hargaSewa" id="hargaSewaEdit" class="form-control text-right classRp">
            </div>

            {{-- <div class="col-12 mt-2">
                <label for="statusKamar" class="form-label fw-semibold">Status Kamar</label>
                <input readonly value="Tersedia" type="text" name="statusKamar" id="statusKamar" class="form-control">
            </div> --}}

            <div class="col-12">
                <label for="statusKamarEdit" class="form-label fw-semibold">Status Kamar</label>
                <select name="statusKamar" id="statusKamarEdit" class="form-group form-control" aria-label="Default select example">
                    <option value="{{ $x->status_kamar }}" selected></option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Terisi">Terisi</option>
                    <option value="Dipesan">Dipesan</option>
                </select>
            </div>

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
    function CheckLastNomorKamar(tipe) {
        if (tipe !== "") {
            $.ajax({
                url: '/pengelolaan-kamar/getLastNomorKamar', // route di Laravel
                type: 'GET',
                data: { tipe: tipe },
                success: function (response) {
                    // Update nilai input
                    $('#nomorKamar').val(response.nomor_baru);
                },
                error: function () {
                    alert("Terjadi kesalahan saat mengambil nomor kamar.");
                }
            });
        }
    }
</script>
<script>
    function EnterButtonKamarIsStarting(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            ButtonSumKamarIsStarting();
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

    function ButtonSumKamarIsStarting() {
        const tipeKamar = document.getElementById('tipeKamar').value.trim();
        const nomorKamar = document.getElementById('nomorKamar').value.trim();
        const ukuran = document.getElementById('ukuran').value.trim();
        const hargaSewa = document.getElementById('hargaSewa').value.trim();

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
            document.getElementById('RealSubmitButtonKamarId').click();
        }
    }
</script>
