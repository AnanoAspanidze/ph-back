@extends('web.backend.layout')

@section('title', 'ენის დამატება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12 col-md-10">
            <h4 class="m-0">ენის დამატება</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <div class="card card-primary">
                <form method="post" action="{{route('language.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="locale">ენის არჩევა</label><span style="color:red;"> *</span>
                            <select  class="form-control" id="locale" required name="locale">
                                @foreach($languagesConf as $key => $value)
                                    <option value="{{$key}}" @if(old('locale') == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('locale')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="active">აქტიური</label>
                            <div class="checkbox">
                                <input type="checkbox" class="toggle-switch form-control" id="active" name="active" value="true" {{ old('active') ? 'checked="checked"' : '' }} data-toggle="toggle" >
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">დამატება</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection