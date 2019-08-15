<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    protected $table = 'family';
    protected $fillable = [
        'name'
    ];

    use SoftDeletes;

    public function flora()
    {
        return $this->hasMany('App\Model\Flora', 'family_id', 'id');
    }
    
}
