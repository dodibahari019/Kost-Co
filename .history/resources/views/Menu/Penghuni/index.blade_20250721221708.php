@extends('Frame.main')
@section('Css')

@endsection
@section('Title', 'Pengelolaan Penghuni')
@section('BodyOfContent')
<div class="innerParticular col-8" style="width: 100%; max-width:100%; overflow-y: auto; overflow-x:hidden; display: flex; flex-direction: column;">
        <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
                {{-- <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-pengajuanbpkb-tab" data-toggle="pill" href="#custom-tabs-one-pengajuanbpkb" role="tab" aria-controls="custom-tabs-one-pengajuanbpkb" aria-selected="true">Data Pengecekan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-history-tab" data-toggle="pill" href="#custom-tabs-one-history" role="tab" aria-controls="custom-tabs-one-history" aria-selected="false">History Pengecekan</a>
                    </li>
                </ul>
                </div> --}}
                <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-pengajuanbpkb" role="tabpanel" aria-labelledby="custom-tabs-one-pengajuanbpkb-tab">
                        @include('Menu.Penghuni.Data.index')
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                        {{-- @include('Menu.Pengecekan.Karyawan.History.index') --}}
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('Javascript')
<script src="js/dataTableFc.js"></script>
<script src="js/CrudOfForm.js"></script>
<script src="js/popupWindow.js"></script>
<script>
    var dataTableData = [
        {
            idTable : "#DataPenghuniTableId",
            tblColumns : [0, 1, 2,3 ],
            dom: 'Bfrtip',
            btnNames : ['excelHtml5', 'pdfHtml5', 'print'],
            url : "/pengelolaan-penghuni/getViewPenghuni",
            method : "GET",
            noBtnPrint: true,
            bPaginate: true,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            paging: true,
            searching: false,
            ordering: true,
            info: false,
            // pageLength: 5,
        },
        {
            data:  [
                {data: 'DT_RowIndex', className: 'text-center'},
                { data: 'nama' },
                { data: 'no_ktp' },
                { data: 'no_hp' },
                { data: 'alamat' },
                { data: 'email' },
                { data: 'status_penghuni' },
                {data: 'action', className: 'text-center', orderable: false, searchable: false},
            ]
        }
    ];
</script>
<script>
    $(document).ready(function(){
        var id = $('#cardContentDataPenghuni'),
            url = "/pengelolaan-penghuni/viewPenghuni";
        $.get(url, function(table) {
                $(id).html(table);
                // alert('ola');
                var val = {_token:'', value:'', method:'POST'}
                $(dataTableFc(dataTableData, val));
        });
    })
</script>
<script>
    function FillTheVoidPenghuni(x){
        document.getElementById('idFillTheVoidPenghuni').value = x
    }

    function RunTheButtonSearchPenghuni(){
        document.getElementById('idButtonVoidPenghuni').click();
    }

    function EnterRunningNowPenghuni(event){
        if (event.key == 'Enter' || event.keyCode == 13){
            event.preventDefault();
            RunTheButtonSearchPenghuni();
        }
    }
    </script>
<script>
    $(document).on("submit", "#frmViewDataPenghuni", function(e) {
        e.preventDefault();
        var me = $(this),
        id = me.attr('id');
        var url = me.attr('action');
        var frmData = me.serialize();
        var valP = $('#' + id + ' input[name="namaMerk"]').val();
        var valAw = $('#' + id + ' input[name="tanggalAwal"]').val();
        var valAk = $('#' + id + ' input[name="tanggalAkhir"]').val();
        var not = {valP: valP, valAw: valAw, valAk: valAk}
        $.get("/pengelolaan-penghuni/dataTableView", function(tbl) {
            $("#cardContentData").html(tbl);
            $(tblViewDataPenghuni(not));
        });
    });

    function tblViewDataPenghuni(not) {
        var url = not == undefined ? "/pengelolaan-penghuni/isidataTableView" : "/pengelolaan-penghuni/isidataTableView?namaMerk=" + encodeURIComponent(not.valP) + "&tanggalAwal=" + encodeURIComponent(not.valAw) + "&tanggalAkhir=" + encodeURIComponent(not.valAk) +"";
        var table = $("#DataPenghuniTableId").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "destroy": true,
            "columns": [
                {data: 'DT_RowIndex', className: 'text-center'},
                {data: 'TanggalTransaksi'},
                {data: 'Merk'},
                {data: 'Tahun'},
                {
                    data: 'Harga',
                    className: 'text-right',
                    render: $.fn.dataTable.render.number('.', '.', ''),
                },
                // {data: 'MetodePembayaran'},
                {data: 'NamaPenawar'},
                {data: 'No_HP'},
                {data: 'Alamat'},
                {data: 'Status'},
                {data: 'action', className: 'text-center', orderable: false, searchable: false}
            ],
            // "dom": 'Bfrtip',
            // "buttons": [
            //     'excelHtml5',
            //     'pdfHtml5',
            //     'print'
            // ],
            "paging": true,
            "ordering": true,
            "info": false,
            "scrollX": true,
            // "scrollY": 'calc(100vh - 32rem)',
            "ajax": url,
            "initComplete": function(settings, json) {
                table.buttons().container().appendTo('#DataPenghuniTableId_wrapper .col-md-6:eq(0)');
            }
        });
    }
    </script>
    <script>
        var popupWindowArr = [
            {id:'data-addPenghuni-form', title:'Add Form'},
            {id:'data-editPenghuni-form', title:'Edit Form'},
            {id:'data-editInputPengeluaran-form', title:'Edit Form'},
            ];
    </script>
    <script>
        $(document).on("click",".modal-crud", function(e){
        var me = $(this),
            size = {height: 640, width: 650}
            popUpWindow(me,size);
        })
    </script>
    <script>
        function formatRibuan(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        function ButtonDetail( idTransaksi, idUser, merk, tahun, harga, foto, keterangan, namaPenawar, email, noHp, alamat, status, metode, tanggal, tipe) {
            const baseUrl = '/storage/' + foto;
            $('#Id_TransaksiCustomerTmpHidden').val(idTransaksi);
            $('#Id_DataUserHidden').val(idUser);
            $('#idMerkDetail').val(merk);
            $('#idTahunDetail').val(tahun);
            $('#idHargaDetail').val(formatRibuan(harga));
            $('#idHargaDetailHidden').val(harga);
            $('#idMetodePembayaran').val(metode);
            $('#idKeteranganDetail').val(keterangan);
            $('#idNamaPenawarDetail').val(namaPenawar);
            $('#idEmailDetail').val(email);
            $('#idNoHPDetail').val(noHp);
            $('#idAlamatDetail').val(alamat);
            $('#idStatusDetail').val(status);
            $('#idStatusDetailHidden').val(status);
            $('#idFotoDetail').attr('src', baseUrl);
            $('#idLinkFotoDetail').attr('href', baseUrl).text('Lihat Gambar');
            $('#idTanggalPengajuanDetail').val(tanggal);
            $('#idMerkDetailHidden').val(merk);
            $('#idTipeDetailHidden').val(tipe);
            $('#idTahunDetailHidden').val(tahun);
            $('#idMetodePembayaranDetailHidden').val(metode);
        }

        function OpenGate(){
            document.getElementById('TabButtonTop').hidden=true;
            document.getElementById('cardContentData').hidden = true;
            document.getElementById('cardContentDataDetail').hidden = false;
        }

        function CloseGate(){
            document.getElementById('TabButtonTop').hidden=false;
            document.getElementById('cardContentData').hidden = false;
            document.getElementById('cardContentDataDetail').hidden = true;
        }

        function ButtonInputPengeluaranDetail(
            idInput,
            idUser,
            namaLengkap,
            merk,
            tipe,
            tahun,
            harga,
            foto,
            tanggalTransaksi,
            tipePengeluaran,
            nominal,
            metodePembayaran,
            buktiPembayaran,
            catatan
        ){
            document.getElementById('cardContentDataInputPengeluaran').hidden = true;
            document.getElementById('ButtonInputPengeluaran').hidden = true;
            document.getElementById('cardContentDataInputPengeluaranDetail').hidden = false;
        }

        function CloseGateInputPengeluaran(){
            document.getElementById('cardContentDataInputPengeluaran').hidden = false;
            document.getElementById('ButtonInputPengeluaran').hidden = false;
            document.getElementById('cardContentDataInputPengeluaranDetail').hidden = true;
        }
    </script>
@endsection