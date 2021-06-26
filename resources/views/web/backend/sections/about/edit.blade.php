@extends('web.backend.layout')

@section('title', 'ჩვენზე რედაქტირება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12 col-md-10">
            <h4 class="m-0">ჩვენზე რედაქტირება</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <form role="form" method="post" action="{{route('about.update', $about->id)}}" enctype="multipart/form-data">
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
                                <div id="illustration-wrapper">
                                    <img id="output" class="output-img" src="{{$about->illustration ? asset($about->getUrlPath().'/'.$about->illustration) : ''}}" alt="{{$about->illustration ? $about->illustration.'-img' : ''}}"/>
                                    @if($about->illustration)
                                        <button href="javascript:;"
                                            onclick="removeItem('{{$about->illustration}}',`{{route('about.remove.illustration', $about->id)}}`, event)"
                                            class="btn btn-danger">
                                            <i class="fldemo glyphicon glyphicon-remove"></i>
                                            Remove
                                        </button>
                                    @endif
                                </div>
                        </div>
                        
                        <div class="form-group flex-column">
                            <label for="video">ლინკი</label>
                            <input type="text" class="form-control" name="video" value="{{old('video') ?? ( $about->video ?? '' ) }}" id="video" placeholder="შეიყვანეთ ვიდეოს ლინკი">
                            @error('video')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group flex-column">
                            <label for="pinned_click">აპინული მთავარ გვერდზე ?</label>
                            <input type="checkbox" class="toggle-switch form-control" id="pinned_click" name="pinned" @if($about->pinned) checked="checked" @endif data-toggle="toggle" >
                            @error('pinned')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group flex-column">
                            <label for="topic_btn">გამოჩდეს თემის ღილაკი ?</label>
                            <input type="checkbox" class="toggle-switch form-control" id="topic_btn" name="topic_btn" @if($about->topic_btn) checked="checked" @endif data-toggle="toggle" >
                            @error('topic_btn')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group flex-column">
                            <label for="register_btn">გამოჩდეს რეგისტრაციის ღილაკი ?</label>
                            <input type="checkbox" class="toggle-switch form-control" id="register_btn" name="register_btn" @if($about->register_btn) checked="checked" @endif data-toggle="toggle" >
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
                                    <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title') ?? ( $about->translate($language->locale)->title ?? '' ) }}" placeholder="შეიყვანეთ სათაური">
                                    @error($language->locale.'.title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-text'}}">ტექსტი ({{$language->locale}})</label>
                                    <textarea class="tinymce-editor" id="{{$language->locale.'-text'}}" name="{{$language->locale}}[text]" rows="8" cols="80">{!!old($language->locale.'.text') ?? ( $about->translate($language->locale)->text ?? '' )!!}</textarea>
                                    @error($language->locale.'.text')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">განახლება</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</br>
@include('web.backend.sections.about.illustrations.helper', ['about' => $about])

@endsection

@section('scripts')
<script type="text/javascript">
    var loadFile = function (event) {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endSection