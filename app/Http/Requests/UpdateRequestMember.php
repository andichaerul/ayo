<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestMember extends FormRequest
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
            "id" => "required|exists:organisasi_members,id",
            "nama" => "required",
            "tinggi" => "required|integer",
            "berat" => "required|integer",
            "no_phone" => "required|numeric",
            "organisasi_id" => "required|exists:organisasis,id",
            "posisi" => "required|in:Ketua,Anggota,Staf",
        ];
    }
}
