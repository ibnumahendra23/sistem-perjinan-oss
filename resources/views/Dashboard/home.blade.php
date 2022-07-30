@extends('Layout.db')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-rocket icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Dashboard
                <div class="page-title-subheading">
                    Selamat Datang di Aplikasi Perijinan
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-6">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Users</div>
                    <div class="widget-subheading">Baru Mendaftar</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $user }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-6">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Perijinan</div>
                    {{-- <div class="widget-subheading">Total Clients Profit</div> --}}
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $perijinan }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-xl-4">
        <div class="card mb-3 widget-content bg-vicious-stance">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Perijinan Sedang Proses</div>
                    {{-- <div class="widget-subheading">People Interested</div> --}}
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $proses }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-4">
        <div class="card mb-3 widget-content bg-happy-itmeo">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Perijinan Disetujui</div>
                    {{-- <div class="widget-subheading">People Interested</div> --}}
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $setuju }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-4">
        <div class="card mb-3 widget-content bg-love-kiss">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Perijinan Ditolak</div>
                    {{-- <div class="widget-subheading">People Interested</div> --}}
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $tolak }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
