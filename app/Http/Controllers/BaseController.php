<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Breadcrumb;

class BaseController extends Controller
{
    public function __construct()
    {
        // Membagikan breadcrumbs ke semua views
        view()->share('breadcrumbs', Breadcrumb::generate());
    }
}
