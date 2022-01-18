@extends('templates.base')
@section('title', $produto->name)
@section('h1', $produto->name)

@section('content')


<img src="{{$produto->photo_url}}">



<p>Descricao <br/>{{$produto->description}}</p>

<p>Preço: R$ {{$produto->price}}</p>



@endsection