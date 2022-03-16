<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletedRequestTeam;
use App\Http\Requests\StoreRequestTeam;
use App\Http\Requests\UpdateRequestTeam;
use App\Team;
use App\TeamModel;
use App\Organisasi;
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
            "titlePage" => "Team",
            "team" => Team::all(),
            "organisasi" => Organisasi::all()
        ];
        return view('pages.team', $view);
    }

    public function simpan(StoreRequestTeam $storeRequestTeam)
    {
        $team = new Team;
        $team->nama_team = $storeRequestTeam->post("nama_team");
        $team->organisasi_id = $storeRequestTeam->post("organisasi_id");
        if ($team->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        };
    }

    public function update(UpdateRequestTeam $updateRequestTeam)
    {
        $team = Team::find($updateRequestTeam->post("id"));
        $team->nama_team = $updateRequestTeam->post("nama_team");
        $team->organisasi_id = $updateRequestTeam->post("organisasi_id");
        if ($team->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil update data"
            ]);
        };
    }

    public function delete(DeletedRequestTeam $deletedRequestTeam)
    {
        $team = Team::find($deletedRequestTeam->post("id"));
        if ($team->delete()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menghapus data"
            ]);
        }
    }
}
