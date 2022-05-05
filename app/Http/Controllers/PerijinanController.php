<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Perijinan;
use App\Models\StatusPerijinan;
use App\Models\User;
use Carbon\Carbon;

class PerijinanController extends Controller
{
    public function index()
    {
        $pp = Perijinan::with('statusPerijinan')->whereUsersId(Auth::user()->id)->get();
        // return $pp;
        return view('Dashboard.permohonanPerijinan', compact('pp'));
    }

    public function create()
    {
        return view('Dashboard.permohonanPerijinanAdd');
    }

    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'rt.required' => 'RT tidak boleh kosong',
            'rt.numeric' => 'RT harus berupa angka',
            'rw.required' => 'RW tidak boleh kosong',
            'rw.numeric' => 'RW harus berupa angka',
            'kelurahan.required' => 'Kelurahan tidak boleh kosong',
            'kecamatan.required' => 'Kecamatan tidak boleh kosong',
            'kotaKabupaten.required' => 'Kota/Kabupaten tidak boleh kosong',
            'provinsi.required' => 'Provinsi tidak boleh kosong',
            'jenis.required' => 'Jenis Perijinan tidak boleh kosong',
        ];

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kotaKabupaten' => 'required',
            'provinsi' => 'required',
            'jenis' => 'required',
        ], $messages);


            //get no_perijinan auto increment with year
            $year = date('Y');
            $no_perijinan = Perijinan::whereYear('created_at', $year)->count();
            $no_perijinan++;
            $no_perijinan = str_pad($no_perijinan, 4, '0', STR_PAD_LEFT);
            $no_perijinan = $year . $no_perijinan;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $ext = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $filename = str_replace(' ', '_', $filename);
                $filename = str_replace('.'.$ext, '', $filename);
                $filename = $filename.'_'.time().'.'.$ext;
                $file->move('uploads/perijinan/', $filename);
            } else {
                $filename = 'default-p.png';
            }
            
        $perijinan = Perijinan::create([
            'nama' => request('nama'),
            'alamat' => request('alamat'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'kelurahan' => request('kelurahan'),
            'kecamatan' => request('kecamatan'),
            'kota_kabupaten' => request('kotaKabupaten'),
            'provinsi' => request('provinsi'),
            'kode_pos' => request('kodePos'),
            'jenis' => request('jenis'),
            'gambar' => $filename,
            'users_id' => auth()->user()->id,
        ]);

        StatusPerijinan::create([
            'no_perijinan' => $no_perijinan,
            'tanggal_pengajuan' => date('Y-m-d'),
            'status' => 'Dalam Proses',
            'perijinan_usaha_id' => $perijinan->id,
        ]);

        return redirect()->route('pp.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request, $perijinan_id)
    {
        $perijinan = Perijinan::find($perijinan_id);
        return view('Dashboard.permohonanPerijinanEdit', compact('perijinan'));
    }

    public function update(Request $request, $perijinan_id)
    {
        $messages = [
            'nama.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'rt.required' => 'RT tidak boleh kosong',
            'rt.numeric' => 'RT harus berupa angka',
            'rw.required' => 'RW tidak boleh kosong',
            'rw.numeric' => 'RW harus berupa angka',
            'kelurahan.required' => 'Kelurahan tidak boleh kosong',
            'kecamatan.required' => 'Kecamatan tidak boleh kosong',
            'kotaKabupaten.required' => 'Kota/Kabupaten tidak boleh kosong',
            'provinsi.required' => 'Provinsi tidak boleh kosong',
            'jenis.required' => 'Jenis Perijinan tidak boleh kosong',
        ];

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kotaKabupaten' => 'required',
            'provinsi' => 'required',
            'jenis' => 'required',
        ], $messages);

        $perijinan = Perijinan::find($perijinan_id);
        $perijinan->nama = request('nama');
        $perijinan->alamat = request('alamat');
        $perijinan->rt = request('rt');
        $perijinan->rw = request('rw');
        $perijinan->kelurahan = request('kelurahan');
        $perijinan->kecamatan = request('kecamatan');
        $perijinan->kota_kabupaten = request('kotaKabupaten');
        $perijinan->provinsi = request('provinsi');
        $perijinan->kode_pos = request('kodePos');
        $perijinan->jenis = request('jenis');
        
        // if gambar not upload then get old image
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $filename = str_replace('.'.$ext, '', $filename);
            $filename = $filename.'_'.time().'.'.$ext;
            $file->move('uploads/perijinan/', $filename);
            $perijinan->gambar = $filename;
        } else {
            $perijinan->gambar = $perijinan->gambar;
        }
        $perijinan->update();

        $s_perijinan = StatusPerijinan::where('perijinan_usaha_id', $perijinan_id)->first();

        $s_perijinan->tanggal_pengajuan = date('Y-m-d');
        $s_perijinan->status = 'Dalam Proses';
        $s_perijinan->update();

        // return $perijinan;

        return redirect()->route('pp.index')->with('success', 'Data berhasil diubah');
    }

    public function delete($perijinan_id)
    {
        $perijinan = Perijinan::destroy($perijinan_id);
        $s_perijinan = StatusPerijinan::wherePerijinanUsahaId($perijinan_id)->first();
        $s_perijinan->delete();
        return redirect()->route('pp.index')->with('success', 'Data berhasil dihapus');
    }

    public function pdf_single($perijinan_id)
    {
        // $perijinan = Perijinan::find($perijinan_id);
        // $sp = StatusPerijinan::wherePerijinanUsahaId($perijinan_id)->first();
        $sp = StatusPerijinan::with('perijinan')->find($perijinan_id);
        $users = User::get();
        $camat = User::whereJabatan('camat')->first();
        if ($camat == null) {
            $camat = User::whereJabatan('Sekretaris Camat')->first();
        } else {
            $camat = User::whereJabatan('Camat')->first();
        }

        $carbon = new Carbon($sp->perijinan->tanggal_pengajuan);
        $tanggal_pengajuan = $carbon->locale('id_ID')->isoFormat('LL');

        //set to a4
        $pdf = PDF::loadView('Dashboard.permohonanPerijinanShowPDF', compact('sp', 'users', 'camat', 'tanggal_pengajuan'));
        return $pdf->download('permohonan_perijinan.pdf');
    }

    // public function pdf1($perijinan_id)
    // {
    //     $sp = StatusPerijinan::with('perijinan')->find($perijinan_id);
    //     $users = User::get();
    //     $camat = User::whereJabatan('Camat')->first();
    //     if ($camat == null) {
    //         $camat = User::whereJabatan('Sekretaris Camat')->first();
    //     } else {
    //         $camat = User::whereJabatan('Camat')->first();
    //     }

    //     $carbon = new Carbon($sp->perijinan->tanggal_pengajuan);
    //     $tanggal_pengajuan = $carbon->locale('id_ID')->isoFormat('LL');

    //     return view('Dashboard.permohonanPerijinanShowPDF', compact('sp', 'users', 'camat', 'tanggal_pengajuan'));
    // }

}
