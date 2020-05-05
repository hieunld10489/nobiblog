<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VocabularyType extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'vocabulary_type';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';
    public $timestamps = false;

}
