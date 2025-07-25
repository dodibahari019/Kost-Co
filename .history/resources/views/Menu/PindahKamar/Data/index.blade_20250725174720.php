<div id="ButtonPindahK">
    <div id="TabButtonTop" style="display: flex; flex-wrap: nowrap; gap: 10px; align-items: center;">
        {{-- <div style="flex: 0 0 auto;">
            <button id="data-add-form-btn" height="600" width="700" action="/PindahK/create" title="Data | Create Form" style="background-color: #087D02; color: #FFFF;" type="button" class="btn modal-crud" data-toggle="modal" data-target="#modalCRUDUser"><i class="nav-icon fas fa-plus"></i> Buat</button>
        </div>
        <div style="flex: 1;">
            <input type="date" oninput="FillTheVoidOfThisStartDatePindahK(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAwalHistory">
        </div>
        <div style="flex:1;">
            <input type="date" oninput="FillTheVoidOfThisEndtDatePindahK(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAkhirHistory">
        </div> --}}
        <div style="width: 300px;">
            <input onkeydown="EnterRunningNowPindahK(event)" oninput="FillTheVoidPindahK(this.value)" type="text" class="form-control" id="MobilMasukId">
        </div>
        <div style="flex: 0 0 auto;">
            <button onclick="RunTheButtonSearchPindahK()" type="button" class="btn btn-secondary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari
            </button>
        </div>
    </div>
    <div hidden>
        <form class="windowForm" id="frmViewDataPindahK">
            @csrf
            <div class="form-group mt-2">
                <div class="input-group">
                    <input type="text" name="namaPindahK" class="form-control" id="idFillTheVoidPindahK" style="text-transform:uppercase;" autocomplete="off">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-warning" id="idButtonVoidPindahK">View Data</button>
                </div>
            </div>
        </form>
      </div>
      {{-- <div style="margin-top:10px;">
        <div style="font-weight: 600; font-size: 20px;">
            List PindahK
        </div>
      </div> --}}
</div>
<div id="cardContentDataPindahKamar">
    @include('Menu.PindahKamar.Data.table')
</div>
{{-- <div hidden id="cardContentDataPindahKDetail" style="flex: 1; overflow-y: auto;">
    @include('Menu.PindahKamar.Karyawan.Pengajuan.detail')
</div> --}}
