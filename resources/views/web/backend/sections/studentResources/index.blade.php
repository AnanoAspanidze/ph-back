@extends('web.backend.layout')

@section('title', 'მოსწავლის რესურსი')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">მოსწავლის რესურსი</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        @foreach($topics as $topic)
        <div>
            <a href="{{route('student_resources.resources', $topic->id)}}" class="resource__theme__item">
                <img src="{{asset('storage/topic/min_'.$topic->illustration)}}" alt="theme"
                    class="resource__theme__item__img">
                <h2 class="resource__theme__item__title">{{ \Str::limit($topic->title, 50)}}</h2>
            </a>
        </div>
        @endforeach
    </div>
@endsection