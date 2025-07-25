<form action="/pegelolaan-kamar/store" class="windowForm postClass" id="CreateFormX" dataTableId="#DataKamarTableId" enctype="multipart/form-data" method="post">
    @csrf
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
                <label for="namapenghuni" class="form-label fw-semibold">Ukuran</label>
                <input onkeydown="EnterButtonKamarIsStarting(event)" type="text" name="ukuran" id="ukuran" class="form-control">
            </div>

            <div class="col-6 mt-2">
                <label for="nohp" class="form-label fw-semibold">Harga Sewa</label>
                <input onkeydown="EnterButtonKamarIsStarting(event)" type="text" name="hargaSewa" id="hargaSewa" class="form-control text-right classRp">
            </div>

            <div class="col-12 mt-2">
                <label for="nohp" class="form-label fw-semibold">Status Kamar</label>
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
            <button hidden type="submit" id="RealSubmitButtonKamar" style="width:120px; text-align:center; font-weight:600; background-color: #343a40;" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</form>
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
        const mobil = document.getElementById('mobil').value.trim();
        const nama = document.getElementById('nama').value.trim();
        const email = document.getElementById('email').value.trim();
        const noHp = document.getElementById('noHp').value.trim();
        const tanggal = document.getElementById('tanggal').value.trim();
        const jam = document.getElementById('jam').value.trim();
        const namaTeknisi = document.getElementById('namaTeknisi').value.trim();

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
            document.getElementById('RealKamarIsStarting').click();
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


    $(document).ready(function() {
        $('#mobil').select2({
            placeholder: "",
            allowClear: false
        });

        $('#mobil').on('select2:select', function (e) {
            const selected = e.params.data.element;
            const $selected = $(selected);

            // Ambil semua atribut data-*
            const harga = $selected.data('harga');
            const warna = $selected.data('warna');
            const plat = $selected.data('plat');
            const spesifikasi = $selected.data('spesifikasi');
            const kapasitas = $selected.data('kapasitas');
            const transmisi = $selected.data('transmisi');

            // Tampilkan ke elemen tertentu (pastikan input/elemen tujuan punya id yang sesuai)
            $('#harga').val(harga ? formatRupiah(harga) : 0);
            $('#warna').val(warna || '');
            $('#plat').val(plat || '');
            $('#spesifikasi').val(spesifikasi || '');
            $('#kapasitas').val(kapasitas || '');
            $('#transmisi').val(transmisi || '');
        });

        $('#mobil').on('select2:clear', function () {
            $('#harga').val(0);
            $('warna').val(0);
            $('#plat').val('');
            $('#spesifikasi').val('');
            $('#kapasitas').val('');
            $('#transmisi').val('');
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
