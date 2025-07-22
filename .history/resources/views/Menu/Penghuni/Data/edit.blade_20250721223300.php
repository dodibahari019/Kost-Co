@foreach ($data as $x)
<form action="/pengelolaan-penghuni/update/{{ $x->Id_SukuCadang }}" class="windowForm postClassX" id="editForm" dataTableId="#DataSukuCadangTableId" enctype="multipart/form-data" method="post">
    @csrf
    @method('put')
    <div class="card-body" style="padding: 5px;">
        <div class="row">
            <div class="mb-1 col-12">
                <label for="namaBarang" class="form-label fw-semibold">Nama Barang</label>
                <input value="{{ $x->NamaBarang }}" type="text" onkeydown="EnterButtonIsRunningNowSukuCadangEdit(event)" name="namaBarang" id="namaBarangEdit" class="form-control">
            </div>

            <div class="mb-1 col-6">
                <label for="qty" class="form-label fw-semibold">Qty</label>
                <input value="{{number_format($x->Qty,0,',' , '.')}}" oninput="hitungSubtotalEdit()" onkeydown="EnterButtonIsRunningNowSukuCadangEdit(event)" type="text" name="qty" id="qtyEdit" class="form-control classRp text-right">
            </div>

            <div class="mb-1 col-6">
                <label for="harga" class="form-label fw-semibold">Harga Satuan</label>
                <input value="{{number_format($x->NominalHarga,0,',' , '.')}}" type="text" oninput="hitungSubtotalEdit()" onkeydown="EnterButtonIsRunningNowSukuCadangEdit(event)" name="harga" id="hargaEdit" class="form-control classRp text-right">
            </div>

            <div class="mb-1 col-12">
                <label for="harga" class="form-label fw-semibold">Subtotal</label>
                <input value="{{number_format($x->Qty * $x->NominalHarga,0,',' , '.')}}" type="text" readonly id="idSubtotalEdit" class="form-control classRp text-right">
            </div>

            <div class="mb-1 col-12">
                <label for="catatan" class="form-label fw-semibold">Catatan</label>
                <textarea onkeydown="EnterButtonIsRunningNowSukuCadangEdit(event)" name="catatan" id="catatanEdit" rows="2" class="form-control">{{ $x->Catatan }}</textarea>
            </div>
        </div>
      <div class="row">
        <div class="col-12 mt-3" style="justify-content:flex-end; display:flex;">
            <button onkeydown="EnterButtonIsRunningNowSukuCadangEdit(event)" onclick="ButtonSumbitIsRunningSukuCadangEdit()" type="button" style="width:120px; text-align:center; font-weight:600; background-color: #2600FF;" class="btn btn-primary">Simpan</button>
            <button hidden type="submit" id="RealSubmitButtonSukuCadangEdit" style="width:120px; text-align:center; font-weight:600; background-color: #2600FF;" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
</form>
@endforeach
<script>
    function hitungSubtotalEdit() {
        const qty = parseInt(document.getElementById('qtyEdit').value) || 0;
        const hargaStr = document.getElementById('hargaEdit').value.replace(/[^0-9]/g, '');
        const harga = parseInt(hargaStr) || 0;

        const subtotal = qty * harga;
        document.getElementById('idSubtotalEdit').value = formatRupiah(subtotal);
    }

    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
</script>
<script>
    function EnterButtonIsRunningNowSukuCadangEdit(event){
        if(event.key == "Enter" || event.keyCode == 13){
            event.preventDefault();
            ButtonSumbitIsRunningSukuCadangEdit();
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

    function ButtonSumbitIsRunningSukuCadangEdit() {
        const namaBarang = document.getElementById('namaBarangEdit').value.trim();
        const qty = document.getElementById('qtyEdit').value.trim();
        const harga = document.getElementById('hargaEdit').value.trim();
        const catatan = document.getElementById('catatanEdit').value.trim();

        if (namaBarang == '' || namaBarang == null) {
            showAlert("Harap isi Nama Barang!");
        } else if (qty == '' || qty == null) {
            showAlert("Harap isi Qty Barang!");
        } else if (harga == '' || harga == null) {
            showAlert("Harap isi Harga!");
        } else if (catatan == '' || catatan == null) {
            showAlert("Harap isi catatan!");
        } else {
            document.getElementById('RealSubmitButtonSukuCadangEdit').click();
        }
    }
</script>