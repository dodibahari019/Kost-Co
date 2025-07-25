{{-- CARD --}}
<div class="row">
    @foreach ($kamars as $kamar)
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 100%;">
                <img src="img/kamar.webp" class="card-img-top" alt="Gambar Kamar">
                <div class="card-body">
                    <h5 class="card-title">{{ $kamar->nomor_kamar ?? 'Nomor Kamar' }}</h5>
                    <p class="card-text">
                        Ukuran: {{ $kamar->ukuran ?? '-' }} <br>
                        Tipe: {{ $kamar->tipe ?? '-' }} <br>
                        Harga: Rp{{ number_format($kamar->harga_sewa ?? 0, 0, ',', '.') }}/bulan <br>
                        Status: {{ $kamar->status_kamar ?? '-' }}
                    </p>
                    <button onclick="getDataKamar('{{ $kamar->nomor_kamar ?? 'Nomor Kamar' }}', {{ $kamar->harga_sewa }})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailKamar">
                        Detail Kamar
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{{}-- MODAL --}}
<div class="modal fade" id="detailKamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kamar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- <div style="display: flex; flex-direction: row;"></div> --}}
        <div class="container my-5">
          <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-lg-8">
              <!-- Gambar dan Nama Kamar -->
              <div class="d-flex gap-3">
                <div class="flex-grow-1">
                  <img src="img/kamar.webp" class="img-fluid" alt="Gambar 1">
                </div>
                <div class="flex-grow-1">
                  <img src="img/kamar.webp" class="img-fluid" alt="Gambar 2">
                </div>
              </div>

              <h4 class="mt-3 fw-bold"><div id="idNomorKamar"></div></h4>

              <!-- Deskripsi dan Spesifikasi -->
              <div class="row mt-4">
                <div class="col-md-6">
                  <h6 class="fw-bold">Deskripsi</h6>
                  <p>Lorem ipsum dolor sit amet consectetur adipiscing elit...</p>
                </div>
                <div class="col-md-6">
                  <h6 class="fw-bold">Spesifikasi</h6>
                  <ul class="list-unstyled">
                    <li>✔️ Regular</li>
                    <li>✔️ 3x4 meter</li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-lg-4">
              <div class="bg-light p-4 rounded">
                <h5 style="display: flex; align-items: baseline;"><strong><div id="idHargaKamarLabel"></div></strong><small class="text-muted">/bulan</small></h5>

                <!-- Form Check-in dan Sampai -->
                <div class="mb-3 mt-3">
                  <label class="form-label">Check in</label>
                  <input id="checkIn" type="date" class="form-control">
                </div>
                <div class="mb-3">
                  <label class="form-label">Sampai</label>
                  <input id="sampai" type="date" class="form-control">
                </div>

                <!-- Detil Harga -->
                <div class="border-top mt-3 pt-3">
                  <h6 class="fw-bold">Detil harga</h6>
                  <div class="d-flex justify-content-between">
                    <span>Harga sewa</span>
                    <div id="idHargaKamarForm"></div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span>Lama sewa (bulan)</span>
                    <span id="lamaSewa"></span>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span id="totalHarga"></span>
                  </div>
                  <small class="text-muted d-block mt-2">*Total harga adalah harga sewa dikali berapa bulan menyewa</small>
                </div>

                <!-- Tombol / CTA -->
                <div class="mt-4">
                  <button class="btn btn-primary w-100">Pesan Sekarang</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    let hargaSewaGlobal = 0;

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    function getDataKamar(nomor_kamar, harga_sewa) {
        document.getElementById('idNomorKamar').innerHTML = nomor_kamar;
        document.getElementById('idHargaKamarLabel').innerHTML = formatRupiah(harga_sewa);
        document.getElementById('idHargaKamarForm').innerHTML = formatRupiah(harga_sewa);
        hargaSewaGlobal = harga_sewa; // simpan harga untuk perhitungan nanti
        hitungHarga(); // jika tanggal sudah dipilih sebelumnya
    }

    const checkIn = document.getElementById('checkIn');
    const sampai = document.getElementById('sampai');
    const lamaSewaEl = document.getElementById('lamaSewa');
    const totalHargaEl = document.getElementById('totalHarga');

    function hitungHarga() {
        const tanggalAwal = new Date(checkIn.value);
        const tanggalAkhir = new Date(sampai.value);

        if (checkIn.value && sampai.value && tanggalAkhir > tanggalAwal) {
            const tahun = tanggalAkhir.getFullYear() - tanggalAwal.getFullYear();
            const bulan = tanggalAkhir.getMonth() - tanggalAwal.getMonth();

            let lamaSewa = tahun * 12 + bulan;
            lamaSewa = lamaSewa <= 0 ? 1 : lamaSewa;

            const totalHarga = hargaSewaGlobal * lamaSewa;

            lamaSewaEl.textContent = lamaSewa;
            totalHargaEl.textContent = totalHarga.toLocaleString('id-ID');
        } else {
            lamaSewaEl.textContent = '0';
            totalHargaEl.textContent = '0';
        }
    }

    checkIn.addEventListener('change', hitungHarga);
    sampai.addEventListener('change', hitungHarga);
</script>
