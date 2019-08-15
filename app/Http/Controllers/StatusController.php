<?php

namespace App\Http\Controllers;

use App\Model\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function index(){
        return view('admin.status.index',[
            'data'=>Status::orderBy('id','desc')->withTrashed()->get()
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'id'=>'sometimes|integer|exists:status,id',
            'type'=>['required','string',Rule::in(['iucn','cites'])],
            'name'=>'required|string',
            'description'=>'sometimes|string'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            if($request->input('id')){
                $request->session()->flash('msg', "Berhasil memperbarui data");
                Status::find($request->input('id'))->update($request->except('id'));
            }else{
                $request->session()->flash('msg', "Berhasil menambahkan data");
                Status::create($request->all());
            }
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.status.index');
    }

    public function toggleTrash(Request $request,$id){
        $validator = Validator::make(['id'=>$id],[
            'id'=>'required|exists:status,id'
        ]);
        if($validator->fails()){
            $request->session()->flash('msg', implode("<br/>",$validator->errors()->all()));
            $request->session()->flash('msg-status', "danger");
        }else{
            $family = Status::withTrashed()->find($id);
            if($family->trashed()){
                $request->session()->flash('msg', "data telah didaftarkan ke list lagi");
                $family->restore();
            }else{
                if($family->floraStatusIUCN->count() <= 0 || $family->floraStatusCITES->count() <= 0){
                    $family->forceDelete();
                }else{
                    $family->delete();
                }
                $request->session()->flash('msg', "data telah dihapus dari list");
                
            }
            $request->session()->flash('msg-status', "success");
        }
        return redirect()->route('admin.status.index');
    }

    public function create(Request $request){
        return view('admin.status.add');
    }
}
