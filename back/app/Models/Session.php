<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Session
 */
class Session extends Model
{
    use SoftDeletes;

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = ['name','start','end'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

}
