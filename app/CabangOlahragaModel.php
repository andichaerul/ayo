<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CabangOlahragaModel extends Model
{
    protected $table = 'cab_olahraga';
    protected $primaryKey = "cab_olahraga_id";
    const CREATED_AT = 'cab_olahraga_created_at';
    const UPDATED_AT = 'cab_olahraga_updated_at';
    const DELETED_AT = 'cab_olahraga_deleted_at';
    use SoftDeletes;
}
