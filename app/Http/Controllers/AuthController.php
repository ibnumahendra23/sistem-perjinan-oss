<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perijinan;
use App\Models\StatusPerijinan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fieldType = filter_var($request->nipEmail, FILTER_VALIDATE_INT) ? 'nip' : 'email';


        if ($fieldType == 'nip') {
            $user = User::where('nip', $request->nipEmail)->first();
        } else {
            $user = User::where('email', $request->nipEmail)->first();
        }

        // $request->validate([
        //     'nip' => 'required|string',
        //     'password' => 'required|string',
        // ]);
        // $user = User::where('nip', $request->nip)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Akun tidak ditemukan');
        } else if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error', 'Password salah');
        }

        Auth::login($user);
        return redirect()->route('home');
    }

    public function register(Request $request)
    {        
        $messages = [
            'nip.unique' => 'NIP sudah terdaftar',
            'nip.required' => 'NIP harus diisi',
            'nip.numeric' => 'NIP harus berupa angka',
            'nama.required' => 'Nama harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email',
            'password.required' => 'Password harus diisi',
        ];

        if ($request->nip == null) {
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ], $messages);
    
        } else {
            $request->validate([
                'nama' => 'required',
                'nip' => 'required|unique:users|numeric',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ], $messages);
    
        }

    
        //if 
        //create user
        $user = User::create([
            'nip' => $request->nip == null ? random_int(100000000, 999999999) : $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gambar' => 'default-u.png'
            
        ]);
        
        Auth::login($user);
        return redirect()->route('home');
    }

    //create function logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    //protected login page if user is logged in
    public function loginPage()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('Auth.loginRegister');
    }

    //protected register page if user is logged in
    public function profile()
    {
        $user = Auth::user();

        return view('Dashboard.profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $user = Auth::user();
        //message
        $messages = [
            'nama.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            // 'pangkat_golongan.required' => 'Pangkat/Golongan tidak boleh kosong',
            // 'jabatan.required' => 'Jabatan tidak boleh kosong',
        ];
        //validation with message
        if ($user->role == 'user') {
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
            ], $messages);
            
        } else {
            $request->validate([
                'nama' => 'required',
                'nip' => 'required|numeric|unique:users,nip,' . Auth::user()->id,
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                // 'pangkat_golongan' => 'required',
                // 'jabatan' => 'required',
                'alamat' => 'required',
                'jenis_kelamin' => 'required',
            ], $messages);
        }
        
            $user->update([
            'nama' => $request->nama,
            'nip' => $user->role == 'user' ? random_int(100000000, 999999999) : $request->nip,
            'email' => $request->email,
            'pangkat_golongan' => $request->pangkat_golongan,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kota_kabupaten' => $request->kota_kabupaten,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telp' => $request->no_telp,
        ]);

        //update gambar user auth
        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = public_path('/uploads/user/' . $nama_gambar);
            $user->gambar = $nama_gambar;
            $user->save();
            $gambar->move(public_path('/uploads/user/'), $nama_gambar);
        }

        return redirect()->route('profile')->with('success', 'Profile berhasil diubah');
    }

    public function change_password(Request $request)
    {
        $messages = [
            'current_password.required' => 'Password lama harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'confirm_password.required' => 'Konfirmasi password baru harus diisi',
            'confirm_password.same' => 'Konfirmasi password baru tidak sama dengan password baru',
        ];

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string',
            'confirm_password' => 'required|string|same:new_password',
        ], $messages);


        //update password
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile')->with('error', 'Password lama salah');
        } else {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect()->route('profile')->with('success', 'Password berhasil diubah');
        }
        
    }

    public function home()
    {
        //count total user
        $data['user'] = User::count();

        $data['perijinan'] = Perijinan::count();

        $data['proses'] = StatusPerijinan::whereStatus('Dalam Proses')->count();
        $data['setuju'] = StatusPerijinan::whereStatus('Disetujui')->count();
        $data['tolak'] = StatusPerijinan::whereStatus('Ditolak')->count();

        return view('Dashboard.home', $data);
    }
}
