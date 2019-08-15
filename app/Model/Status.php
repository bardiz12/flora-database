<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = [
        'type',
        'name',
        'description'
    ];

    use SoftDeletes;

    public function floraStatusIUCN()
    {
        return $this->hasMany('App\Model\Flora', 'status_iucn_id', 'id');
    }

    public function floraStatusCITES()
    {
        return $this->hasMany('App\Model\Flora', 'status_cites_id', 'id');
    }
}
