<div class="row g-4">
    @foreach($data as $key => $x)
        <div class="col-5 vh-100" style="background-color: #FFFFFF; border: 3px solid #efefef; border-right: 0;">
            <form action="/pengajuan-pindah-kamar/store" class="classForm" id="CreateFormX" method="post">
                @csrf
                <div class="col-12 mt-3">
                    <label for="nama" class="form-label fw-semibold">Nama</label>
                    <input readonly value="{{ $x->nama }}" type="text" name="nama" id="nama" style="font-weight: 600;" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input readonly value="{{ $x->email }}" type="text" name="email" id="email" style="font-weight: 600;" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <label for="nomHp" class="form-label fw-semibold">No Hp</label>
                    <input readonly value="{{ $x->no_hp }}" type="text" name="nomHp" id="nomHp" style="font-weight: 600;" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <label for="kamarAsal" class="form-label fw-semibold">Nomor Kamar Asal</label>
                    <input readonly value="{{ $x->nomor_kamar }}" type="text" name="kamarAsal" id="kamarAsal" style="font-weight: 600;" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <label for="catatan" class="form-label fw-semibold">Catatan</label>
                    <textarea onkeydown="EnterButtonOfPerbaikan(event)" name="catatan" class="form-control" id="catatanPerbaikan"></textarea>
                </div>
                <div class="col-12 mt-3">
                    <button type="button" onclick="JalankanValidasiDataPerbakian()" class="btn btn-outline-dark w-100">Simpan</button>
                    <button hidden type="submit" id="IdOfHiddenButtonPerbaikan" class="btn btn-outline-dark w-100">Simpan</button>
                </div>
            </form>
        </div>
    @endforeach
    <div class="col-7 vh-100" style="border: 3px solid #efefef;">
        {{-- <div style="display: flex; flex-wrap: nowrap; gap: 10px; align-items: flex-start;">
            <div style="flex:1;">
                <input onkeydown="EnterRunningNowPenghuni(event)" oninput="FillTheVoidPenghuni(this.value)" type="text" class="form-control" id="MobilMasukId">
            </div>
            <div style="flex: 0 0 auto;">
                <button onclick="RunTheButtonSearchPenghuni()" type="button" class="btn btn-secondary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Cari
                </button>
            </div>
            <div hidden>
                <form class="windowForm" id="frmViewDataPenghuni">
                    @csrf
                    <div class="form-group mt-2">
                        <div class="input-group">
                            <input type="text" name="namaPenghuni" class="form-control" id="idFillTheVoidPenghuni" style="text-transform:uppercase;" autocomplete="off">
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-warning" id="idButtonVoidPenghuni">View Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}
        <div id="cardContentDataPengajuanPerbaikan" style="overflow-x: auto; min-height:400px;">
            @include('Menu.PengajuanPerbaikan.Data.table')
        </div>
    </div>
</div>
<script>
    function EnterButtonOfPerbaikan(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            JalankanValidasiDataPerbakian();
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

    function JalankanValidasiDataPerbakian() {
        const catatan = document.getElementById('catatan').value.trim();

        if (!catatan) {
            showAlert("Harap isi Catatan!");
        } else {
            // Validasi sukses, submit form
            document.getElementById('IdOfHiddenButtonPerbaikan').click();
        }
    }
</script>