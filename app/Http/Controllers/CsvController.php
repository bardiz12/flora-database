<?php

namespace App\Http\Controllers;

use App\Model\Flora;
use App\Model\Family;
use App\Model\Status;
use App\Model\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CsvController extends Controller
{
    public function index(){
        return view('admin.import.index');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'file'=>'required|file|mimes:csv,txt'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
            return redirect()->route('admin.import.index');
        }else{
            $berhasil = 0;
            $gagal = 0;
            $gagals = [];
            $path = $request->file('file')->getRealPath();
            $data = array_map(function($var){
                return str_getcsv($var,";");
            }, file($path));
            $families = [];
            $kategories = [];
            $status = (Object) ['iucn'=>[],'cites'=>[]];
            for ($i=1; $i < count($data); $i++) { 
                
                $row =& $data[$i];
                if(!isset($families[$row[0]])){
                    $f = Family::where('name',$row[0])->first();
                    if($f == null){
                        $f = Family::create([
                            'name'=>$row[0]
                        ]);
                    }
                    $families[$row[0]] = $f;
                }

                if(!isset($kategories[$row[3]])){
                    $f = Kategori::where('name',$row[3])->first();
                    if($f == null){
                        $f = Kategori::create([
                            'name'=>$row[3]
                        ]);
                    }
                    $kategories[$row[3]] = $f;
                }

                if(!isset($status->iucn[$row[6]])){
                    $f = Status::where('type','iucn')->where('name',$row[6])->first();
                    if($f == null){
                        $f = Status::create([
                            'name'=>$row[6],
                            'type'=>'iucn'
                        ]);
                    }
                    $status->iucn[$row[6]] = $f;
                }

                if(!isset($status->cites[$row[7]])){
                    $f = Status::where('type','cites')->where('name',$row[7])->first();
                    if($f == null){
                        $f = Status::create([
                            'name'=>$row[7],
                            'type'=>'cites'
                        ]);
                    }
                    $status->cites[$row[7]] = $f;
                }
               
                /*0 => "﻿Family"
    1 => "Scientific_Name"
    2 => "Locale_name"
    3 => "Kategori"
    4 => "Endemik"
    5 => "Status_UU"
    6 => "Status_IUCN"
    7 => "Status_CITES"*/
                if(count($row) == 8){
                    if(Flora::where('scientific_name',$row[1])->count() == 0){
                        Flora::create([
                            'family_id'=>$families[$row[0]]->id,
                            'locale_name'=>$row[2],
                            'images'=>[null,null,null,null,null],
                            'scientific_name'=>$row[1],
                            'kategori_id'=>$kategories[$row[3]]->id,
                            'endemik'=>$row[4],
                            'status_uu_id'=> strtolower($row[5]) == "dilindungi" ? 1 : 0,
                            'status_iucn_id'=>$status->iucn[$row[6]]->id,
                            'status_cites_id'=>$status->cites[$row[7]]->id,
                        ]);
                        $berhasil++;
                    }else{
                        $gagal++;
                        $gagals[] = $row[1]." sudah terdaftar";
                    }
                }else{
                    $gagals[] = $row[1]." tidak memuat seluruh data";
                    $gagal++;
                }
            }
            $txt = $berhasil." data berhasil di Import <br/>";
            $txt.= $gagal." data <span class='badge badge-warning'>GAGAL</span> di import <br/><ol>";
            foreach ($gagals as $key => $value) {
                $txt.="<li>".$value."</li>";
            }
            $txt.="</ol>";
            $request->session()->flash('msg', $txt);
            $request->session()->flash('msg-status', "primary");
            return redirect()->route('admin.flora.index');
        }
    }
}
