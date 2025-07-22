<div id="ButtonPengecekan">
    <div id="TabButtonTop" style="display: flex; flex-wrap: nowrap; gap: 10px; align-items: center;">
        {{-- <div style="flex: 0 0 auto;">
            <button id="data-add-form-btn" height="600" width="700" action="/pengecekan/create" title="Data | Create Form" style="background-color: #087D02; color: #FFFF;" type="button" class="btn modal-crud" data-toggle="modal" data-target="#modalCRUDUser"><i class="nav-icon fas fa-plus"></i> Buat</button>
        </div>
        <div style="flex: 1;">
            <input type="date" oninput="FillTheVoidOfThisStartDatePengecekan(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAwalHistory">
        </div>
        <div style="flex:1;">
            <input type="date" oninput="FillTheVoidOfThisEndtDatePengecekan(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAkhirHistory">
        </div> --}}
        <div style="width: 300px;">
            <input onkeydown="EnterRunningNowPengecekan(event)" oninput="FillTheVoidPengecekan(this.value)" type="text" class="form-control" id="MobilMasukId">
        </div>
        <div style="flex: 0 0 auto;">
            <button onclick="RunTheButtonSearchPengecekan()" type="button" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari
            </button>
        </div>
    </div>
    <div hidden>
        <form class="windowForm" id="frmViewDataPengecekan">
            @csrf
            <div class="form-group mt-2">
                <div class="input-group">
                    <input type="date" value="{{ $tanggalHariIni }}" name="tanggalAwal" class="form-control" id="idFillTheVoidTanggalAwalPengecekan" style="text-transform:uppercase;" autocomplete="off">
                </div>
                <div class="input-group">
                    <input type="date" value="{{ $tanggalHariIni }}" name="tanggalAkhir" class="form-control" id="idFillTheVoidTanggalAkhirPengecekan" style="text-transform:uppercase;" autocomplete="off">
                </div>
                <div class="input-group">
                    <input type="text" name="namaPengecekan" class="form-control" id="idFillTheVoidPengecekan" style="text-transform:uppercase;" autocomplete="off">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-warning" id="idButtonVoidPengecekan">View Data</button>
                </div>
            </div>
        </form>
      </div>
      <div>
        
      </div>
</div>
<div id="cardContentDataPengecekan">
    @include('Menu.Penghuni.Data.table')
</div>
{{-- <div hidden id="cardContentDataPengecekanDetail" style="flex: 1; overflow-y: auto;">
    @include('Menu.Pengecekan.Karyawan.Pengajuan.detail')
</div> --}}
