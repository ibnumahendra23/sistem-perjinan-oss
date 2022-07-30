@extends('Layout.db')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-culture icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Data Permohonan Perijinan
                <div class="page-title-subheading">Data ini dapat diubah dan ditambahkan
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('pp.create') }}" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="card-body">
        <div class="row">
            @foreach ($pp as $p)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-lg-row">
                            <span
                                class="avatar avatar-text rounded-3 me-4 m-2">{{ $p->statusPerijinan->no_perijinan }}</span>
                            <div class="row flex-fill">
                                <div class="col-md-12">
                                    <h4 class="h5">
                                        <strong>{{ $p->nama }}</strong>
                                    </h4>
                                    <p class="text-muted">{{ $p->statusPerijinan->tanggal_pengajuan }}</p>
                                </div>
                                <span class="badge bg-warning">{{ $p->statusPerijinan->status }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('pp.index', $p->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                Lihat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: 1rem;
    }

    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.5rem 1.5rem;
    }

    .avatar-text {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        background: #000;
        color: #fff;
        font-weight: 700;
    }

    .avatar {
        width: 5rem;
        height: 5rem;
    }

    .rounded-3 {
        border-radius: 0.5rem !important;
    }

</style>
@endsection

@section('js')
<script>
</script>
@endsection
