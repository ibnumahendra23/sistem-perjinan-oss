<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create seeder superadmin
        $user = new User();
        $user->nip = '12345';
        $user->nama = 'Super Admin';
        $user->email = 'superadmin@gmail.com';
        $user->password = Hash::make('password');
        $user->role = 'superadmin';
        $user->gambar = 'default-u.png';
        $user->save();

        $user = new User();
        $user->nip = '197206031991011001';
        $user->nama = 'Eko Yuniarto, S.IP,MM';
        $user->email = 'ekoyuniarto@gmail.com';
        $user->password = Hash::make('password');
        $user->role = 'admin';
        $user->jabatan = 'Camat';
        $user->gambar = 'default-u.png';
        $user->save();

        $user = new User();
        $user->nip = '196609011989031008';
        $user->nama = 'Ir. Suharyono, M.Si';
        $user->email = 'suharyono@gmail.com';
        $user->password = Hash::make('password');
        $user->role = 'admin';
        $user->jabatan = 'Sekretaris Camat';
        $user->gambar = 'default-u.png';
        $user->save();

        $user = new User();
        $user->nip = '1234567';
        $user->nama = 'user';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('password');
        $user->role = 'user';
        $user->gambar = 'default-u.png';
        $user->save();
    }
}
