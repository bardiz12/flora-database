<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Family;
use App\Model\Flora;
use Illuminate\Support\Facades\Validator;

class FrontDataController extends Controller
{
    public function families()
    {
        $headers = [];
        $families = Family::all();
        $raw = [];
        $families->each(function (Family $f) use (&$raw) {
            $awalan = strtolower(substr($f->name, 0, 1));
            if (!isset($raw[$awalan])) {
                $raw[$awalan] = [
                    'alphabet' => $awalan,
                    'data' => [],
                ];
            }
            $raw[$awalan]['data'][] = $f;
        });
        foreach ($raw as $i => &$a) {
            foreach ($raw as $j => &$b) {
                if(ord($a['alphabet']) < ord($b['alphabet'])){
                    $tmp = $b;
                    $b = $a;
                    $a = $tmp;
                }
            }
        }
        $pembagi = round(count($raw) / 3);
        $data = ['part_1' => null, 'part_2' => null, 'part_3' => null];
        $i = 1;
        $key = 0;
        foreach ($raw as $value) {
            if ($key !== 0 && $key % $pembagi == 0) {
                $i++;
            }
            $data['part_' . $i][] = $value;
            $key++;
        }
        return response()->json(['is_ok' => true, 'result' => $data], 200, $headers);
    }

    public function floraByFamily($name = null)
    {
        $validator = Validator::make(['name' => $name], [
            'name' => 'required|string|exists:family,name',
        ],[
            'name.exists'=>'Family tidak ditemukan'
        ]);
        if ($validator->fails()) {
            return response()->json(['is_ok' => false, 'msg' => [
                'type' => 'error',
                'title' => 'Oops..',
                'html' => implode("<br/>", $validator->errors()->all()),
            ]], 200);
        } else {
            $raw = [];
            $families = Family::where('name', $name)->firstOrFail();
            $families->flora->each(function (Flora $f) use (&$raw,$name) {
                $awalan = strtolower(substr($f->scientific_name, 0, 1));
                if (!isset($raw[$awalan])) {
                    $raw[$awalan] = [
                        'alphabet' => $awalan,
                        'data' => [],
                    ];
                }
                $raw[$awalan]['data'][] = [
                        'locale_name' => $f->locale_name,
                        'family' => $name,
                        'scientific_name'=>$f->scientific_name,
                        'image'=>$f->images[0]
                    ];
            });
            foreach ($raw as $i => &$a) {
                foreach ($raw as $j => &$b) {
                    if(ord($a['alphabet']) < ord($b['alphabet'])){
                        $tmp = $b;
                        $b = $a;
                        $a = $tmp;
                    }
                }
            }
            //dd($raw);
            $pembagi = round(count($raw) / 3);
            $data = [['id'=>'part_1','data'=>[]], ['id'=>'part_2','data'=>[]],['id'=>'part_3','data'=>[]],];
            $i = 1;
            $key = 0;
            if(count($raw) >= 10){
                foreach ($raw as $value) {
                    if ($key !== 0 && $key % $pembagi == 0) {
                        $i++;
                    }
                    $data[$i]['data'][] = $value;
                    $key++;
                }
            }else{
                foreach ($raw as $key => $value) {
                    
                    $data[0]['data'][] = $value;
                }
            }
            //dd($data);
            return response()->json([
                'is_ok' => true,
                'result' => $data,
            ], 200);
        }
    }

    public function flora($family_name,$scientific_name){
        $validator = Validator::make(['family_name' => $family_name,'scientific_name'=> $scientific_name], [
            'family_name' => 'required|string|exists:family,name',
            'scientific_name' => 'required|string|exists:flora,scientific_name'
        ],[
            'scientific_name.exists'=>'Spesies Tidak Ditemukan'
        ]);
        if ($validator->fails()) {
            return response()->json(['is_ok' => false, 'msg' => [
                'type' => 'error',
                'title' => 'Oops..',
                'html' => implode("<br/>", $validator->errors()->all()),
            ]], 200);
        } else {
            $family = Family::where('name',$family_name)->first();
            $flora = $family->flora()->where('scientific_name',$scientific_name)->firstOrFail();
            $result = (Object) $flora->toArray();
            $result->tanggal = $flora->updated_at->format('d M Y H:i');
            $result->family_name = $family->name;
            $result->status = (Object)[
                'uu' => $flora->status_uu_id ? 'Dilindungi' : 'Tidak dilindungi',
                'iucn'=> $flora->statusIUCN ? $flora->statusIUCN->name : null,
                'cites'=> $flora->statusCITES ? $flora->statusCITES->name : null
            ];
            $result->kategori = $flora->kategori->name;

            $result->others = $family->flora()->where('id','!=',$flora->id)->where('status_uu_id',$flora->status_uu_id)->orWhere('status_iucn_id',$flora->status_uu_id)->orWhere('status_cites_id',$flora->status_uu_id)->orWhere('kategori_id',$flora->kategori_id)->orWhere('endemik',$flora->endemik)->inRandomOrder()->take(10)->get()->map(function(Flora $flora){
                return (Object) ['scientific_name'=>$flora->scientific_name,'family'=>$flora->family->name];
            });
            return response()->json([
                'is_ok'=>true,
                'data'=>$result    
            ], 200);
        }
    }
}
