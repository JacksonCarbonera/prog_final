@extends('templates.base')
@section('title', $midia->title)
@section('h1', $midia->title)

@section('content')


<img src="{{$midia->url}}">

<p>{{$midia->description}}</p>

<p>Uploaded : {{$midia->created_at->format('d/m/Y')}} - {{$midia->humanized_created_at}}</p>


@endsection