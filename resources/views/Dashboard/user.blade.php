@extends('Layout.db')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Data Permohonan Perijinan
                <div class="page-title-subheading">Data ini dapat diubah dan ditambahkan
                </div>
            </div>
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

<div class="main-card mb-3 card">
    <div class="card-body">
        <div class="mb-3 card">
            <div class="card-body">
                        <table id="user" class="mb-0 table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Pangkat Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Role</th>
                                    {{-- <th>Gambar</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nip }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->pangkat_golongan }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>{{ $user->role }}</td>
                                    {{-- <td>
                                        <img class="img-fluid" src="{{ asset('uploads/perijinan/'.$p->gambar) }}"
                                    alt="">
                                    </td> --}}
                                    <td>
                                        <div class="d-flex">
                                            {{-- <a href="{{ route('pp.edit', $user->id) }}" class="btn btn-primary btn-sm m-2"
                                                style="width: 30px;height: 25px;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('pp.show', $user->id) }}" class="btn btn-warning btn-sm m-2"
                                                style="width: 30px;height: 25px;">
                                                <i class="fa fa-eye"></i>
                                            </a> --}}
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-2"
                                                    style="width: 30px;height: 30px;" onclick="deleteAlert()">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/sb-1.3.2/datatables.min.css" />
<style>
    .form-select {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }

    /* .odd {
        cursor: pointer;
    }

    .even {
        cursor: pointer;
    } */

</style>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/r-2.2.9/sb-1.3.2/datatables.min.js">
    < script src = "//code.jquery.com/jquery-1.11.0.min.js" >

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</script>

<script>
    $(document).ready(function () {
        $('#user').DataTable();
    });

    $(document).ready(function () {
        setTimeout(function () {
            $(".alert").fadeOut(1500);
        }, 3000);
    });

    function deleteAlert() {
        var x = confirm("Apakah anda yakin ingin menghapus?");
        if (x) {
            return true;
        } else {
            return false;
        }
    }

</script>
@endsection
