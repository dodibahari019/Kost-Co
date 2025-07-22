@extends('Frame.main')
@section('Css')

@endsection
@section('Title', 'Pengelolaan Penghuni')
@section('BodyOfContent')
<div class="innerParticular col-8" style="width: 100%; max-width:100%; overflow-y: auto; overflow-x:hidden; display: flex; flex-direction: column;">
        <div class="row">
            <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-pengajuanbpkb-tab" data-toggle="pill" href="#custom-tabs-one-pengajuanbpkb" role="tab" aria-controls="custom-tabs-one-pengajuanbpkb" aria-selected="true">Data Pengecekan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-history-tab" data-toggle="pill" href="#custom-tabs-one-history" role="tab" aria-controls="custom-tabs-one-history" aria-selected="false">History Pengecekan</a>
                    </li>
                </ul>
                </div>
                <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-pengajuanbpkb" role="tabpanel" aria-labelledby="custom-tabs-one-pengajuanbpkb-tab">
                        {{-- @include('Menu.Pengecekan.Karyawan.Pengajuan.index') --}}
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

@endsection