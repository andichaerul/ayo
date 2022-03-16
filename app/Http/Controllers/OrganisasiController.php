<?php

namespace App\Http\Controllers;

use App\Organisasi;
use App\CabangOlahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreRequestOrganisasi;
use App\Http\Requests\UpdateRequestOrganisasi;
use App\Http\Requests\DeletedRequestOrganisasi;
use App\Http\Requests\UpdateRequestCabangOlahraga;

class OrganisasiController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Organisasi",
            "cabangOlahraga" => CabangOlahraga::all(),
            "organisasi" => Organisasi::all()
        ];
        return view('pages.organisasi', $view);
    }

    public function simpan(StoreRequestOrganisasi $storeRequestOrganisasi)
    {
        $organisasi = new Organisasi;
        $organisasi->nama_organisasi = $storeRequestOrganisasi->post("nama_organisasi");
        $organisasi->tahun_berdiri = $storeRequestOrganisasi->post("tahun_berdiri");
        $organisasi->alamat = $storeRequestOrganisasi->post("alamat");
        $organisasi->cabang_olahraga_id = $storeRequestOrganisasi->post("cabang_olahragas_id");
        if ($organisasi->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        }
    }

    public function update(UpdateRequestOrganisasi $updateRequestOrganisasi)
    {
        $organisasi =  Organisasi::find($updateRequestOrganisasi->post("id"));
        $organisasi->nama_organisasi = $updateRequestOrganisasi->post("nama_organisasi");
        $organisasi->tahun_berdiri = $updateRequestOrganisasi->post("tahun_berdiri");
        $organisasi->alamat = $updateRequestOrganisasi->post("alamat");
        $organisasi->cabang_olahraga_id = $updateRequestOrganisasi->post("cabang_olahraga_id");
        if ($organisasi->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        }
    }

    public function deleted(DeletedRequestOrganisasi $deletedRequestOrganisasi)
    {
        $organisasi =  Organisasi::find($deletedRequestOrganisasi->post("id"));
        if ($organisasi->delete()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        }
    }
}
