<?php

namespace App\Http\Controllers;

use App\Model\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    public function index(){
        return view('admin.family.index',[
            'data'=>Family::orderBy('id','desc')->withTrashed()->paginate(10)
        ]);
    }

    public function toggleTrash(Request $request,$id){
        $validator = Validator::make(['id'=>$id],[
            'id'=>'integer|required|exists:family,id'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            $family = Family::withTrashed()->find($id);
            if($family->trashed()){
                $request->session()->flash('msg', "data telah didaftarkan ke list lagi");
                $family->restore();
            }else{
                $request->session()->flash('msg', "data telah dihapus dari list");
                $family->delete();
            }
            
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->back();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'sometimes|integer|exists:family,id',
            'name'=>'required|string|unique:family,name'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            if($request->input('id')){
                Family::find($request->input('id'))->update($request->except('id'));
                $request->session()->flash('msg', "data telah diperbarui");
            }else{
                Family::create([
                    'name'=>$request->input('name')
                ]);
                $request->session()->flash('msg', "berhasil menambahkan data baru");
            }
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.family.index');
    }

    public function create(Request $request){
        return view('admin.family.add');
    }
}
