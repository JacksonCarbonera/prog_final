<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class Produto extends Model
{
    use HasFactory;


    protected $fillable = [
        'price',
        'name',
        'description',
        'photo'
    ];
    
    public static function insert($file, $name, $description, $price){
        
        try{
            // Uso transactions aqui pra garantir que a imagem não sera adicionada no banco de dados sem antes estar dentro do diretorio
            DB::beginTransaction();

            $image = Produto::create([
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'photo' => Str::random(25)
            ]);

            // Estou usando uma biblioteca para manipulação de imagens
            $imagem_salva = Image::make($file->getPathName());


            // Garanto que o diretorio existe e salvo a imagem com 80% de qualidade e em png(pois quero garantir quero garantir que a transparencia seja preservada)
            $path = storage_path('app/images/');

            File::ensureDirectoryExists($path);

            $imagem_salva->save($path.$image->raw_produto_url.'.jpeg', 80, 'jpeg'); 

            DB::commit();

            return $image;
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }


    // Uso os mutators do laravel pra mudar o valor das propriedades acessadas da model
    // propriedades como URL ja são convertidas para a url real da foto

    public function getHumanizedCreatedAtAttribute(){
        return  $this->created_at->ago(['parts' => 1]);
    }

    public function getRawPhotoUrlAttribute(){
        return $this->attributes['photo'];
    }

    public function getPhotoUrlAttribute(){
        return route('midia',['id' => $this->raw_photo_url]);
    }

    public function getPhotoContentAttribute(){
        return file_get_contents(storage_path('app/images/'.$this->raw_produto_url.'.jpeg'));
    }
}
