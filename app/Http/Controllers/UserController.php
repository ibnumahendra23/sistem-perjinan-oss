<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Perijinan;
use App\Models\StatusPerijinan;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Dashboard.user', compact('users'));
    }

    public function delete($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        $perijinan = Perijinan::whereUsersId($user_id)->get();
        foreach ($perijinan as $p) {
            $p->delete();
            $status_perijinan = StatusPerijinan::wherePerijinanUsahaId($p->id)->get();
                foreach ($status_perijinan as $sp) {
                    $sp->delete();
                }
        }
        return redirect()->route('user.index');
    }
}
