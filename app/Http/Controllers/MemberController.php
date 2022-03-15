<?php

namespace App\Http\Controllers;

use App\MemberModel;
use App\CabangOlahragaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Member",
            "member" => MemberModel::all(),
            "cabOlahraga" => CabangOlahragaModel::all()
        ];
        return view('member.index', $view);
    }

    public function simpan(Request $request)
    {
        $validasi = Validator::make(Input::all(), [
            "member_name" => "required",
            "member_height" => "required|integer",
            "member_weight" => "required|integer",
            "member_position" => "required",
            "cab_olahraga_id" => "required|exists:cab_olahraga,cab_olahraga_id",
        ]);

        if ($validasi->fails()) {
            return response()->json([
                $validasi->getMessageBag()->all()
            ]);
        }

        $member = new MemberModel();
        $member->member_name = $request->post("member_name");
        $member->member_height = $request->post("member_height");
        $member->member_weight = $request->post("member_weight");
        $member->member_position = $request->post("member_position");
        $member->cab_olahraga_id = $request->post("cab_olahraga_id");
        $member->save();
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
