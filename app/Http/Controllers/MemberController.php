<?php

namespace App\Http\Controllers;

use App\CabangOlahraga;
use App\Http\Requests\DeletedRequestMember;
use App\Http\Requests\StoreRequestMember;
use App\Http\Requests\UpdateRequestMember;
use App\OrganisasiMember;

class MemberController extends Controller
{
    public function index($id)
    {
        $view = [
            "no" => 1,
            "idOrganisasi" => $id,
            "titlePage" => "Organisasi Member",
            "organisasiMember" => OrganisasiMember::where('organisasi_id', $id)->get(),
        ];
        return view('pages.organisasi_member', $view);
    }

    public function simpan(StoreRequestMember $storeRequestMember)
    {
        $member = new OrganisasiMember;
        $member->nama = $storeRequestMember->post("nama");
        $member->tinggi = $storeRequestMember->post("tinggi");
        $member->berat = $storeRequestMember->post("berat");
        $member->no_phone = $storeRequestMember->post("no_phone");
        $member->organisasi_id = $storeRequestMember->post("organisasi_id");
        $member->posisi = $storeRequestMember->post("posisi");
        if ($member->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menyimpan data"
            ]);
        }
    }

    public function update(UpdateRequestMember $updateRequestMember)
    {
        $member = OrganisasiMember::find($updateRequestMember->post("id"));
        $member->nama = $updateRequestMember->post("nama");
        $member->tinggi = $updateRequestMember->post("tinggi");
        $member->berat = $updateRequestMember->post("berat");
        $member->no_phone = $updateRequestMember->post("no_phone");
        $member->organisasi_id = $updateRequestMember->post("organisasi_id");
        $member->posisi = $updateRequestMember->post("posisi");
        if ($member->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil update data"
            ]);
        }
    }

    public function deleted(DeletedRequestMember $deletedRequestMember)
    {
        $member = OrganisasiMember::find($deletedRequestMember->post("id"));
        if ($member->delete()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil menghapus data"
            ]);
        }
    }
}
