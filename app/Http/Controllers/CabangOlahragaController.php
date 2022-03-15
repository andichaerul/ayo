<?php

namespace App\Http\Controllers;

use App\CabangOlahragaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class CabangOlahragaController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Cabang Olahraga",
            "cabOlahraga" => CabangOlahragaModel::all()
        ];
        return view('cabang_olahraga.index', $view);
    }

    public function simpan(Request $request)
    {
        $validasi = Validator::make(Input::all(), [
            "cab_olahraga_name" => "required|max:50|unique:cab_olahraga,cab_olahraga_name"
        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $cabangOlahraga = new CabangOlahragaModel;
        $cabangOlahraga->cab_olahraga_name = $request->post("cab_olahraga_name");
        $cabangOlahraga->users_id = session()->get('userId');
        try {
            $cabangOlahraga->save();
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
            "cab_olahraga_name" => "required|max:50|unique:cab_olahraga,cab_olahraga_name"
        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $cabangOlahraga =  CabangOlahragaModel::find($request->post("cab_olahraga_id"));
        $cabangOlahraga->cab_olahraga_name = $request->post("cab_olahraga_name");
        try {
            $cabangOlahraga->save();
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
        $cabangOlahraga =  CabangOlahragaModel::find($request->post("cab_olahraga_id"));
        try {
            $cabangOlahraga->delete();
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
