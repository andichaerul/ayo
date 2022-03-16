<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestJadwalAcaraSelesai extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // "id" => "required",
            "jadwal_acara_id" => "required|exists:jadwal_acaras,id",
            "organisasi_member_id.*" => "required|exists:organisasi_members,id",
            "konstribusi_member.*" => "required|integer",
            "kehadiran_member.*" => "required|in:Ya,Tidak",
            // "updated_at" => "required",
            // "created_at" => "required",
        ];
    }
}
