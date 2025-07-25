@extends('Frame.main')
@section('Css')

@endsection
@section('Title', 'List Kamar')
@section('tabView')
<div id="tabView-content-body" ></div>
@endsection
@section('BodyOfContent')
<div class="innerParticular col-8" style="width: 100%; max-width:100%; overflow-y: auto; overflow-x:hidden; display: flex; flex-direction: column;">
        <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
                <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="tampilanListKamar" role="tabpanel" aria-labelledby="tampilanListKamar">
                        @include('Menu.ListKamar.Data.index')
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('Javascript')
{{-- <script src="js/dataTableFc.js"></script>
<script src="js/CrudOfForm.js"></script>
<script src="js/popupWindow.js"></script> --}}
<script>
    $(document).ready(function(){
        var id = $('#cardContentDataKamar'),
            url = "/list-kamar/viewListKamar";
        $.get(url, function(table) {
                $(id).html(table);
                // alert('ola');
                var val = {_token:'', value:'', method:'POST'}
                $(dataTableFc(dataTableData, val));
        });
    })
</script>
<script>
    function FillTheVoidKamar(x){
        document.getElementById('idFillTheVoidKamar').value = x
    }

    function RunTheButtonSearchKamar(){
        document.getElementById('idButtonVoidKamar').click();
    }

    function EnterRunningNowKamar(event){
        if (event.key == 'Enter' || event.keyCode == 13){
            event.preventDefault();
            RunTheButtonSearchKamar();
        }
    }
</script>
<script>
        $(document).on("submit", "#frmViewDataKamar", function(e) {
        e.preventDefault();

        // Ambil nilai input pencarian
        let valP = $('input[name="namaKamar"]').val();

        // Ambil hasil HTML card dari server
        $.get("/list-kamar/cardViewListKamar?namaKamar=" + encodeURIComponent(valP), function(html) {
            // Tampilkan hasil card di dalam div ini
            $("#cardContentDataKamar").html(html);
        });
    });
</script>
@endsection
