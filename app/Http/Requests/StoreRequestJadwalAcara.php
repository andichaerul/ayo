<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestJadwalAcara extends FormRequest
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
            "organisasi_id" => "required|exists:organisasis,id",
            "tgl_acara" => "required|date",
            "desc_acara" => "required",
            "prioritas_acara" => "required|in:Wajib,Tidak wajib,Hanya staf",
        ];
    }
}
