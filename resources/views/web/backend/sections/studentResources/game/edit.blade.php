@extends('web.backend.layout')

@section('title', 'სავარჯიშოს გვერდის განახლება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0">სავარჯიშოს გვერდის განახლება</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">

            <form role="form" method="post" action="{{route('game_page.update', $game->id)}}">
            @csrf

                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            @php( $gameTypes = ['test' => 'ტესტი', 'code' => 'კოდი'] )
                            <label>რა ტიპისაა სავარჯიშო?</label><span style="color:red;"> *</span>
                            <select class="form-control" name="type" id="game-type">
                                <option value="">აირჩიეთ</option>
                                @foreach($gameTypes as $key => $value)
                                    <option value="{{$key}}" @if ($game->type == $key) selected="selected" @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="custom-game-wrapper"  style="display: {{ $game->type === 'code'  ? 'block' : 'none'  }}">
                            <div class="form-group">
                                <label for="code">სავარჯიშოს კოდი</label>
                                <textarea id="code" name="code" rows="8" cols="80">{!!old('code') ?? ($game->code ?? '')!!}</textarea>
                                @error('code')
                                    <span class="help-error-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="test-wrapper" style="display: {{ $game->type === 'test'  ? 'block' : 'none'  }}">
                            <p>ტესტების დამატებას შეძლებთ გვერდის რედაქტირებისას</p>
                        </div>

                        <div class="form-check form-group">
                            <input type="checkbox" name="resources[show_steps]" @if($game->resource->show_steps) checked="checked" @endif class="form-check-input">
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
                                        <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title') ?? ( $game->translate($language->locale)->title ?? '' ) }}" placeholder="შეიყვანეთ სათაური">
                                        @error($language->locale.'.title')
                                            <span class="help-error-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$language->locale.'-sub_title'}}">ქვესათაური ({{$language->locale}})</label>
                                        <input type="text" class="form-control" id="{{$language->locale.'-sub_title'}}" name="{{$language->locale}}[sub_title]" value="{{old($language->locale.'.sub_title') ?? ( $game->translate($language->locale)->sub_title ?? '' ) }}" placeholder="შეიყვანეთ ქვესათაური">
                                        @error($language->locale.'.sub_title')
                                            <span class="help-error-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$language->locale.'-instruction'}}">სავარჯიშოს ინსტრუქცია ({{$language->locale}})</label><span style="color:red;"> *</span>
                                        <textarea class="tinymce-editor" id="{{$language->locale.'-instruction'}}" name="{{$language->locale}}[instruction]" rows="8" cols="80">{!!old($language->locale.'.instruction') ?? ($game->translate($language->locale)->instruction ?? '')!!}</textarea>
                                        @error($language->locale.'.instruction')
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

</br>
@include('web.backend.sections.studentResources.game.questions.helper', ['questions' => $game->questions])


</br>
@include('web.backend.sections.studentResources.explanation.helper', ['resource' => $game->resource])

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
            // $("#custom-game-wrapper").hide();
            // $("#test-wrapper").hide();

            $("#game-type").change(function () {
                var val = $(this).val();
                if (val == "test") {
                    $("#custom-game-wrapper").hide();
                    $("#test-wrapper").show();
                }
                else if (val == "code") {
                    $("#test-wrapper").hide();
                    $("#custom-game-wrapper").show();
                }
                else {
                    $("#test-wrapper").hide();
                    $("#custom-game-wrapper").hide();
                }
            });
    });

    var loadFile = function (event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    $(function () {
        $("#mainDataTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        });
        $("#mainDataTable2").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        });
    });
</script>
@endSection