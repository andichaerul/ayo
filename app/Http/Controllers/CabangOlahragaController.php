<?php

namespace App\Http\Controllers;

use App\CabangOlahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RequestCabangOlahraga;
use App\Http\Requests\StoreRequestCabangOlahraga;
use App\Http\Requests\UpdateRequestCabangOlahraga;
use Symfony\Component\HttpFoundation\Response;

class CabangOlahragaController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Cabang Olahraga",
            "cabOlahraga" => CabangOlahraga::all()
        ];
        return view('pages.cabang_olahraga', $view);
    }

    public function simpan(StoreRequestCabangOlahraga $requestCabangOlahraga)
    {
        $cabangOlahraga = new CabangOlahraga();
        $cabangOlahraga->name_cab = $requestCabangOlahraga->post("name_cab");
        if ($cabangOlahraga->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        }
    }

    public function update(UpdateRequestCabangOlahraga $updateRequestCabangOlahraga)
    {
        $cabangOlahraga = CabangOlahraga::find($updateRequestCabangOlahraga->post("id"));
        $cabangOlahraga->name_cab = $updateRequestCabangOlahraga->post("name_cab");
        if ($cabangOlahraga->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil Update data"
            ]);
        }
    }


    public function deleted(Request $request, $id)
    {
        $cabangOlahraga =  CabangOlahraga::find($id);
        if ($cabangOlahraga->delete()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        }
    }
}
