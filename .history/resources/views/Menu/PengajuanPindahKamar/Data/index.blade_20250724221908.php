<div class="row g-4">
    <div class="col-5 vh-100" style="background-color: #efefef;">
        <div class="col-12 mt-3">
            <label for="nomorKamar" class="form-label fw-semibold">Nama</label>
            <input type="text" name="nomorKamar" id="nomorKamar" style="font-weight: bold;" class="form-control">
        </div>
        <div class="col-12 mt-3">
            <label for="nomorKamar" class="form-label fw-semibold">Email</label>
            <input type="text" name="nomorKamar" id="nomorKamar" style="font-weight: bold;" class="form-control">
        </div>
        <div class="col-12 mt-3">
            <label for="nomorKamar" class="form-label fw-semibold">No Hp</label>
            <input type="text" name="nomorKamar" id="nomorKamar" style="font-weight: bold;" class="form-control">
        </div>
        <div class="col-12 mt-3">
            <label for="catatan" class="form-label fw-semibold">Catatan</label>
            <textarea class="form-control" id="catatan"></textarea>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-outline-dark w-100">Simpan</button>
        </div>
    </div>
    <div class="col-7 vh-100 py-3" style="display: flex; border: 3px solid #efefef; flex-wrap: nowrap; gap: 10px; align-items: flex-start;">
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
        <div id="cardContentDataPenghuni">
    @include('Menu.Penghuni.Data.table')
</div>
    </div>
</div>