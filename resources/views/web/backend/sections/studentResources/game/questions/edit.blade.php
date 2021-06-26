@extends('web.backend.layout')

@section('title', 'კითხვის განახლება')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-md-10">
                <h4 class="m-0"> სავარჯიშო - {{$question->game->title}}  |   კითხვის განახლება</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 m-auto">

            <form role="form" method="post" action="{{route('question.update', $question->id)}}">
            @csrf
                <div class="card card-primary">
                    <div class="card-body">
                        
                        <div class="form-group">
                            @php( $answerTypes = ['many' => 'ბევრი პასუხი', 'one' => 'ერთი პასუხი'] )
                            <label>რა ტიპისაა კთხვაა?</label><span style="color:red;"> *</span>
                            <select class="form-control" name="type" required id="question-type">
                                @foreach($answerTypes as $key => $value)
                                    <option value="{{$key}}" @if($question->type == $key) selected="selected" @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="help-error-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group answers-select-container">
                            @php( $answerTypes = ['many' => 'ბევრი პასუხი', 'one' => 'ერთი პასუხი'] )
                            <label>სწორი პასუხები?</label><span style="color:red;"> *</span>
                            <select 
                                class="form-control answers-select"
                                name="isRight[]"
                                required
                                id="game-type"
                                @if($question->type !== 'one')
                                   multiple="multiple"
                                @endif>
                                    @for($i = 1; $i <= 4; $i++) {
                                        <option value="{{$i}}" @if (in_array($i, $isRight)) selected="selected" @endif>პასყხი {{$i}}</option>
                                    @endfor
                            </select>
                            @error('isRight')
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
                                        <input type="text" class="form-control" id="{{$language->locale.'-title'}}" name="{{$language->locale}}[title]" value="{{old($language->locale.'.title') ?? ( $question->translate($language->locale)->title ?? '' ) }}" placeholder="შეიყვანეთ სათაური">
                                        @error($language->locale.'.title')
                                            <span class="help-error-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="{{$language->locale.'-purpose'}}">კომენტარი ({{$language->locale}})</label>
                                        <input type="text" class="form-control" id="{{$language->locale.'-purpose'}}" name="{{$language->locale}}[purpose]" value="{{old($language->locale.'.title') ?? ( $question->translate($language->locale)->purpose ?? '' ) }}" placeholder="შეიყვანეთ კომენტარი">
                                        @error($language->locale.'.purpose')
                                            <span class="help-error-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="answers"> 
                                        <div class="form-group">
                                            <label for="{{$language->locale.'-answer1'}}">პასუხი 1 ({{$language->locale}})</label><span style="color:red;"> *</span>
                                            <input type="text"
                                                class="form-control"
                                                id="{{$language->locale.'-answer1'}}"
                                                name="answers[1][{{$language->locale}}][answer]"
                                                value="{{ old('answers.1.'.$language->locale.'.answer') ?? ( $question->answers[0]->translate($language->locale)->answer ?? '' )}}"
                                                placeholder="შეიყვანეთ პასუხი 1">
                                            @error('answers.1.'.$language->locale.'.answer')
                                                <span class="help-error-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="{{$language->locale.'-answer2'}}">პასუხი 2 ({{$language->locale}})</label><span style="color:red;"> *</span>
                                            <input type="text"
                                                class="form-control"
                                                id="{{$language->locale.'-answer2'}}"
                                                name="answers[2][{{$language->locale}}][answer]"
                                                value="{{ old('answers.2.'.$language->locale.'.answer') ?? ( $question->answers[1]->translate($language->locale)->answer ?? '' )}}"
                                                placeholder="შეიყვანეთ პასუხი 2">
                                            @error('answers.2.'.$language->locale.'.answer')
                                                <span class="help-error-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="{{$language->locale.'-answer3'}}">პასუხი 3 ({{$language->locale}})</label>
                                            <input type="text"
                                                class="form-control"
                                                id="{{$language->locale.'-answer3'}}"
                                                name="answers[3][{{$language->locale}}][answer]"
                                                value="{{ old('answers.3.'.$language->locale.'.answer') ?? ( $question->answers[2]->translate($language->locale)->answer ?? '' )}}"
                                                placeholder="შეიყვანეთ პასუხი 3">
                                        </div>
                                        <div class="form-group">
                                            <label for="{{$language->locale.'-answer4'}}">პასუხი 4 ({{$language->locale}})</label>
                                            <input type="text"
                                                class="form-control"
                                                id="{{$language->locale.'-answer4'}}"
                                                name="answers[4][{{$language->locale}}][answer]"
                                                value="{{ old('answers.4.'.$language->locale.'.answer') ?? ( $question->answers[3]->translate($language->locale)->answer ?? '' )}}"
                                                placeholder="შეიყვანეთ პასუხი 4">
                                        </div>
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

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('.answers-select').select2();
        $("#question-type").change(function () {
            var val = $(this).val();
            if (val == "many") {
                $(".answers-select").attr("multiple","multiple");
            }else {
                $(".answers-select").removeAttr("multiple");
            }
            $('.answers-select').select2();
        });

    });
</script>
@endSection