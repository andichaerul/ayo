<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamModel extends Model
{
    protected $table = 'team';
    protected $primaryKey = "team_id";
    const CREATED_AT = 'team_created_at';
    const UPDATED_AT = 'team_updated_at';
    const DELETED_AT = 'team_deleted_at';
    use SoftDeletes;

    public function toOrganisasi()
    {
        return $this->hasOne(OrganisasiModel::class, "organisasi_id", "organisasi_id");
    }
}
