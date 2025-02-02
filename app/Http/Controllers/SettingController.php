<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function index()
    {
        return view('settings.index'); // Menampilkan halaman setting
    }
}
