<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{

    public function index(){
        $items = Item::all();
        return view('list')->with('items',$items);

    }

    public function create(Request $request){
    $item = new Item;
    $item->item = $request->text;
    if($item->save()){
        return response()->json(['data'=>$item,'message'=>'Record successfully added'],201);
    }else{
        return response()->json(['message'=>'faild'],400);
    }
    }

    public function delete(Request $request){
      Item::where('id',$request->id)->delete();

     
    }

    public function Update(Request $request){
    $item = Item::find($request->id);
     $item->item = $request->value;
     $item->save(); 
    }

    
}
