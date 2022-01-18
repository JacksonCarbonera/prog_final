<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{
    public function create(Request $request){
        $form = $request->validate([
            'image' => 'image|max:400000|required|mimes:jpg,png,jpeg',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);


        $produto = Produto::insert($form['image'],  $form['name'], $form['description'], $form['price']);

        return redirect()->route('item', ['id' => $produto->id]);
    }

    public function getProductPhoto($url){
        
        $produto = Produto::where('photo', $url)->first()?->photo_content;
        if (!$produto) {
            return response('',404);
        }
        return response($produto)
                ->header('Content-Type','image/webp')
                ->header('Cache-Control', 'max-age=31536000') // Faz o cliente fazer cache da produto
                ->header('Content-Lenght' , strlen($produto));
    }



    public function item($id){
        return view('produtos.view')->with('produto', Produto::findOrFail($id));
    }

    public function index(){
        return view('home')->with(['produtos' => Produto::orderBy('name')->get()]);
    }
}
