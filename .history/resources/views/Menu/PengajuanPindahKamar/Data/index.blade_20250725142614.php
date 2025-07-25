<div class="row g-4">
    
    <div class="col-7 vh-100 py-3" style="border: 3px solid #efefef;">
        <div style="display: flex; flex-wrap: nowrap; gap: 10px; align-items: flex-start;">
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
        </div>
        <div id="cardContentDataPenghuni" style="overflow-x: auto;">
            @include('Menu.PengajuanPindahKamar.Data.table')
        </div>
    </div>
</div>
