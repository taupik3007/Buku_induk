<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;



class RegionController extends Controller
{
    public function provinces()
    {
        return Cache::remember('provinces', 86400, function () {
            return Http::get('https://wilayah.id/api/provinces.json')->json();
        });
    }
    public function regencies($province)
    {
        return Cache::remember("regencies_$province", 86400, function () use ($province) {
            return Http::get("https://wilayah.id/api/regencies/$province.json")->json();
        });
    }

    public function districts($regency)
    {
        return Cache::remember("districts_$regency", 86400, function () use ($regency) {
            return Http::get("https://wilayah.id/api/districts/$regency.json")->json();
        });
    }

    public function villages($district)
    {
        return Cache::remember("villages_$district", 86400, function () use ($district) {
            return Http::get("https://wilayah.id/api/villages/$district.json")->json();
        });
    }

}
