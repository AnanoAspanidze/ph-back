@extends('web.backend.layout')

@section('title', 'განმანათლებლის კურსები')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">განმანათლებლის კურსები</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">კურსები</h3>
                <div class="card-header-right">
                    <a href="{{route('teacher_resources.create')}}" class="card-header-btn btn btn-primary">კურსის დამატება</a>
                </div>
            </div>
        </div>
        @foreach($topics as $topic)
        <div>
            <a href="{{route('teacher_resources.course', $topic->course->id)}}" class="resource__theme__item">
                <img src="{{asset('storage/topic/min_'.$topic->illustration)}}" alt="theme"
                    class="resource__theme__item__img">
                <h2 class="resource__theme__item__title">{{ \Str::limit($topic->title, 50)}}</h2>
            </a>
        </div>
        @endforeach
    </div>
@endsection