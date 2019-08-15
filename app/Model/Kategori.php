<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'name',
        'description'
    ];

    use softDeletes;

    public function flora()
    {
        return $this->hasMany('App\Model\Flora', 'kategori_id', 'id');
    }
}
