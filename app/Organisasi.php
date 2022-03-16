<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisasi extends Model
{
    use SoftDeletes;

    public function cabangOlahraga()
    {
        return $this->belongsTo(CabangOlahraga::class);
    }
}
