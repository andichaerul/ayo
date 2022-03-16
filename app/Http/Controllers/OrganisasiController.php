<?php

namespace App\Http\Controllers;

use App\Organisasi;
use App\CabangOlahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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

    public function simpan(Request $request)
    {
        $validasi = Validator::make(Input::all(), [
            "organisasi_name" => "required",
            "organisasi_tahun" => "required",
            "organisasi_alamat" => "required",
            "cab_olahraga_id" => "required|exists:cab_olahraga,cab_olahraga_id",
        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $organisasi = new Organisasi;
        $organisasi->organisasi_name = $request->post("organisasi_name");
        $organisasi->organisasi_tahun = $request->post("organisasi_tahun");
        $organisasi->organisasi_alamat = $request->post("organisasi_alamat");
        $organisasi->cab_olahraga_id = $request->post("cab_olahraga_id");
        $organisasi->users_id = session()->get('userId');

        try {
            $organisasi->save();
        } catch (\Throwable $th) {
            return response()->json([
                "statusCode" => "01"
            ]);
        }
        return response()->json([
            "statusCode" => "00",
            "messages" => "Berhasil menyimpan data"
        ]);
    }

    public function update(Request $request)
    {
        $validasi = Validator::make(Input::all(), [
            "organisasi_name" => "required",
            "organisasi_tahun" => "required",
            "organisasi_alamat" => "required",
            "cab_olahraga_id" => "required|exists:cab_olahraga,cab_olahraga_id",

        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $organisasi =  Organisasi::find($request->post("organisasi_id"));
        $organisasi->organisasi_name = $request->post("organisasi_name");
        $organisasi->organisasi_tahun = $request->post("organisasi_tahun");
        $organisasi->organisasi_alamat = $request->post("organisasi_alamat");
        $organisasi->cab_olahraga_id = $request->post("cab_olahraga_id");
        $organisasi->users_id = session()->get('userId');

        try {
            $organisasi->save();
        } catch (\Throwable $th) {
            return response()->json([
                "statusCode" => "01"
            ]);
        }
        return response()->json([
            "statusCode" => "00",
            "messages" => "Berhasil menyimpan data"
        ]);
        try {
            $organisasi->save();
        } catch (\Throwable $th) {
            return response()->json([
                "statusCode" => "01",
            ]);
        }
        return response()->json([
            "statusCode" => "00",
            "messages" => "Berhasil menyimpan data"
        ]);
    }

    public function deleted(Request $request)
    {
        $organisasi =  Organisasi::find($request->post("organisasi_id"));
        try {
            $organisasi->delete();
        } catch (\Throwable $th) {
            return response()->json([
                "statusCode" => "01",
                "messages" => $th
            ]);
        }
        return response()->json([
            "statusCode" => "00",
            "messages" => "Berhasil menyimpan data"
        ]);
    }
}
