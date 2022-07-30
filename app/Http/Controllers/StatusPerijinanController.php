<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


use App\Models\User;
use App\Models\Perijinan;
use App\Models\StatusPerijinan;

class StatusPerijinanController extends Controller
{
    public function index()
    {
        // $pp = Perijinan::with('statusPerijinan')->get();

        $data['proses'] = StatusPerijinan::with('perijinan')->whereStatus('Dalam Proses')->get();
        $data['setuju'] = StatusPerijinan::with('perijinan')->whereStatus('Disetujui')->get();
        $data['tolak'] = StatusPerijinan::with('perijinan')->whereStatus('Ditolak')->get();
        // return $pp1;
        $data['users'] = User::all();
        // return $pp;
        return view('Dashboard.statusPerijinan', $data);
    }
    

    public function show($perijinan_id)
    {
        $data['sp'] = StatusPerijinan::with('perijinan')->find($perijinan_id);
        $data['users'] = User::all();
        // return $data['sp'];
        // return $perijinan;
        return view('Dashboard.permohonanPerijinanShow', $data);
    }

    public function acc($perijinan_id)
    {
        $sp = StatusPerijinan::with('perijinan')->find($perijinan_id);
        $sp->tanggal_disetujui = date('Y-m-d');
        $sp->status = 'Disetujui';
        $sp->update();

        return redirect()->route('sp.index')->with('success', 'Data berhasil disetujui');
    }

    public function rej($perijinan_id)
    {
        $sp = StatusPerijinan::with('perijinan')->find($perijinan_id);
        $sp->tanggal_disetujui = null;
        $sp->status = 'Ditolak';
        $sp->update();

        return redirect()->route('sp.index')->with('success', 'Data berhasil ditolak');
    }

    public function pdf_acc()
    {
        $data['setuju'] = StatusPerijinan::with('perijinan')->whereStatus('Disetujui')->get();
        $data['users'] = User::all();

        // return view('Dashboard.statusPerijinanAccPDF', $data);

        $pdf = PDF::loadView('Dashboard.statusPerijinanAccPDF', $data)->setPaper('a4', 'landscape');
        return $pdf->download('table-perijinan-yang-disetujui.pdf');
    }

}
