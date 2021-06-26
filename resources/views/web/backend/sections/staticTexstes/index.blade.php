@extends('web.backend.layout')

@section('title', 'საიტის ტექსტები')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h4 class="m-0">საიტის ტექსტები</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">

            <form role="form" method="post" action="{{route('static_textes.update')}}">
            @csrf
                <ul class="nav nav-tabs" id="languages" role="tablist">
                    @foreach($languages as $language)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{$language->locale == 'ka' ? 'active' : ''}}" id="{{$language->locale}}-tab" data-toggle="tab" data-target="#{{$language->locale}}" type="button"
                        role="tab" aria-controls="{{$language->locale}}" aria-selected="true">{{$language->name}}</a>
                    </li>
                    @endforeach
                </ul>
                
                <div class="tab-content" id="languagesContent">
                    @foreach($languages as $language)
                    <div class="tab-pane fade show {{$language->locale == 'ka' ? 'active' : ''}}" id="{{$language->locale}}" role="tabpanel" aria-labelledby="{{$language->locale}}-tab">
                        <div class="card card-primary">
                            <div class="card-body">
                                @foreach ($locales[$language->locale] as $key => $value)
                                    <div class="form-group flex-column">
                                        <label for="text">{{ ucwords(str_replace("_", " ", $key)) }} ({{ $language->locale }})</label>
                                        <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{ $language->locale }}[{{ $key }}]" value="{{$value}}">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    @endforeach              
                </div>

                <div class="card card-primary">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">განახლება</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection