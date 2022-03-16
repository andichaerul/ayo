<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestOrganisasi extends FormRequest
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
            "id" => "required|exists:organisasis,id",
            "nama_organisasi" => "required",
            // "logo" => "required",
            "tahun_berdiri" => "integer|digits:4",
            "alamat" => "required|max:50",
            "cabang_olahraga_id" => "required|exists:cabang_olahragas,id",
        ];
    }
}
