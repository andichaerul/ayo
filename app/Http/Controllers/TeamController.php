<?php

namespace App\Http\Controllers;

use App\TeamModel;
use App\OrganisasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Organisasi",
            "team" => TeamModel::all(),
            "organisasi" => OrganisasiModel::all()
        ];
        return view('team.index', $view);
    }

    public function simpan(Request $request)
    {
        $validasi = Validator::make(Input::all(), [
            "organisasi_id" => "required|exists:organisasi,organisasi_id",
            "team_name" => "required",
        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $team = new TeamModel;
        $team->organisasi_id = $request->post("organisasi_id");
        $team->team_name = $request->post("team_name");
        $team->save();
        try {
            $team->save();
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
}
