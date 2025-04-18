<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function moreSetting()
    {
        $user = Auth::user();
        return view('account.setting', compact('user'));
    }
}
