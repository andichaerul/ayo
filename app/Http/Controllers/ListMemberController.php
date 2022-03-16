<?php

namespace App\Http\Controllers;

use App\TeamModel;
use App\MemberModel;
use App\CabangOlahraga;
use App\TeamMemberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ListMemberController extends Controller
{
    public function index($id)
    {
        $team =  TeamModel::find($id);
        $cabOlahragaId = $team->toOrganisasi->cab_olahraga_id;
        $view = [
            "teamId" => $id,
            "no" => 1,
            "titlePage" => "List Member",
            "member" => MemberModel::where('cab_olahraga_id', $cabOlahragaId)->get(),
            // "cabOlahraga" => CabangOlahraga::all()
        ];
        return view('team.list_member.index', $view);
    }

    public function simpan(Request $request, $id)
    {
        $validasi = Validator::make(Input::all(), [
            "member_id" => "required|exists:member,member_id",
            "team_member_phone" => "required|numeric",
        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $teamMember = new TeamMemberModel();
        $teamMember->team_id = $id;
        $teamMember->member_id = $request->post("member_id");
        $teamMember->team_member_phone = $request->post("team_member_phone");
        if ($teamMember->save()) {
            null;
        }
        try {
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
