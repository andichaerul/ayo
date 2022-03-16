<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestOrganisasi extends FormRequest
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
            "nama_organisasi" => "required",
            "tahun_berdiri" => "required|integer|digits:4",
            "alamat" => "required|max:50",
            "cabang_olahragas_id" => "required|exists:cabang_olahragas,id",
        ];
    }
}
