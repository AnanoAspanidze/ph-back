@extends('web.backend.layout')

@section('title', 'ჩვენზე დამატება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12 col-md-10">
            <h4 class="m-0">ჩვენზე დამატება</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <form role="form" method="post" action="{{route('about.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="card card-primary">
                    <div class="card-body">                    
                        
                        <div class="form-group">
                            <label for="illustrationFile">ვიდეოს პრევიუ</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" id="illustrationFile" name="illustration" onchange="loadFile(event)"
                                    style="display: none;">
                                    <label class="custom-file-label" for="illustrationFile" style="cursor: pointer;">ატვირთეთ ილუსტრაცია</label>
                                </div>
                            </div>
                            <img id="output" class="output-img" />
                        </div>
                        
                        <div class="form-group flex-column">
                            <label for="video">ლინკი</label>
                            <input type="text" class="form-control" name="video" value="{{old('video')}}" id="video" placeholder="შეიყვანეთ ვიდეოს ლინკი">
                            @error('video')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group flex-column">
                            <label for="pinned_click">აპინული მთავარ გვერდზე ?</label>
                            <input type="checkbox" class="toggle-switch form-control" id="pinned_click" name="pinned" @if(old('pinned')) checked="checked" @endif data-toggle="toggle" >
                            @error('pinned')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group flex-column">
                            <label for="topic_btn">გამოჩდეს თემის ღილაკი ?</label>
                            <input type="checkbox" class="toggle-switch form-control" id="topic_btn" name="topic_btn" @if(old('topic_btn')) checked="checked" @endif data-toggle="toggle" >
                            @error('topic_btn')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group flex-column">
                            <label for="register_btn">გამოჩდეს რეგისტრაციის ღილაკი ?</label>
                            <input type="checkbox" class="toggle-switch form-control" id="register_btn" name="register_btn" @if(old('register_btn')) checked="checked" @endif data-toggle="toggle" >
                            @error('register_btn')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <ul class="nav nav-tabs" id="languages" role="tablist">
                    @foreach($languages as $language)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{$language->locale === 'ka' ? 'active' : ''}}" id="{{$language->locale}}-tab" data-toggle="tab" data-target="#{{$language->locale}}" type="button"
                        role="tab" aria-controls="{{$language->locale}}" aria-selected="true">{{$language->name}}</a>
                    </li>
                    @endforeach
                </ul>
                
                <div class="tab-content" id="languagesContent">
                    @foreach($languages as $language)
                    <div class="tab-pane fade show {{$language->locale === 'ka' ? 'active' : ''}}" id="{{$language->locale}}" role="tabpanel" aria-labelledby="{{$language->locale}}-tab">
                        <div class="card card-primary">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="{{$language->locale.'-title'}}">სათაური ({{$language->locale}})<span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title')}}" placeholder="შეიყვანეთ სათაური">
                                    @error($language->locale.'.title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-text'}}">ტექსტი ({{$language->locale}})</label>
                                    <textarea class="tinymce-editor" id="{{$language->locale.'-text'}}" name="{{$language->locale}}[text]" rows="8" cols="80">{!!old($language->locale.'.text')!!}</textarea>
                                    @error($language->locale.'.text')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">დამატება</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var loadFile = function (event) {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endSection