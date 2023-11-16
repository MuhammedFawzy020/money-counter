<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imports;
use Auth;
class ImportsController extends Controller
{
    public function index(){
        $imports = imports::get();
        return view('dashboard.imports.index')->with('imports',$imports);
    }

    public function create(){
        return view('dashboard.imports.create');
    }

    public function store(Request $request){
        $import = new imports($request->all());
        $import->user_id = Auth::user()->id;
        $import->save();
        return back()->with('success' ,'تم حفظ الواردات بنجاح');
    }
    

    public function update(Request $request){
        $import = imports::findOrFail($request->id);
        $import->update($request->all());
        $import->save();
        return back()->with('success' ,'تم تعديل الوارد بنجاح');
    }
    

    public function delete($id){
        $import = imports::findOrFail($id); 
        $import->delete();
        return back()->with('success' ,'تم حذف الوارد بنجاح');
    }
}
