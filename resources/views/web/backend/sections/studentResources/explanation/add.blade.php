@extends('web.backend.layout')

@section('title', 'განმარტების დამატება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0">განმარტების დამატება</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
 
            <form role="form" method="post" action="{{route('explanation_page.store', $resource_id)}}" enctype="multipart/form-data">
            @csrf
            
            <div class="card card-primary">
                <div class="card-body">
                    
                    <div class="form-check form-group">
                    <input type="checkbox" class="form-check-input" @if( old('type') || old('layout') ) checked="checked"  @endif id="page-has-main-visual">
                    <label class="form-check-label" for="exampleCheck1">აქვს თუ არა გვერდს მთავარი
                        ვიზუალი?</label>
                    </div>

                    <div id="main-visual-options" style="display: {{ (old('type') || old('layout')) ? 'block' : 'none'  }}">
                        <div class="form-group">
                            <label for="layout" >აირჩიეთ გვერდის ლეიაუთი</label>
                            <select class="form-control" id="layout" name="layout">
                                <option value="">აირჩიეთ</option>
                                @foreach(config('studentpages.layouts') as $key => $value)
                                    <option value="{{$key}}" @if (old('layout') == $key) selected="selected" @endif >{{$value}}</option>
                                @endforeach
                            </select>
                            @error('layout')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="main-visual-type">რა ტიპისაა მთავარი ვიზუალი?</label>
                            <select class="form-control" name="type" id="main-visual-type">
                                <option value="">აირჩიეთ</option>
                                @foreach(config('studentpages.types') as $key => $value)
                                    <option value="{{$key}}" @if (old('type') == $key) selected="selected" @endif>{{$value['name']}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="upload-image-wrapper " style="display: {{ old('type') === 'image'  ? 'block' : 'none'  }}">

                        <div class="form-group">
                            <label for="illustration">ილუსტრაცია</label>
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

                    <div id="upload-video-wrapper" style="display: {{ old('type') === 'video'  ? 'block' : 'none'  }}">

                        <div class="form-group">
                            <label for="videoURL">ვიდეოს ლინკი youtube-დან</label>
                            <input type="text" class="form-control" id="videoURL" name="video" value="{{old('video')}}" placeholder="შეიყვანეთ ლინკი">
                            @error('video')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-check form-group">
                        <input type="checkbox" name="show_steps" @if(old('show_steps')) checked="checked" @endif class="form-check-input">
                        <label class="form-check-label" for="exampleCheck1">გამოჩნდეს ნაბიჯების ჩამონათვალი</label>
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
                                    <label for="{{$language->locale.'-sub_title'}}">ქვესათაური ({{$language->locale}})</label>
                                    <input type="text" class="form-control" id="{{$language->locale.'-sub_title'}}" name="{{$language->locale}}[sub_title]" value="{{old($language->locale.'.sub_title')}}" placeholder="შეიყვანეთ ქვესათაური">
                                    @error($language->locale.'.sub_title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-description'}}">ტექსტი ({{$language->locale}})</label><span style="color:red;"> *</span>
                                    <textarea class="tinymce-editor" id="{{$language->locale.'-description'}}" name="{{$language->locale}}[description]" rows="8" cols="80">{!!old($language->locale.'.description')!!}</textarea>
                                    @error($language->locale.'.description')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="upload-image-wrapper" style="display: {{ old('type') === 'image'  ? 'block' : 'none'  }}">

                                    <div class="form-group">
                                        <label for="{{$language->locale.'-illustration_title'}}">ილუსტრაციის სათაური ({{$language->locale}})</label>
                                        <input type="text" class="form-control" name="{{$language->locale}}[illustration_title]" id="{{$language->locale.'-illustration_title'}}" placeholder="შეიყვანეთ სათაური" value="{{old($language->locale.'.illustration_title')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$language->locale.'-illustration_desc'}}">ილუსტრაციის აღწერა ({{$language->locale}})</label>
                                        <input type="text" class="form-control" name="{{$language->locale}}[illustration_desc]" id="{{$language->locale.'-illustration_desc'}}" placeholder="შეიყვანეთ აღწერა" value="{{old($language->locale.'.illustration_desc')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$language->locale.'-illustration_source'}}">ილუსტრაციის წყარო ({{$language->locale}})</label>
                                        <input type="text" class="form-control" name="{{$language->locale}}[illustration_source]" id="{{$language->locale.'-illustration_source'}}" placeholder="შეიყვანეთ წყარო" value="{{old($language->locale.'.illustration_source')}}">
                                    </div>

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
    $(document).ready(function () {

        // $("#main-visual-options").hide();
        // $(".upload-image-wrapper").hide();
        // $("#upload-video-wrapper").hide();

        $('#page-has-main-visual').on('change', function (e) {
            if ($(this).is(':checked')) {

                $("#main-visual-options").show();
            } else {
                $("#main-visual-options").hide();
                $(".upload-image-wrapper").hide();
                $("#upload-video-wrapper").hide();
            }
        });

        $("#main-visual-type").change(function () {
            var val = $(this).val();

            if (val == "image") {

                $("#upload-video-wrapper").hide();
                $(".upload-image-wrapper").show();
            }
            else if (val == "video") {
                $(".upload-image-wrapper").hide();
                $("#upload-video-wrapper").show();
            }
            else {
                $(".upload-image-wrapper").hide();
                $("#upload-video-wrapper").hide();
            }
        });

    });
    var loadFile = function (event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile2 = function (event) {
        var image = document.getElementById('output2');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    $(function () {
        $("#mainDataTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        });
    });
</script>
@endSection