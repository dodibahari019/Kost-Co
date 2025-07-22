@foreach ($data as $x)
<form action="/pengecekan/update/{{ $x->Id_Pengecekan }}" class="windowForm postClassX" id="editForm" dataTableId="#DataPengecekanTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    <div class="card-body" style="padding: 3px;">
        <div class="row">
            <div class="col-12 col-12">
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Data Mobil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-one-pribadi-tab" data-toggle="pill" href="#custom-tabs-one-pribadi" role="tab" aria-controls="custom-tabs-one-pribadi" aria-selected="false">Data Pribadi</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <div class="row">
                            <div class="col-12">
                                <label for="mobil" class="form-label fw-semibold">Mobil</label>
                                <input value="{{ $x->Merk }} {{ $x->Tipe }} ({{ $x->Tahun }})" type="text" readonly name="mobil" id="mobilEdit" class="form-control">
                            </div>

                            <div class="mt-2 col-6">
                                <label for="warna" class="form-label fw-semibold">Warna</label>
                                <input value="{{ $x->Warna }}" type="text" readonly name="warna" id="warna" class="form-control">
                            </div>
                            <div class="mt-2 col-6">
                                <label for="plat" class="form-label fw-semibold">Plat</label>
                                <input value="{{ $x->Plat }}" type="text" readonly name="plat" id="plat" class="form-control">
                            </div>
                            <div class="mt-2 col-6">
                                <label for="spesifikasi" class="form-label fw-semibold">Spesifikasi Mesin</label>
                                <input value="{{ $x->Spesifikasi_Mesin }}" type="text" readonly name="spesifikasi" id="spesifikasi" class="form-control">
                            </div>
                            <div class="mt-2 col-6">
                                <label for="kapasitas" class="form-label fw-semibold">Kapasitas Mesin</label>
                                <input value="{{ $x->Kapasitas_Mesin }}" type="text" readonly name="kapasitas" id="kapasitas" class="form-control">
                            </div>
                            <div class="mt-2 col-6">
                                <label for="transmisi" class="form-label fw-semibold">Transmisi</label>
                                <input value="{{ $x->Transmisi }}" type="text" readonly name="transmisi" id="transmisi" class="form-control">
                            </div>
                            <div class="mt-2 col-6">
                                <label for="harga" class="form-label fw-semibold">Harga</label>
                                <input {{number_format($x->Harga_Jual,0,',' , '.')}} type="text" readonly name="harga" id="harga" class="form-control classRp text-right">
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-pribadi" role="tabpanel" aria-labelledby="custom-tabs-one-pribadi-tab">
                        <div class="row">
                            <div class="mt-2 col-12">
                                <label style="font-weight: 700" class="formLabel ">Nama</label>
                                <input value="{{ $x->Nama }}" required onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" name="nama" autocomplete="off" type="text" class="form-control formInput" id="namaEdit">
                            </div>
                            <div class="mt-2 col-6Edit
                                <label style="font-weight: 700" class="formLabel ">Email</label>
                                <input value="{{ $x->Email }}" required onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" name="email" autocomplete="off" type="text" class="form-control formInput" id="emailEdit">
                            </div>

                            <div class="mt-2 col-6">
                                <label style="font-weight: 700" class="formLabel ">No HP</label>
                                <input value="{{ $x->No_HP }}" required onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" name="noHp" autocomplete="off" type="text" class="form-control formInput" id="noHpEdit">
                            </div>

                            <div class="mt-2 col-6">
                                <label style="font-weight: 700" class="formLabel ">Tanggal</label>
                                <input value="{{ $x->Tanggal }}" required onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" value="{{ $tanggalHariIni }}" name="tanggal" autocomplete="off" type="date" class="form-control formInput" id="tanggalEdit">
                            </div>

                            <div class="mt-2 col-6">
                                <label style="font-weight: 700" class="formLabel ">Jam</label>
                                <input value="{{ $x->Jam }}" required onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" name="jam" autocomplete="off" type="time" class="form-control formInput" id="jamEdit">
                            </div>

                            <div class="mt-2 col-12">
                                <label style="font-weight: 700" class="formLabel ">Nama</label>
                                <input value="{{ $x->NamaTeknisi }}" required onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" name="namaTeknisi" autocomplete="off" type="text" class="form-control formInput" id="namaTeknisiEdit">
                            </div>

                        </div>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3" style="justify-content:flex-end; display:flex;">
                <button onkeydown="EnterButtonIsRunningNowPengecekanEdit(event)" onclick="ButtonSumbitIsRunningPengecekanEdit()" type="button" style="width:120px; text-align:center; font-weight:600; background-color: #2600FF;" class="btn btn-primary">Simpan</button>
                <button hidden type="submit" id="RealSubmitButtonPengecekan" style="width:120px; text-align:center; font-weight:600; background-color: #2600FF;" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endforeach
<script>
    function EnterButtonIsRunningNowPengecekanEdit(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            ButtonSumbitIsRunningPengecekanEdit();
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

    function ButtonSumbitIsRunningPengecekanEdit() {
        const mobil = document.getElementById('mobilEdit').value.trim();
        const nama = document.getElementById('namaEdit').value.trim();
        const email = document.getElementById('emailEdit').value.trim();
        const noHp = document.getElementById('noHpEdit').value.trim();
        const tanggal = document.getElementById('tanggalEdit').value.trim();
        const jam = document.getElementById('jamEdit').value.trim();
        const namaTeknisi = document.getElementById('namaTeknisiEdit').value.trim();

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const hpRegex = /^[0-9]{10,15}$/;
        // const tanggalRegex = /^\d{4}-\d{2}-\d{2}$/; // Format: YYYY-MM-DD
        const jamRegex = /^([01]\d|2[0-3]):([0-5]\d)$/; // Format: HH:mm (24 jam)

        if (!mobil) {
            showAlert("Harap pilih Mobil!");
        } else if (!nama) {
            showAlert("Harap isi Nama!");
        } else if (!email) {
            showAlert("Harap isi Email!");
        } else if (!emailRegex.test(email)) {
            showAlert("Format Email tidak valid!");
        } else if (!noHp) {
            showAlert("Harap isi No HP!");
        } else if (!hpRegex.test(noHp)) {
            showAlert("No HP harus berupa angka dan panjang 10–15 digit!");
        } else if (!tanggal) {
            showAlert("Harap isi Tanggal!");
        // } else if (!tanggalRegex.test(tanggal)) {
        //     showAlert("Format Tanggal harus YYYY-MM-DD!");
        } else if (!jam) {
            showAlert("Harap isi Jam!");
        } else if (!jamRegex.test(jam)) {
            showAlert("Format Jam harus HH:mm (24 jam)!");
        } else if (!namaTeknisi) {
            showAlert("Harap isi Teknisi!");
        } else {
            // Semua validasi berhasil
            document.getElementById('RealSubmitButtonPengecekan').click();
        }
    }
</script>
<script>
    function formatRupiah(angka) {
        // pastikan tipe angka adalah number atau konversi ke number
        angka = parseFloat(angka);

        // jika bukan angka valid, kembalikan default
        if (isNaN(angka)) return 'Rp 0';

        // ubah ke format Indonesia
        return angka.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }


    // $(document).ready(function() {
    //     $('#mobil').select2({
    //         placeholder: "",
    //         allowClear: false
    //     });

    //     $('#mobil').on('select2:select', function (e) {
    //         const selected = e.params.data.element;
    //         const $selected = $(selected);

    //         // Ambil semua atribut data-*
    //         const harga = $selected.data('harga');
    //         const warna = $selected.data('warna');
    //         const plat = $selected.data('plat');
    //         const spesifikasi = $selected.data('spesifikasi');
    //         const kapasitas = $selected.data('kapasitas');
    //         const transmisi = $selected.data('transmisi');

    //         // Tampilkan ke elemen tertentu (pastikan input/elemen tujuan punya id yang sesuai)
    //         $('#harga').val(harga ? formatRupiah(harga) : 0);
    //         $('#warna').val(warna || '');
    //         $('#plat').val(plat || '');
    //         $('#spesifikasi').val(spesifikasi || '');
    //         $('#kapasitas').val(kapasitas || '');
    //         $('#transmisi').val(transmisi || '');
    //     });

    //     $('#mobil').on('select2:clear', function () {
    //         $('#harga').val(0);
    //         $('warna').val(0);
    //         $('#plat').val('');
    //         $('#spesifikasi').val('');
    //         $('#kapasitas').val('');
    //         $('#transmisi').val('');
    //     });
    // });
</script>
{{-- <style>
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
</style> --}}
