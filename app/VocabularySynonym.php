<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VocabularySynonym extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'vocabulary_synonym';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';
    public $timestamps = false;

}
