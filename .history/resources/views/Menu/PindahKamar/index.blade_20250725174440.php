@extends('Frame.main')
@section('Css')

@endsection
@section('Title', 'Pengelolaan Pengajuan Pindah Kamar')
@section('tabView')
<div id="tabView-content-body" ></div>
@endsection
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
                        @include('Menu.PindahKamar.Data.index')
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
            idTable : "#DataPindahKamarTableId",
            tblColumns : [0, 1, 2,3 ],
            dom: 'Bfrtip',
            btnNames : ['excelHtml5', 'pdfHtml5', 'print'],
            url : "/pengelolaan-ajuan-pindah-kamar/getViewPindahKamar",
            method : "GET",
            noBtnPrint: true,
            bPaginate: true,
            responsive: true,
            lengthChange: false,
            autoWidth: true,
            paging: true,
            searching: false,
            ordering: true,
            info: false,
            // pageLength: 5,
        },
        {
            data:  [
                {data: 'DT_RowIndex', className: 'text-center'},
                { data: 'nama' },                                   // Nama Penghuni
                { data: 'no_ktp' },                                 // No. KTP
                { data: 'no_hp' },                                  // No. HP
                // { data: 'email' },                                  // Email
                // { data: 'alamat' },                                 // Alamat
                { data: 'nomor_kamar' },                            // Kamar Asal
                { data: 'nomor_kamar_tujuan' },                     // Kamar Tujuan
                { data: 'tanggal_ajuan' },                          // Tanggal Pengajuan
                {
                    data: 'status_pindah',
                    render: function(data, type, row) {
                        let color = '';
                        let fontWeight = 'bold';
                        let label = '';

                        switch (data) {
                            case 'Diajukan':
                                color = '#CD7800';
                                label = 'Diajukan';
                                break;
                            case 'Ditolak':
                                color = '#CD0000';
                                label = 'Ditolak';
                                break;
                            case 'Disetujui':
                                color = '#00CD2C';
                                label = 'Disetujui';
                                break;
                            default:
                                color = '#818181';
                                label = data;
                        }

                        return `<span style="color: ${color}; font-weight: ${fontWeight};">${label}</span>`;
                    }
                },
                { data: 'catatan' },
                {data: 'action', className: 'text-center', orderable: false, searchable: false},
            ]
        }
    ];
</script>
<script>
    $(document).ready(function(){
        var id = $('#cardContentDataPindahKamar'),
            url = "/pengelolaan-ajuan-pindah-kamar/viewPindahKamar";
        $.get(url, function(table) {
                $(id).html(table);
                // alert('ola');
                var val = {_token:'', value:'', method:'POST'}
                $(dataTableFc(dataTableData, val));
        });
    })
</script>
<script>
    function FillTheVoidPerbaikan(x){
        document.getElementById('idFillTheVoidPerbaikan').value = x
    }

    function RunTheButtonSearchPerbaikanFillTheVoidPerbaikan(){
        document.getElementById('idButtonVoidPerbaikanFillTheVoidPerbaikan').click();
    }

    function EnterRunningNowPerbaikanFillTheVoidPerbaikan(event){
        if (event.key == 'Enter' || event.keyCode == 13){
            event.preventDefault();
            RunTheButtonSearchPerbaikanFillTheVoidPerbaikan();
        }
    }
    </script>
<script>
    $(document).on("submit", "#frmViewDataPerbaikan", function(e) {
        e.preventDefault();
        var me = $(this),
        id = me.attr('id');
        var url = me.attr('action');
        var frmData = me.serialize();
        var valP = $('#' + id + ' input[name="namaPerbaikan"]').val();
        var not = {valP: valP}
        $.get("/pengelolaan-ajuan-pindah-kamar/dataTableViewPenghuni", function(tbl) {
            $("#cardContentDataPindahKamar").html(tbl);
            $(tblViewDataPenghuni(not));
        });
    });

    function tblViewDataPenghuni(not) {
        var url = not == undefined ? "/pengelolaan-ajuan-pindah-kamar/isidataTableViewPenghuni" : "/pengelolaan-ajuan-pindah-kamar/isidataTableViewPenghuni?namaPerbaikan=" + encodeURIComponent(not.valP) ;
        var table = $("#DataPindahKamarTableId").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "searching": false,
            "destroy": true,
            "columns": [
                {data: 'DT_RowIndex', className: 'text-center'},
                { data: 'nama' },
                { data: 'no_ktp' },
                { data: 'no_hp' },
                { data: 'alamat' },
                { data: 'email' },
                { data: 'status_penghuni' },
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
                table.buttons().container().appendTo('#DataPindahKamarTableId_wrapper .col-md-6:eq(0)');
            }
        });
    }
    </script>
    <script>
        var popupWindowArr = [
            {id:'data-add-form', title:'Add Form'},
            {id:'data-edit-form', title:'Edit Form'},
        ];
    </script>
    <script>
        $(document).on("click",".modal-crud", function(e){
        var me = $(this),
            size = {height: 520, width: 600}
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