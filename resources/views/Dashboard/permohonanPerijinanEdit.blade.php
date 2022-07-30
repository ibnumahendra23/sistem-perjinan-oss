@extends('Layout.db')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-culture icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Form Permohonan Perijinan
                <div class="page-title-subheading">Lengkapi data dibawah ini dengan benar.
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
        @if ($errors->any())
        <div class="alert alert-danger mb-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="main-card mb-3 card">
            <div class="card-body">
                <form action="{{ route('pp.update', $perijinan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title">Form Permohonan Perijinan</h5>
                        <button class="mt-2 btn btn-primary">Simpan</button>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label for="nama" class="">Nama Usaha</label>
                                <input name="nama" id="nama" type="text" class="form-control"
                                    value="{{ $perijinan->nama }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="jenis" class="">Jenis Usaha</label>
                                <select name="jenis" id="" class="form-control">
                                    <option value="" selected disabled hidden>Pilih satu</option>
                                    <option value="Usaha Mikro"
                                        {{ old('jenis_usaha', $perijinan->jenis) == "Usaha Mikro" ? 'selected' : null }}>
                                        Usaha Mikro</option>
                                    <option value="Usaha Kecil"
                                        {{ old('jenis_usaha', $perijinan->jenis) == "Usaha Kecil" ? 'selected' : null }}>
                                        Usaha Kecil</option>
                                    <option value="Usaha Menengah"
                                        {{ old('jenis_usaha', $perijinan->jenis) == "Usaha Menengah" ? 'selected' : null }}>
                                        Usaha Menengah</option>
                                    <option value="Usaha Besar"
                                        {{ old('jenis_usaha', $perijinan->jenis) == "Usaha Besar" ? 'selected' : null }}>
                                        Usaha Besar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="alamat" class="">Alamat</label>
                                <textarea name="alamat" id="alamat" type="text" class="form-control"
                                    rows="1">{{ $perijinan->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="position-relative form-group">
                                <label for="rt" class="">RT</label>
                                <input name="rt" id="rt" type="text" class="form-control" maxlength="3"
                                    value="{{ $perijinan->rt }}"  onkeypress='validate(event)'>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="position-relative form-group">
                                <label for="rw" class="">RW</label>
                                <input name="rw" id="rw" type="text" class="form-control" maxlength="3"
                                    value="{{ $perijinan->rw }}"  onkeypress='validate(event)'>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="kelurahan" class="">Kelurahan</label>
                                <input name="kelurahan" id="kelurahan" type="text" class="form-control"
                                    value="{{ $perijinan->kelurahan }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="kecamatan" class="">Kecamatan</label>
                                <input name="kecamatan" id="kecamatan" type="text" class="form-control"
                                    value="{{ $perijinan->kecamatan }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-2">
                            <div class="position-relative form-group">
                                <label for="kodePos" class="">Kode Pos</label>
                                <input name="kodePos" id="kodePos" type="text" class="form-control"
                                    value="{{ $perijinan->kode_pos }}" maxlength="8" onkeypress='validate(event)'>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="kotaKabupaten" class="">Kota/Kabupaten</label>
                                <input name="kotaKabupaten" id="kotaKabupaten" type="text" class="form-control"
                                    value="{{ $perijinan->kota_kabupaten }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="provinsi" class="">Provinsi</label>
                                <input name="provinsi" id="provinsi" type="text" class="form-control"
                                    value="{{ $perijinan->provinsi }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="gambar" class="">Gambar</label>
                                <input name="gambar" id="gambar" type="file" class="form-control"
                                    onchange="showPreview(event);">
                                <div class="gambar mt-2">
                                    <img src="{{ asset('uploads/perijinan/'. $perijinan->gambar) }}" id="gambarPreview"
                                        alt="" class="img-fluid mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .boder-img {
        border: 1px solid #ccc;
        padding: 10px;
        /* margin-top: 1.8rem; */
        height: 15rem;
        width: 15rem;
        object-fit: cover;
    }

    .gambar {
        border: 1px solid #ccc;
        padding: 10px;
    }

</style>
@endsection

@section('js')
<script>
    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("gambarPreview");
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
@endsection
