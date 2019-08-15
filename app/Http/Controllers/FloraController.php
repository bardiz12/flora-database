<?php

namespace App\Http\Controllers;

use App\Model\Flora;
use App\Model\Family;
use App\Model\Status;
use App\Model\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FloraController extends Controller
{
    public function index(){
        return view('admin.flora.index',[
            'data'=>Flora::orderBy('id','desc')->paginate(20),
            'families'=>Family::all(),
            'kategori'=>Kategori::all(),
            'status_iucn'=>Status::where('type','iucn')->get(),
            'status_cites'=>Status::where('type','cites')->get()
        ]);
    }

    public function store(Request $request){
        /*id: 59
family_id: 29
locale_name: -
scientific_name: Leea aequata
kategori: 1
endemik: -
status_uu_id: on
status_iucn_id: null
status_cites_id: null*/
        $validator = Validator::make($request->all(),[
            'id'=>'sometimes|integer|exists:flora,id',
            'family_id'=>'required|integer|exists:family,id',
            'locale_name'=>'required|string',
            'images'=>'required|array|size:5',
            'scientific_name'=>'required|string|unique:flora,scientific_name'.($request->input('id') ? ','.$request->input('id') : '' ),
            'kategori_id'=>'required|integer|exists:kategori,id',
            'endemik'=>'string',
            'status_uu_id'=>'boolean|required',
            'status_iucn_id'=>'integer|required|exists:status,id',
            'status_cites_id'=>'integer|required|exists:status,id',
        ]);

        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            if($request->input('id')){
                $store = $request->except(['images','id']);
                $store['images'] = [];
                foreach ($request->input('images') as $key => $value) {
                    $store['images'][] = $value !== null ? (str_replace(env('APP_URL'),"",$value)) : null;
                }
                $request->session()->flash('msg', 'Berhasil Memperbarui Data');
                Flora::find($request->input('id'))->update($store);
            }else{
                $store = $request->except('images');
                $store['images'] = [];
                foreach ($request->input('images') as $key => $value) {
                    $store['images'][] = $value !== null ? (str_replace(env('APP_URL'),"",$value)) : null;
                }
                $request->session()->flash('msg', 'Berhasil Menambahkan Data');
                Flora::create($store);
            }

            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.flora.index');
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'required|integer|exists:flora,id'
        ]);

        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            Flora::find($request->input('id'))->delete();
            $request->session()->flash('msg', "Berhasil menghapus Data");
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.flora.index');
    }

    public function create(){
        return view('admin.flora.add',[
            'families'=>Family::all(),
            'kategori'=>Kategori::all(),
            'status_iucn'=>Status::where('type','iucn')->get(),
            'status_cites'=>Status::where('type','cites')->get()
        ]);
    }
}
