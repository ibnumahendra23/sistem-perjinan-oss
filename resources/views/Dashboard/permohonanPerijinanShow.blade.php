@extends('Layout.db')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-culture icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Detail Perijinan
                <div class="page-title-subheading">Perijinan ini dapat ditolak jika tidak sesuai dengan kebijakan
                </div>
            </div>
        </div>
        {{-- <div class="page-title-actions">
            <button type="button" class="btn-shadow mr-3 btn btn-dark">
                <i class="fa fa-plus"></i> Tambah Data
            </button>
        </div> --}}
    </div>
</div>
<div class="tab-content">
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <aside class="col-md-5 border-right">
                        <article class="gallery-wrap">
                            <div class="img-big-wrap">
                                <img class="img-cover" src="{{ asset('uploads/perijinan/'.$sp->perijinan->gambar) }}">
                            </div> <!-- slider-product.// -->
                        </article> <!-- gallery-wrap .end// -->
                    </aside>
                    <aside class="col-md-7">
                        <article class="card-body p-1">
                            <h3 class="title mb-3">{{ $sp->perijinan->nama }}</h3>

                            <p class="price-detail-wrap">
                                <span class="price h3">
                                    <span class="text-info">{{ $sp->no_perijinan }}</span>
                                </span>
                                @if ($sp->status == 'Dalam Proses')
                                    <span class="h5 mb-2 mr-2 badge badge-warning">{{ $sp->status }}</span>
                                @elseif ($sp->status == 'Ditolak')
                                    <span class="h5 mb-2 mr-2 badge badge-danger">{{ $sp->status }}</span>
                                @else
                                    <span class="h5 mb-2 mr-2 badge badge-success">{{ $sp->status }}</span>
                                @endif
                            </p> <!-- price-detail-wrap .// -->
                            <dl class="item-property">
                                <dt>Alamat</dt>
                                <dd>
                                    <p class="mb-0">
                                        {{ $sp->perijinan->alamat }} 
                                        RT-{{ $sp->perijinan->rt }}/RW-{{ $sp->perijinan->rw }},
                                        {{ $sp->perijinan->kode_pos }}
                                    </p>
                                    <p class="mb-0">
                                        Kelurahan {{ $sp->perijinan->kelurahan }},
                                        Kecamatan {{ $sp->perijinan->kecamatan }}
                                    </p>
                                    <p class="mb-0">
                                        Kota/Kabupaten {{ $sp->perijinan->kota_kabupaten }},
                                    </p>
                                    <p class="mb-0">
                                        Provinsi {{ $sp->perijinan->provinsi }}
                                    </p>
                                </dd>
                            </dl>
                            <dl class="param param-feature">
                                <dt>Jenis Usaha</dt>
                                <dd>{{ $sp->perijinan->jenis }}</dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Pemilik</dt>
                                <dd>
                                    @foreach ($users as $user)
                                        @if ($user->id == $sp->perijinan->users_id)
                                            {{ $user->nama }}
                                        @endif
                                    @endforeach
                                </dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Alasan</dt>
                                <dd>{{ $sp->alasan }}</dd>
                            </dl> <!-- item-property-hor .// -->

                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <dl class="param param-inline">
                                        <dt>Tanggal Pengajuan </dt>
                                        <dd>
                                            {{ $sp->tanggal_pengajuan }}
                                        </dd>
                                    </dl> <!-- item-property .// -->
                                </div> <!-- col.// -->
                                <div class="col-sm-7">
                                    <dl class="param param-inline">
                                        <dt>Tanggal Disetujuai</dt>
                                        <dd>
                                            {{ $sp->tanggal_disetujui }}
                                        </dd>
                                    </dl> <!-- item-property .// -->
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr>
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                            <div class="d-flex justify-content-between">
                            @if ($sp->status == 'Dalam Proses')
                            <form action="{{ route('pp.acc', $sp->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                    <button type="submit" href="#" class="btn btn-lg btn-success text-uppercase" onclick="acc()">
                                        <i class="fas fa-check"></i> 
                                        Setujui 
                                    </button>
                            </form>
                            <form action="{{ route('pp.rej', $sp->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" href="#" class="btn btn-lg btn-danger btn-outline text-uppercase" onclick="rej()">
                                    <i class="fas fa-times"></i>
                                    Tolak
                                </button>
                            </form>

                            @elseif ($sp->status == 'Ditolak')
                            <form action="{{ route('pp.acc', $sp->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" href="#" class="btn btn-lg btn-success text-uppercase" onclick="acc()">
                                    <i class="fas fa-check"></i> 
                                    Ubah Menjadi Disetujui 
                                </button>
                            </form>

                            @else
                            <form action="{{ route('pp.rej', $sp->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" href="#" class="btn btn-lg btn-danger btn-outline text-uppercase" onclick="rej()">
                                    <i class="fas fa-times"></i>
                                    Ubah Menjadi Ditolak
                                </button>
                            </form>
                            {{-- Export to pdf  --}}
                            <a href="{{ route('pdf.single', $sp->id) }}" class="btn btn-lg btn-primary text-uppercase">
                                <i class="fas fa-file-pdf"></i>
                                Export to PDF
                            </a>
                            {{-- <a href="{{ route('pp1.pdf', $sp->id) }}" class="btn btn-lg btn-primary text-uppercase">
                                <i class="fas fa-file-pdf"></i>
                                Preview
                            </a> --}}
                            @endif
                            </div>
                        @endif
                        </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .gallery-wrap .img-big-wrap img {
        height: 450px;
        width: auto;
        display: inline-block;
        cursor: zoom-in;
    }


    .gallery-wrap .img-small-wrap .item-gallery {
        width: 60px;
        height: 60px;
        border: 1px solid #ddd;
        margin: 7px 2px;
        display: inline-block;
        overflow: hidden;
    }

    .gallery-wrap .img-small-wrap {
        text-align: center;
    }

    .gallery-wrap .img-small-wrap img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
        border-radius: 4px;
        cursor: zoom-in;
    }

    .img-cover{
        width: 400px !important;
        height: 500px !important;
        object-fit: cover;
        border-radius: 4px;
    }

</style>
@endsection

@section('js')
<script>
    function acc() {
        var x = confirm("Apakah anda yakin ingin menyetujui perijinan ini?");
        if (x) {
            return true;
        } else {
            return false;
        }
    }

    function rej() {
        var x = confirm("Apakah anda yakin ingin menolak perijinan ini?");
        if (x) {
            return true;
        } else {
            return false;
        }
    }

</script>
@endsection
