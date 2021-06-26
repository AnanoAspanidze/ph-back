@extends('web.backend.layout')

@section('title', 'თემის დამატება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0">თემის დამატება</h4>                
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">

            <form role="form" method="post" action="{{route('topic.store')}}" enctype="multipart/form-data">
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
                            <label for="{{$language->locale.'-title'}}">თემის სახელი ({{$language->locale}})</label><span style="color:red;"> *</span>
                            <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title')}}" placeholder="შეიყვანეთ თემის სახელი">
                            @error($language->locale.'.title')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="{{$language->locale.'-tags'}}">თეგები ({{$language->locale}})</label><span style="color:red;"> *</span>
                            <input type="text" class="form-control" id="{{$language->locale.'-tags'}}" name="{{$language->locale}}[tags]" value="{{old($language->locale.'.tags')}}" placeholder="შეიყვანეთ მძიმეებით გამოყოფილი თეგები">
                            @error($language->locale.'.tags')
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
                        <label for="illustrationFile">ილუსტრაცია (კვადრატული)</label><span style="color:red;"> *</span>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" id="illustrationFile" name="illustration" onchange="loadFile(event)"
                            style="display: none;">
                            <label class="custom-file-label" for="illustrationFile" style="cursor: pointer;">ატვირთეთ ილუსტრაცია</label>
                        </div>
                        </div>
                        <img id="output" class="output-img" />
                        @error('illustration')
                            <span class="help-error-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

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
    let loadFile = function (event) {
      let image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endSection