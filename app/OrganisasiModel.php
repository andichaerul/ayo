<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganisasiModel extends Model
{
    protected $table = 'organisasi';
    protected $primaryKey = "organisasi_id";
    const CREATED_AT = 'organisasi_created_at';
    const UPDATED_AT = 'organisasi_updated_at';
    const DELETED_AT = 'organisasi_deleted_at';
    use SoftDeletes;

    public function toCabangOlahraga()
    {
        return $this->hasOne(CabangOlahragaModel::class, "cab_olahraga_id", "cab_olahraga_id");
    }
}
