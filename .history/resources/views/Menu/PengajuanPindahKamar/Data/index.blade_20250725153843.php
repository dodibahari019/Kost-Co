<div class="row g-4">
    @foreach($data as $key => $x)
        <div class="col-5 vh-100" style="background-color: #efefef;">
            <form action="/pengajuan-pindah-kamar/store" class="windowForm postClass" id="CreateFormX" dataTableId="#DataPengajuanPindahKamarTableId" enctype="multipart/form-data" method="post">
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
                    <label for="kamarTujuan" class="form-label fw-semibold">Nomor Kamar Tujuan</label>
                    <select onkeydown="EnterButtonIsRunningNow(event)" name="kamarTujuan" id="kamarTujuan" class="form-control select2">
                        <option selected></option>
                        @foreach ($listOfKamar as $x)
                            <option value="{{ $x->id_kamar }}">
                                {{ $x->Nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <label for="catatan" class="form-label fw-semibold">Catatan</label>
                    <textarea onkeydown="EnterButtonOfPindahKamar(event)" name="catatan" class="form-control" id="catatan"></textarea>
                </div>
                <div class="col-12 mt-3">
                    <button type="button" onclick="JalankanValidasiData()" class="btn btn-outline-dark w-100">Simpan</button>
                    <button hidden type="submit" id="IdOfHiddenButtonPindahKamar" class="btn btn-outline-dark w-100">Simpan</button>
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
        <div id="cardContentDataPengajuanPindahKamar" style="overflow-x: auto; min-height:400px;">
            @include('Menu.PengajuanPindahKamar.Data.table')
        </div>
    </div>
</div>
<script>
    function EnterButtonOfPindahKamar(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            JalankanValidasiData();
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

    function JalankanValidasiData() {
        const kamarTujuan = document.getElementById('kamarTujuan').value.trim();
        const catatan = document.getElementById('catatan').value.trim();

        if (!kamarTujuan) {
            showAlert("Harap isi Nomor Kamar Tujuan!");
        } else if (!catatan) {
            showAlert("Harap isi Catatan!");
        } else {
            // Validasi sukses, submit form
            document.getElementById('IdOfHiddenButtonPindahKamar').click();
        }
    }
</script>
<script>
     $(document).ready(function() {
        $('#kamarTujuan').select2({
            placeholder: "",
            allowClear: false
        });

    });
</script>
<style>
    /* Select2 agar tampilannya rata dan tinggi sama */
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        padding: 6px 12px;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        display: flex;
        align-items: center; /* buat text-nya rata tengah secara vertikal */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal !important; /* reset default line-height */
        padding-left: 0 !important;
        padding-right: 0 !important;
        width: 100%;
        color: #495057;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        top: 0px !important;
    }

    /* HILANGKAN TOMBOL "X" (clear) */
    .select2-selection__clear {
        display: none !important;
    }
</style>