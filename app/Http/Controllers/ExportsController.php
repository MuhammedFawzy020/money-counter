<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exports;
use Auth;
class ExportsController extends Controller
{
    public function index(){
        $exports = exports::get();
        return view('dashboard.exports.index')->with('exports' , $exports);
    }

    public function create(){
        return view('dashboard.exports.create');
    }

    public function store(Request $request){
        $export = new exports($request->all());
        $export->user_id = Auth::user()->id;
        $export->save();
        return back()->with('success' ,'تم حفظ الصادرات بنجاح');
    }
    

    public function update(Request $request){
        $export = exports::findOrFail($request->id);
        $export->update($request->all());
        $export->save();
        return back()->with('success' ,'تم تعديل الصادر بنجاح');
    }
    

    public function delete($id){
        $export = exports::findOrFail($id); 
        $export->delete();
        return back()->with('success' ,'تم حذف الصادر بنجاح');
    }
}
