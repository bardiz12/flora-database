<?php

namespace App\Http\Controllers;

use App\Model\Flora;
use App\Model\Family;
use App\Model\Status;
use App\Model\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $data = [
            'totals'=>[
                'Family' => Family::count(),
                'Spesies' => Flora::count(),
                'Kategori' => Kategori::count()
            ],
            'status'=> (Object) [
                'uu'=>(Object) ['dilindungi' => Flora::where('status_uu_id',1)->count(),
                                'tidak_dilindungi' => Flora::where('status_uu_id',0)->count()],
                'iucn'=>Status::where('type','iucn')->get(),
                'cites'=>Status::where('type','cites')->get()
            ]
        ];
        return view('admin.home',$data);
    }
}
