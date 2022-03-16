<?php

namespace App\Http\Controllers;

use App\OrganisasiModel;
use Illuminate\Http\Request;

class JadwalAcaraController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Jadwal Acara",
            "organisasi" => OrganisasiModel::all()
            // "cabOlahraga" => CabangOlahraga::all()
        ];
        return view('jadwal_acara.index', $view);
    }
}
