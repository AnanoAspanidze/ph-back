@extends('web.backend.layout')

@section('title', 'დამატებითი რესურსის რედაქტირება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12 col-md-10 m-auto">
            <h4 class="m-0">დამატებითი რესურსის რედაქტირება</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <form role="form" id="additionalEditForm" method="post" action="{{route('additional_resources.update', $pageAdditional->id)}}" enctype="multipart/form-data">
            @csrf
                <div class="card card-primary">

                    <div class="card-body">

                    <div class="form-group">
                        <label>მიმართულება</label><span style="color:red;"> *</span>
                        <select class="form-control" name="direction">
                            <option  @if($pageAdditional->direction == 'student_resource') selected="selected" @endif value="student_resource">მოსწავლის რესურსი</option>
                            <option  @if($pageAdditional->direction == 'teacher_resource')  selected="selected" @endif value="teacher_resource" >განმანათლებლის რესურსი</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>თემა</label><span style="color:red;"> *</span>
                        <select class="form-control" id="topicselect" name="topic_id">
                            @foreach($topics as $topic)
                                <option @if($pageAdditional->topic_id == $topic->id) selected="selected" @endif value="{{$topic->id}}">{{$topic->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>გვერდი (თუ რესურსი ჩანს თემის გვერდზე)</label>
                        <select class="form-control" name="resource_id" id="pageselect">
                            @foreach ($resources as $resource )
                                <option value="{{$resource->id}}" @if($resource->id == $pageAdditional->resource_id) selected="selected" @endif>{{$resource->resourceable->title ?? $resource->resourceable->sub_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ტიპის არჩევა</label><span style="color:red;"> *</span>
                        <select class="form-control" disabled name="type" id="resourceTypeSelect">
                            <option value="">აირჩიეთ დამატებითი რესურსის ტიპი</option>
                            @foreach(config('additionaresource') as $key => $value)
                                <option value="{{$key}}" @if($pageAdditional->type == $key) selected="selected" @endif>{{$value['name']}}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group resourceTypeSelectLink {{$pageAdditional->type == 'link' ? 'active' : ''}}">
                        <label>ლინკის ტიპის არჩევა</label>
                        <select class="form-control" name="sub_type">
                            <option value="" >არჩევა</option>
                            <option value="game" @if($pageAdditional->sub_type === "game") selected="selected" @endif>თამაში</option>
                            <option value="exercise" @if($pageAdditional->sub_type === "exercise") selected="selected" @endif>სავარჯიშო</option>
                        </select>
                    </div>
                    <div class="form-group addResourceFile {{$pageAdditional->type == 'pdf' ? 'active' : ''}}">
                        <label for="resourceFile">pdf ფაილი</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept=".pdf" name="pdf" class="custom-file-input" onchange="loadFile(event, 'file_output', 'file')" id="resourceFile">
                                <label class="custom-file-label" for="resourceFile" style="cursor: pointer;">ატვირთეთ
                                pdf ფაილი</label>
                            </div>
                        </div>
                        @error('pdf')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                        @if($pageAdditional->pdf)
                            <a href="{{asset('storage/additional/files/'.$pageAdditional->pdf)}}" id="file_output" target="_blank" rel="noopener noreferrer">{{$pageAdditional->pdf}}</a>
                        @endif
                    </div>
                    <div class="form-group addResourceImage {{in_array($pageAdditional->type, ['image', 'pdf', 'link']) ? 'active' : ''}}">
                        <label for="resourceImage">ფოტო</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept="image/*" name="image" class="custom-file-input" id="resourceImage" name="image" onchange="loadFile(event, 'output', 'img')" style="display: none;">
                                <label class="custom-file-label" for="resourceImage" style="cursor: pointer;">ატვირთეთ ფოტო</label>
                            </div>
                        </div>
                        @error('image')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                        <img id="output" class="output-img" @if($pageAdditional->image) src="{{asset('storage/additional/images/'.$pageAdditional->image)}}" alt="{{$pageAdditional->image.'-img'}} @endif" />
                    </div>
                    <div class="form-group addResourceLink {{in_array($pageAdditional->type, ['link', 'video']) ? 'active' : ''}}">
                        <label for="resourceLink">ლინკი</label>
                        <input type="text" class="form-control" name="link" value="{{old('$link') ?? ( $pageAdditional->link ?? '' ) }}" id="resourceLink" placeholder="შეიყვანეთ ლინკი">
                        @error('link')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group flex-column">
                        <label for="pinned_click">ჩანს რესურსების გვერდზე</label>
                        <input type="checkbox" class="toggle-switch form-control" id="pinned_click" name="pinned" @if($pageAdditional->pinned) checked="checked" @endif data-toggle="toggle" >
                        @error('pinned')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
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
                                    <label for="{{$language->locale.'-title'}}">რესურსის სათაური ({{$language->locale}})<span style="color:red;"> *</span></label>
                                    <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title') ?? ( $pageAdditional->translate($language->locale)->title ?? '' ) }}" placeholder="შეიყვანეთ რესურსის სათაური">
                                    @error($language->locale.'.title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="{{$language->locale.'-description'}}">რესურსის აღწერა ({{$language->locale}})</label>
                                    <input type="text" class="form-control" id="{{$language->locale.'-description'}}" name="{{$language->locale}}[description]" value="{{old($language->locale.'.description') ?? ( $pageAdditional->translate($language->locale)->description ?? '' ) }}" placeholder="შეიყვანეთ რესურსის აღწერა">
                                    @error($language->locale.'.description')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="{{$language->locale.'-source'}}">რესურსის წყარო ({{$language->locale}})</label>
                                    <input type="text" class="form-control" id="{{$language->locale.'-source'}}" name="{{$language->locale}}[source]" value="{{old($language->locale.'.source') ?? ( $pageAdditional->translate($language->locale)->source ?? '' ) }}" placeholder="შეიყვანეთ რესურსის წყარო">
                                    @error($language->locale.'.source')
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
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#topicselect').change(function() {
            let data = {};
            let method = '{{route("additional_resources.getpages")}}';
            data.topic_id = this.value;
            
            getData(data, method).done(data => {
                $('#pageselect').removeAttr('disabled').find('option').remove();
                if(data['pages'] && data['pages'].length > 0) {
                    $('#pageselect').removeAttr('disabled').find('option').remove();
                    $.each(data['pages'], (key, value) => {
                        $('#pageselect').append(`<option value='${value.id}'>${value.title}</option>`)
                    });
                }else {
                    $('#pageselect').attr('disabled', 'disabled');
                }

            });
        });

      $("#resourceTypeSelect").change(function () {
        var val = $(this).val();

        if (val === "link") {
          $(".resourceTypeSelectLink").addClass('active');
          $(".addResourceFile").addClass('active');
        }
        else {
          $(".resourceTypeSelectLink").removeClass('active');
          $(".addResourceFile").removeClass('active');
        }
        if (val === "link" || val == "video" ) {
          $(".addResourceLink").addClass('active');
        }
        else {
          $(".addResourceLink").removeClass('active');
        }
        if (val == "pdf" ) {
          $(".addResourceFile").addClass('active');
        }
        else {
          $(".addResourceFile").removeClass('active');
        }
        if (val == "image" || val == "pdf" || val == "link" ) {
          $(".addResourceImage").addClass('active');
        }
        else {
          $(".addResourceImage").removeClass('active');
        }
      });
    });

    $('#additionalEditForm').on('submit', function() {
        $('#resourceTypeSelect').prop('disabled', false);
    });

    // var loadFile = function (event) {
    //   var image = document.getElementById('output');
    //   image.src = URL.createObjectURL(event.target.files[0]);
    // };
    var loadFile = function (event, id, type = "img") {
        let loadedFile = document.getElementById(id);
        if(type === "img") {
            loadedFile.src = URL.createObjectURL(event.target.files[0]);
        }else {
            loadedFile.href = URL.createObjectURL(event.target.files[0]);
            loadedFile.innerHTML = event.target.files[0].name;
        }
    };
</script>
@endSection