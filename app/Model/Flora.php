<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Flora extends Model
{
    protected $table = 'flora';
    protected $fillable = [
        'family_id',
        'images',
        'endemik',
        'locale_name',
        'scientific_name',
        'kategori_id',
        'status_uu_id',
        'status_iucn_id',  
        'status_cites_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function family()
    {
        return $this->hasOne('App\Model\Family', 'id', 'family_id');
    }

    /*public function setStatusUuIdAttribute($value){
        $this->attributes['status_iucn_id'] = $value ? 'Dilindungi' : 'Tidak Dilindungi';
    }*/

    public function statusIucn()
    {
        return $this->hasOne('App\Model\Status', 'id', 'status_iucn_id');
    }

    public function statusCites()
    {
        return $this->hasOne('App\Model\Status', 'id', 'status_cites_id');
    }

    public function kategori()
    {
        return $this->hasOne('App\Model\Kategori', 'id', 'kategori_id');
    }

    


    
}