<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function create(Request $request){
        $form = $request->validate([
            'image' => 'image|max:400000|required|mimes:jpg,png,jpeg',
            'title' => 'required|string',
            'description' => 'required|string'
        ]);


        $img= Foto::insert($form['image'],  $form['title'], $form['description']);

        return redirect()->route('item', ['id' => $img->id]);
    }

    public function get($url){
        
        $foto = Foto::where('url', $url)->first()?->contents;
        if (!$foto) {
            return response('',404);
        }
        return response($foto)
                ->header('Content-Type','image/webp')
                ->header('Cache-Control', 'max-age=31536000') // Faz o cliente fazer cache da foto
                ->header('Content-Lenght' , strlen($foto));
    }



    public function item($id){
        return view('midia.view')->with('midia', Foto::findOrFail($id));
    }

    public function index(){
        return view('home')->with(['images' => Foto::all()]);
    }
}
