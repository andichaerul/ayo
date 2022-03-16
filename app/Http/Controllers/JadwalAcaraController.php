<?php

namespace App\Http\Controllers;

use App\Organisasi;
use App\JadwalAcara;
use App\LaporanAcara;
use App\OrganisasiModel;
use App\OrganisasiMember;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequestJadwalAcara;
use App\Http\Requests\StoreRequestJadwalAcaraSelesai;

class JadwalAcaraController extends Controller
{
    public function index()
    {
        $view = [
            "no" => 1,
            "titlePage" => "Jadwal Acara",
            "organisasi" => Organisasi::all(),
            "daftarAcara" => JadwalAcara::all(),
        ];
        return view('pages.jadwal_acara', $view);
    }

    public function simpan(StoreRequestJadwalAcara $storeRequestJadwalAcara)
    {
        $jadwalAcara = new JadwalAcara();
        $jadwalAcara->organisasi_id = $storeRequestJadwalAcara->post("organisasi_id");
        $jadwalAcara->tgl_acara = $storeRequestJadwalAcara->post("tgl_acara");
        $jadwalAcara->desc_acara = $storeRequestJadwalAcara->post("desc_acara");
        $jadwalAcara->prioritas_acara = $storeRequestJadwalAcara->post("prioritas_acara");
        if ($jadwalAcara->save()) {
            return response()->json([
                "statusCode" => "00",
                "messages" => "Berhasil update data"
            ]);
        }
    }

    public function getMember(Request $request)
    {
        $member =  OrganisasiMember::where('organisasi_id', $request->post("organisasi_id"))->get();
        return $member;
    }

    public function selesai(StoreRequestJadwalAcaraSelesai $storeRequestJadwalAcaraSelesai)
    {
        for ($i = 0; $i < count($storeRequestJadwalAcaraSelesai->post("organisasi_member_id")); $i++) {
            $laporkanAcara = new LaporanAcara();
            // $laporkanAcara->id = null;
            $laporkanAcara->jadwal_acara_id = $storeRequestJadwalAcaraSelesai->post("jadwal_acara_id");
            $laporkanAcara->organisasi_member_id = $storeRequestJadwalAcaraSelesai->post("organisasi_member_id")[$i];
            $laporkanAcara->konstribusi_member = $storeRequestJadwalAcaraSelesai->post("konstribusi_member")[$i];
            $laporkanAcara->kehadiran_member = $storeRequestJadwalAcaraSelesai->post("kehadiran_member")[$i];
            if ($laporkanAcara->save()) {
            }
        }
        return response()->json([
            "statusCode" => "00",
            "messages" => "Berhasil Simpan data"
        ]);
    }

    public function getResume(Request $request)
    {
        $laporkanAcara =  LaporanAcara::where("jadwal_acara_id", $request->post("jadwal_acara_id"))->with('organisasiMember')->get();
        return $laporkanAcara;
    }
}
