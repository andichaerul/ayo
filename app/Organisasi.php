<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisasi extends Model
{
    use SoftDeletes;

    public function toCabangOlahraga()
    {
        return $this->hasOne(CabangOlahraga::class, "cab_olahraga_id", "cab_olahraga_id");
    }
}
