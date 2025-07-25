<div id="ButtonPenghuni">
    <div id="TabButtonTop" style="display: flex; flex-wrap: nowrap; gap: 10px; align-items: center;">
        {{-- <div style="flex: 0 0 auto;">
            <button id="data-add-form-btn" height="600" width="700" action="/Penghuni/create" title="Data | Create Form" style="background-color: #087D02; color: #FFFF;" type="button" class="btn modal-crud" data-toggle="modal" data-target="#modalCRUDUser"><i class="nav-icon fas fa-plus"></i> Buat</button>
        </div>
        <div style="flex: 1;">
            <input type="date" oninput="FillTheVoidOfThisStartDatePenghuni(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAwalHistory">
        </div>
        <div style="flex:1;">
            <input type="date" oninput="FillTheVoidOfThisEndtDatePenghuni(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAkhirHistory">
        </div> --}}
        <div style="width: 300px;">
            <input onkeydown="EnterRunningNowPenghuni(event)" oninput="FillTheVoidPenghuni(this.value)" type="text" class="form-control" id="MobilMasukId">
        </div>
        <div style="flex: 0 0 auto;">
            <button onclick="RunTheButtonSearchPenghuni()" type="button" class="btn btn-secondary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari
            </button>
        </div>
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
      <div style="margin-top:10px;">
        <div style="font-weight: 600; font-size: 20px;">
            List Penghuni
        </div>
      </div>
</div>
<div id="cardContentDataPenghuni">
    @include('Menu.Penghuni.Data.table')
</div>
{{-- <div hidden id="cardContentDataPenghuniDetail" style="flex: 1; overflow-y: auto;">
    @include('Menu.Penghuni.Karyawan.Pengajuan.detail')
</div> --}}
