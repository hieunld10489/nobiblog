<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $table = 'access_log';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    public $timestamps = true;

    /**
     * 複数代入する属性
     *
     * @var array
     */
    protected $fillable = ['user_id', 'ref_page', 'device_type', 'client_ip','user_agent'];
}
