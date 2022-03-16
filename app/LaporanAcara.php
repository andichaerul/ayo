<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanAcara extends Model
{

    public function organisasiMember()
    {
        return $this->belongsTo(OrganisasiMember::class);
    }
}
