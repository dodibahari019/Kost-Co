@extends('Frame.main')
@section('Css')

@endsection
@section('Title', 'Pengajuan Perbaikan')
@section('tabView')
<div id="tabView-content-body" ></div>
@endsection
@section('BodyOfContent')
<div class="innerParticular col-12" style="width: 100%; max-width:100%;">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active px-2" id="custom-tabs-one-pengajuanbpkb" role="tabpanel" aria-labelledby="custom-tabs-one-pengajuanbpkb-tab">
                                @include('Menu.PengajuanPerbaikan.Data.index')
                            </div>
                            {{-- <div class="tab-pane fade" id="custom-tabs-one-history" role="tabpanel" aria-labelledby="custom-tabs-one-history-tab">
                                @include('Menu.Pengecekan.Karyawan.History.index')
                            </div> --}}
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
            idTable : "#DataPengajuanPerbaikanTableId",
            tblColumns : [0, 1, 2,3 ],
            dom: 'Bfrtip',
            btnNames : ['excelHtml5', 'pdfHtml5', 'print'],
            url : "/pengajuan-perbaikan/getViewPengajuanPerbaikan",
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
                { data: 'tanggal_ajuan' },
                { data: 'nomor_kamar' },
                // { data: 'nomor_kamar_tujuan' },
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
                }
                // {data: 'action', className: 'text-center', orderable: false, searchable: false},
            ]
        }
    ];
</script>
<script>
    $(document).ready(function(){
        var id = $('#cardContentDataPengajuanPerbaikan'),
            url = "/pengajuan-perbaikan/viewPengajuanPerbaikan";
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
        var me = $(this),
        id = me.attr('id');
        var url = me.attr('action');
        var frmData = me.serialize();
        var valP = $('#' + id + ' input[name="namaKamar"]').val();
        var not = {valP: valP}
        $.get("/pengelolaan-kamar/dataTableViewKamar", function(tbl) {
            $("#cardContentDataKamar").html(tbl);
            $(tblViewDataKamar(not));
        });
    });

    function tblViewDataKamar(not) {
        var url = not == undefined ? "/pengelolaan-kamar/isidataTableViewkamar" : "/pengelolaan-kamar/isidataTableViewKamar?namaKamar=" + encodeURIComponent(not.valP) ;
        var table = $("#DataPengajuanPerbaikanTableId").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "searching": false,
            "destroy": true,
            "columns": [
                {data: 'DT_RowIndex', className: 'text-center'},
                { data: 'nomor_kamar' },
                { data: 'ukuran' },
                { data: 'tipe' },
                {
                    data: 'harga_sewa',
                    className: 'text-right',
                    render: $.fn.dataTable.render.number('.', '.', ''),
                },
                { data: 'status_kamar' },
                { data: 'tanggal_mulai_sewa' },
                { data: 'tanggal_selesai_sewa' },
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
                table.buttons().container().appendTo('#DataPengajuanPerbaikanTableId_wrapper .col-md-6:eq(0)');
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
