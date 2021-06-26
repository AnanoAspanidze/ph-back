@extends('web.backend.layout')

@section('title', 'ილუსტრაციის დამატება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0">ილუსტრაციის დამატება</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
 
            <form role="form" method="post" action="{{route('illustration.store', $about_id)}}" enctype="multipart/form-data">
            @csrf
            
            <div class="card card-primary">
                <div class="card-body">
                    
                    <div class="upload-image-wrapper">

                        <div class="form-group">
                            <label for="illustration">ილუსტრაცია</label><span style="color:red;"> *</span>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" id="illustration"
                                    name="illustration" onchange="loadFile(event)" style="display: none;">
                                <label class="custom-file-label" for="illustration" style="cursor: pointer;">ატვირთეთ
                                    ილუსტრაცია</label>
                                </div>
                            </div>
                            <img id="output" class="output-img" />
                        </div>
                        @error('illustration')
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
                                    <label for="{{$language->locale.'-title'}}">სათაური ({{$language->locale}})</label><span style="color:red;"> *</span>
                                    <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title')}}" placeholder="შეიყვანეთ სათაური">
                                    @error($language->locale.'.title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-file_name'}}">აღწერა ({{$language->locale}})</label><span style="color:red;"> *</span>
                                    <input type="text" class="form-control" id="{{$language->locale.'-file_name'}}" name="{{$language->locale}}[file_name]" value="{{old($language->locale.'.file_name')}}" placeholder="შეიყვანეთ ფაილის დასახელება">
                                    @error($language->locale.'.file_name')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach                   
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">დამატება</button>
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