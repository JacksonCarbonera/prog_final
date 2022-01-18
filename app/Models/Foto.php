<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class Foto extends Model
{
    use HasFactory;
    protected $table = 'fotos';


    
    protected $fillable = [
        'title',
        'description',
        'url'
    ];
    
    public static function insert($file, $title, $description){
        
        try{
            // Uso transactions aqui pra garantir que a imagem não sera adicionada no banco de dados sem antes estar dentro do diretorio
            DB::beginTransaction();

            $image = Foto::create([
                'title' => $title,
                'description' => $description,
                'url' => Str::random(25)
            ]);

            // Estou usando uma biblioteca para manipulação de imagens
            $imagem_salva = Image::make($file->getPathName());


            // Garanto que o diretorio existe e salvo a imagem com 80% de qualidade e em png(pois quero garantir quero garantir que a transparencia seja preservada)
            $path = storage_path('app/images/');

            File::ensureDirectoryExists($path);

            $imagem_salva->save($path.$image->raw_url.'.png', 80, 'png'); 

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

    public function getRawUrlAttribute(){
        return $this->attributes['url'];
    }

    public function getUrlAttribute(){
        return route('midia',['id' => $this->raw_url]);
    }

    public function getContentsAttribute(){
        return file_get_contents(storage_path('app/images/'.$this->raw_url.'.png'));
    }
}
