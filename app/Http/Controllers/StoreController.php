<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StoreController extends Controller
{
    public function index(){
        return Store::all();
    }

    public function update(Request $request, $id)
        {
            $table = Store::findOrFail($id);

            if($request->file('image')){
                $imageName = time().'.'. $request->file('image')->extension();
                $request->file('image')->move(public_path('images'), $imageName);
                $table->img = $imageName;
            }
            $table->name = $request->name;
            $table->title = $request->title;
            $table->save();

            return $table;
        }
 }
