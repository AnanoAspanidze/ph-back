@extends('web.backend.layout')

@section('title', 'ნაბიჯის დამატება')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12 col-md-10">
            <h4 class="m-0">ნაბიჯის დამატება</h4>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <form role="form" method="post" action="{{route('step_page.store', $topic->id)}}" enctype="multipart/form-data">
            @csrf
                <div class="card card-primary">

                    <div class="card-body">

                        <div class="form-group">
                            <label for="resourceFile">ილუსტრაცია (კვადრატული ან ოდნავ სიგანეში მეტი)</label><span style="color:red;"> *</span>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="illustrationFile" name="illustration" onchange="loadFile(event)" style="display: none;">
                                <label class="custom-file-label" for="illustrationFile" style="cursor: pointer;">ატვირთეთ
                                ილუსტრაცია</label>
                            </div>
                            </div>
                            <img id="output" class="output-img" />
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
                                    <label for="{{$language->locale.'-sub_title'}}">ქვესათაური ({{$language->locale}})</label>
                                    <input type="text" class="form-control" id="{{$language->locale.'-sub_title'}}" name="{{$language->locale}}[sub_title]" value="{{old($language->locale.'.sub_title')}}" placeholder="შეიყვანეთ ქვესათაური">
                                    @error($language->locale.'.sub_title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-description'}}">ტექსტი ({{$language->locale}})</label>
                                    <textarea class="tinymce-editor" id="{{$language->locale.'-description'}}" name="{{$language->locale}}[description]" rows="8" cols="80">{!!old($language->locale.'.description')!!}</textarea>
                                    @error($language->locale.'.description')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                
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
      $("#resourceTypeSelect").change(function () {
        var val = $(this).val();
        if (val == "ლინკი") {
          $(".resourceTypeSelectLink").addClass('active');
        }
        else {
          $(".resourceTypeSelectLink").removeClass('active');
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