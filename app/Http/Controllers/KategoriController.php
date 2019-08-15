<?php

namespace App\Http\Controllers;

use App\Model\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(){
        return view('admin.kategori.index',[
            'data'=>Kategori::withTrashed()->orderBy('id','desc')->get()
        ]);
    }

    public function toggleTrash(Request $request,$id){
        $validator = Validator::make(['id'=>$id],[
            'id'=>'required|exists:kategori,id'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            $family = Kategori::withTrashed()->find($id);
            if($family->trashed()){
                $request->session()->flash('msg', "data telah didaftarkan ke list lagi");
                $family->restore();
            }else{
                if($family->flora->count() <= 0){
                    $family->forceDelete();
                }else{
                    $family->delete();
                }
                $request->session()->flash('msg', "data telah dihapus dari list");
                
            }
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.kategori.index');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'sometimes|integer|exists:status,id',
            'name'=>'required|string',
            'description'=>'sometimes|string'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            if($request->input('id')){
                $request->session()->flash('msg', "Berhasil memperbarui data");
                Kategori::find($request->input('id'))->update($request->except('id'));
            }else{
                $request->session()->flash('msg', "Berhasil menambahkan data");
                Kategori::create($request->all());
            }
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.kategori.index');
    }

    public function create(){
        return view('admin.kategori.add');
    }

}
