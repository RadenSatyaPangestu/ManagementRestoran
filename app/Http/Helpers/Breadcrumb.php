<?php

namespace App\Http\Helpers;

class Breadcrumb
{
    public static function generate()
    {
        $segments = request()->segments(); // Ambil semua segmen dari URL
        $breadcrumbs = [];
        $url = '';

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumbs[] = [
                'name' => ucfirst(str_replace('-', ' ', $segment)), // Ubah nama agar rapi
                'url' => url($url),
            ];
        }

        return $breadcrumbs;
    }
}
