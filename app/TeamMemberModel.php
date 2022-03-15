<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMemberModel extends Model
{
    protected $table = 'team_member';
    protected $primaryKey = "team_member_id";
    const CREATED_AT = 'team_member_created_at';
    const UPDATED_AT = 'team_member_updated_at';
    const DELETED_AT = 'team_member_deleted_at';
    use SoftDeletes;
}
