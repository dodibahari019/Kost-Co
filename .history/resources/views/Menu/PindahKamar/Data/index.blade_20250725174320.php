<div id="ButtonPerbaikan">
    <div id="TabButtonTop" style="display: flex; flex-wrap: nowrap; gap: 10px; align-items: center;">
        {{-- <div style="flex: 0 0 auto;">
            <button id="data-add-form-btn" height="600" width="700" action="/Perbaikan/create" title="Data | Create Form" style="background-color: #087D02; color: #FFFF;" type="button" class="btn modal-crud" data-toggle="modal" data-target="#modalCRUDUser"><i class="nav-icon fas fa-plus"></i> Buat</button>
        </div>
        <div style="flex: 1;">
            <input type="date" oninput="FillTheVoidOfThisStartDatePerbaikan(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAwalHistory">
        </div>
        <div style="flex:1;">
            <input type="date" oninput="FillTheVoidOfThisEndtDatePerbaikan(this.value)" value="{{ $tanggalHariIni }}" class="form-control" id="dateAkhirHistory">
        </div> --}}
        <div style="width: 300px;">
            <input onkeydown="EnterRunningNowPerbaikan(event)" oninput="FillTheVoidPerbaikan(this.value)" type="text" class="form-control" id="MobilMasukId">
        </div>
        <div style="flex: 0 0 auto;">
            <button onclick="RunTheButtonSearchPerbaikan()" type="button" class="btn btn-secondary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari
            </button>
        </div>
    </div>
    <div hidden>
        <form class="windowForm" id="frmViewDataPerbaikan">
            @csrf
            <div class="form-group mt-2">
                <div class="input-group">
                    <input type="text" name="namaPerbaikan" class="form-control" id="idFillTheVoidPerbaikan" style="text-transform:uppercase;" autocomplete="off">
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-warning" id="idButtonVoidPerbaikan">View Data</button>
                </div>
            </div>
        </form>
      </div>
      {{-- <div style="margin-top:10px;">
        <div style="font-weight: 600; font-size: 20px;">
            List Perbaikan
        </div>
      </div> --}}
</div>
<div id="cardContentDataPindahKamar">
    @include('Menu.PindahKamar.Data.table')
</div>
{{-- <div hidden id="cardContentDataPerbaikanDetail" style="flex: 1; overflow-y: auto;">
    @include('Menu.PindahKamar.Karyawan.Pengajuan.detail')
</div> --}}
