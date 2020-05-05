<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticAccess extends Model
{
    protected $table = 'statistic_access';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    public $timestamps = true;
}
