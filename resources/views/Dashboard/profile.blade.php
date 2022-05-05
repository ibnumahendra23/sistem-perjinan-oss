@extends('Layout.db')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>User Account
                <div class="page-title-subheading">Lengkapi data diri anda dengan benar!
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-save fa-w-20"></i>
                    </span>
                    Simpan
                </button>
                <button type="button" class="btn-shadow btn btn-warning" data-toggle="modal" data-target="#changePassword">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-key fa-w-20"></i>
                    </span>
                    Ubah Password
                </button>
        </div>
    </div>
</div>

@if (\Session::has('success'))
    <div class="alert alert-success" role="alert">
        {!! \Session::get('success') !!}
    </div>
@endif

@if (\Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {!! \Session::get('error') !!}
    </div>
@endif

@if ($errors->has('current_password'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('current_password') }}
    </div>
@endif
@if ($errors->has('new_password'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('new_password') }}
    </div>
@endif
@if ($errors->has('confirm_password'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('confirm_password') }}
    </div>
@endif

<div class="container rounded bg-white my-2">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3">
                <img class="rounded-circle my-2 profile-img" src="{{ asset('uploads/user/'.Auth::user()->gambar) }}">
                <span class="font-weight-bold">{{ $user->nama }}</span><span
                    class="text-black-50">{{ $user->jabatan }}</span>
                <span>{{ $user->pangkat_golongan }}</span>
            </div>
            <div class="mt-3">
                <label for="gambar">Upload Foto</label>
                <input type="file" name="gambar" class="form-control">
            </div>
        </div>
        <div class="col-md-5 border-right p-3">
            <div class="row mt-2">
                <div class="col-md-12 heading">
                    <h5>Data Diri</h5>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="labels">Nama</label>
                    <input name="nama" type="text" class="form-control" value="{{ $user->nama }}">
                    @if ($errors->has('nama'))
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label class="labels">Email</label>
                    <input name="email" type="text" class="form-control" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <label class="labels">Jenis Kelamin</label>
                    <div class="custom-radio custom-control">
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Laki - laki" class="custom-control-input" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'Laki - laki' ? 'checked' : null }}>
                        <label class="custom-control-label" for="jenis_kelamin">Laki - laki</label>
                    </div>
                    <div class="custom-radio custom-control">
                        <input type="radio" id="jenis_kelamin2" name="jenis_kelamin" value="Perempuan" class="custom-control-input" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'Perempuan' ? 'checked' : null }}>
                        <label class="custom-control-label" for="jenis_kelamin2">Perempuan</label>
                    </div>
                    @if ($errors->has('jenis_kelamin'))
                        <span class="text-danger">{{ $errors->first('jenis_kelamin') }}</span>
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <label class="labels">No Telepon</label>
                    <input name="no_telp" type="text" class="form-control" value="{{ $user->no_telp }}" onkeypress='validate(event)'>
                    @if ($errors->has('no_telp'))
                        <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 heading">
                    <h5>Alamat</h5>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="labels">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ $user->alamat }}</textarea>
                    @if ($errors->has('alamat'))
                        <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <label class="labels">Kelurahan</label>
                    <input name="kelurahan" type="text" class="form-control" value="{{ $user->kelurahan}}">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="labels">Kecamatan</label>
                    <input name="kecamatan" type="text" class="form-control" value="{{ $user->kecamatan }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="labels">Kota</label>
                    <input name="kota_kabupaten" type="text" class="form-control" value="{{ $user->kota_kabupaten }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="labels">Provinsi</label>
                    <input name="provinsi" type="text" class="form-control" value="{{ $user->provinsi }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="labels">RT</label>
                    <input name="rt" type="text" class="form-control" value="{{ $user->rt }}" maxlength="3" onkeypress='validate(event)'>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="labels">RW</label>
                    <input name="rw" type="text" class="form-control" value="{{ $user->rw }}" maxlength="3" onkeypress='validate(event)'>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="labels">Kode Pos</label>
                    <input name="kode_pos" type="text" class="form-control" value="{{ $user->kode_pos }}" maxlength="8" onkeypress='validate(event)'>
                </div>
            </div>
        </div>
        <div class="col-md-4 border-right p-3">
            <div class="row mt-2">
                @if ($user->role == 'admin' || $user->role == 'superadmin')
                <div class="col-md-12 heading">
                    <h5>Tingkat</h5>
                </div>
                <div class="col-md-12 mb-2">
                    <label class="labels">NIP</label>
                    <input name="nip" type="text" class="form-control" value="{{ $user->nip }}" maxlength="18" onkeypress='validate(event)'>
                    @if ($errors->has('nip'))
                        <span class="text-danger">{{ $errors->first('nip') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label class="labels">Golongan</label>
                    <select class="form-control" name="pangkat_golongan">
                        <option value="" selected disabled hidden>Pilih Golongan</option>
                        <option value="IA - Juru Muda" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IA - Juru Muda' ? 'selected' : null) }}>IA - Juru Muda</option>
                        <option value="IB - Juru Muda Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IB - Juru Muda Tingkat I' ? 'selected' : null) }}>IB - Juru Muda Tingkat I</option>
                        <option value="IC - Juru" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IC - Juru' ? 'selected' : null) }}>IC - Juru</option>
                        <option value="ID - Juru Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'ID - Juru Tingkat I' ? 'selected' : null) }}>ID - Juru Tingkat I</option>

                        <option value="IIA - Pengatur Muda" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIA - Pengatur Muda' ? 'selected' : null) }}>IIA - Pengatur Muda</option>
                        <option value="IIB - Pengatur Muda Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIB - Pengatur Muda Tingkat I' ? 'selected' : null) }}>IIB - Pengatur Muda Tingkat I</option>
                        <option value="IIC - Pengatur" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIC - Pengatur' ? 'selected' : null) }}>IIC - Pengatur</option>
                        <option value="IID - Pengatur Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IID - Pengatur Tingkat I' ? 'selected' : null) }}>IID - Pengatur Tingkat I</option>

                        <option value="IIIA - Penata Muda" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIIA - Penata Muda' ? 'selected' : null) }}>IIIA - Penata Muda</option>
                        <option value="IIIB - Penata Muda Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIIB - Penata Muda Tingkat I' ? 'selected' : null) }}>IIIB - Penata Muda Tingkat I</option>
                        <option value="IIIC - Penata" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIIC - Penata' ? 'selected' : null) }}>IIIC - Penata</option>
                        <option value="IIID - Penata Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IIID - Penata Tingkat I' ? 'selected' : null) }}>IIID - Penata Tingkat I</option>

                        <option value="IVA - Pembina" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IVA - Pembina' ? 'selected' : null) }}>IVA - Pembina</option>
                        <option value="IVB - Pembina Tingkat I" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IVB - Pembina Tingkat I' ? 'selected' : null) }}>IVB - Pembina Tingkat I</option>
                        <option value="IVC - Pembina Utama Muda" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IVC - Pembina Utama Muda' ? 'selected' : null) }}>IVC - Pembina Utama Muda</option>
                        <option value="IVD - Pembina Utama Madya" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IVD - Pembina Utama Madya' ? 'selected' : null) }}>IVD - Pembina Utama Madya</option>
                        <option value="IVE - Pembina Utama" {{ old('pangkat_golongan', $user->pangkat_golongan == 'IVE - Pembina Utama' ? 'selected' : null) }}>IVE - Pembina Utama</option>
                    </select>
                    @if ($errors->has('pangkat_golongan'))
                        <span class="text-danger">{{ $errors->first('pangkat_golongan') }}</span>
                    @endif
                </div>
                <div class="col-md-12 mb-2">
                    <label class="labels">Jabatan</label>
                    <select class="form-control" name="jabatan">
                        <option value="" selected disabled hidden>Pilih Jabatan</option>
                        <option value="Camat" {{ old('jabatan', $user->jabatan == 'Camat' ? 'selected' : null) }}>Camat</option>
                        <option value="Sekretaris Camat" {{ old('jabatan', $user->jabatan == 'Sekretaris Camat' ? 'selected' : null) }}>Sekretaris Camat</option>
                        <option value="Kepala Seksi Pembangunan" {{ old('jabatan', $user->jabatan == 'Kepala Seksi Pembangunan' ? 'selected' : null) }}>Kepala Seksi Pembangunan</option>
                        <option value="Kepala Seksi Pemerintahan" {{ old('jabatan', $user->jabatan == 'Kepala Seksi Pemerintahan' ? 'selected' : null) }}>Kepala Seksi Pemerintahan </option>

                        <option value="Kepala Seksi Ketentraman dan Ketertiban Umum" {{ old('jabatan', $user->jabatan == 'Kepala Seksi Ketentraman dan Ketertiban Umum' ? 'selected' : null) }}>Kepala Seksi Ketentraman dan
                            Ketertiban Umum </option>
                        <option value="Kepala Seksi Kesejahteraan Sosial" {{ old('jabatan', $user->jabatan == 'Kepala Seksi Kesejahteraan Sosial' ? 'selected' : null) }}>Kepala Seksi Kesejahteraan Sosial</option>
                        <option value="Kepala Sub Bagian Umum dan Kepegawaian" {{ old('jabatan', $user->jabatan == 'Kepala Sub Bagian Umum dan Kepegawaian' ? 'selected' : null) }}>Kepala Sub Bagian Umum dan Kepegawaian
                        </option>
                        <option value="Kepala Sub Bagian Perencanaan, Evaluasi dan Keuangan" {{ old('jabatan', $user->jabatan == 'Kepala Sub Bagian Perencanaan, Evaluasi dan Keuangan' ? 'selected' : null) }}>Kepala Sub Bagian
                            Perencanaan, Evaluasi dan Keuangan </option>

                        <option value="Pengelola Ketertiban" {{ old('jabatan', $user->jabatan == 'Pengelola Ketertiban' ? 'selected' : null) }}>Pengelola Ketertiban</option>
                        <option value="Pengadministrasi Umum" {{ old('jabatan', $user->jabatan == 'Pengadministrasi Umum' ? 'selected' : null) }}>Pengadministrasi Umum</option>
                        <option value="Pengadministrasi Sarana Prasarana" {{ old('jabatan', $user->jabatan == 'Pengadministrasi Sarana Prasarana' ? 'selected' : null) }}>Pengadministrasi Sarana Prasarana</option>
                        <option value="Pengadministrasi Pemerintahan" {{ old('jabatan', $user->jabatan == 'Pengadministrasi Pemerintahan' ? 'selected' : null) }}>Pengadministrasi Pemerintahan</option>

                        <option value="Pengelola Teknologi Informasi" {{ old('jabatan', $user->jabatan == 'Pengelola Teknologi Informasi' ? 'selected' : null) }}>Pengelola Teknologi Informasi</option>
                        <option value="Penyusun Laporan Keuangan" {{ old('jabatan', $user->jabatan == 'Penyusun Laporan Keuangan' ? 'selected' : null) }}>Penyusun Laporan Keuangan</option>
                        <option value="Pengolah Data Kelembagaan" {{ old('jabatan', $user->jabatan == 'Pengolah Data Kelembagaan' ? 'selected' : null) }}>Pengolah Data Kelembagaan</option>
                        <option value="Pengelola Pengendalian, Monitoring Dan Evaluasi Pembangunan" {{ old('jabatan', $user->jabatan == 'Pengelola Pengendalian, Monitoring Dan Evaluasi Pembangunan' ? 'selected' : null) }}>Pengelola
                            Pengendalian, Monitoring Dan Evaluasi Pembangunan</option>
                    </select>
                    @if ($errors->has('jabatan'))
                        <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                    @endif
                </div>
                @endif
            </div>
            </form>
        </div>
    </div>
</div>

@endsection


<div class="modal fade bd-example-modal-lg" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassword"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.password') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="current_password">Password Lama</label>
                        <input type="password" class="form-control" name="current_password" id="current_password"
                            placeholder="Password lama anda">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" class="form-control" name="new_password" id="new_password"
                            placeholder="Masukan password baru anda">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                            placeholder="Masukan ulang password baru anda">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('css')
<style>
    .profile-button {
        width: 100%;
    }

    .heading {}

    .profile-img{
        width: 150px !important;
        height: 150px !important;
        object-fit: cover;
    }
</style>
@endsection

@section('js')
<script>
    //make alret dissapear with animation
    $(document).ready(function () {
        setTimeout(function () {
            $(".alert").fadeOut(1500);
        }, 3000);
    });

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