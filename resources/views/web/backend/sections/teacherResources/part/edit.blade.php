@extends('web.backend.layout')

@section('title', 'ნაწილის განახლება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0">ნაწილის განახლება</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <form role="form" method="post" action="{{route('part.update', $part->id)}}">
            @csrf

                <div class="card card-primary">

                    <div class="card-body">

                        <div class="form-group">
                            <label for="videoURL">ვიდეოს ლინკი youtube-დან</label><span style="color:red;"> *</span>
                            <input type="text" class="form-control" id="videoURL" name="video" value="{{old('video') ?? ( $part->video ?? '' ) }}" placeholder="შეიყვანეთ ვიდეოს ლინკი">
                            @error('video')
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
                                    <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title') ?? ($part->translate($language->locale)->title ?? '')}}" placeholder="შეიყვანეთ სათაური">
                                    @error($language->locale.'.title')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-short_desc'}}">მოკლე აღწერა ({{$language->locale}})</label><span style="color:red;"> *</span>
                                    <textarea class="form-control" id="{{$language->locale.'-short_desc'}}" name="{{$language->locale}}[short_desc]" rows="8" cols="80">{!!old($language->locale.'.short_desc') ?? ($part->translate($language->locale)->short_desc ?? '')!!}</textarea>
                                    @error($language->locale.'.short_desc')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="{{$language->locale.'-description'}}">ტექსტი ({{$language->locale}})</label><span style="color:red;"> *</span>
                                    <textarea class="tinymce-editor" id="{{$language->locale.'-description'}}" name="{{$language->locale}}[description]" rows="8" cols="80">{!!old($language->locale.'.description') ?? ($part->translate($language->locale)->description ?? '')!!}</textarea>
                                    @error($language->locale.'.description')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">განახლება</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection