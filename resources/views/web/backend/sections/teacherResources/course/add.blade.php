@extends('web.backend.layout')

@section('title', 'კურსის დამატება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0">კურსის დამატება</h4>                
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">

            <form role="form" method="post" action="{{route('teacher_resources.store')}}">
            @csrf
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
                                    <label for="{{$language->locale.'-short_desc'}}">მოკლე აღწერა ({{$language->locale}})</label><span style="color:red;"> *</span>
                                    <textarea id="{{$language->locale.'-short_desc'}}" class="form-control" name="{{$language->locale}}[short_desc]" placeholder="შეიყვანეთ კურსის მოკლე აღწერა" rows="8">{!!old($language->locale.'.short_desc')!!}</textarea>
                                    @error($language->locale.'.short_desc')
                                        <span class="help-error-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach              
                </div>

                <div class="card card-primary">

                    <div class="card-body">

                        <div class="form-group">
                            <label>თემა</label><span style="color:red;"> *</span>
                            <select class="form-control" id="topicselect" name="topic_id">
                                <option value="">აირჩიე</option>
                                @foreach($topics as $topic)
                                    <option @if (old('topic_id') == $topic->id) selected="selected" @endif value="{{$topic->id}}">{{$topic->title}}</option>
                                @endforeach
                            </select>
                            @error('topic_id')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="videoURL">ვიდეოს ლინკი youtube-დან</label><span style="color:red;"> *</span>
                            <input type="text" class="form-control" id="videoURL" name="video" value="{{old('video')}}" placeholder="შეიყვანეთ ვიდეოს ლინკი">
                            @error('video')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="linkURL">Google form - ის ლინკი</label>
                            <input type="text" class="form-control" id="linkURL"  value="{{old('link')}}" placeholder="შეიყვანეთ google form ლინკი">
                            @error('link')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">დამატება</button>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection