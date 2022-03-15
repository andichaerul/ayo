<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = "member_id";
    const CREATED_AT = 'member_id_created_at';
    const UPDATED_AT = 'member_id_updated_at';
    const DELETED_AT = 'member_id_deleted_at';
    use SoftDeletes;

    public function toCabangOlahraga()
    {
        return $this->hasOne(CabangOlahragaModel::class, "cab_olahraga_id", "cab_olahraga_id");
    }
}
