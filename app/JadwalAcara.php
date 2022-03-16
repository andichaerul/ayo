<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalAcara extends Model
{
    use SoftDeletes;

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
}
