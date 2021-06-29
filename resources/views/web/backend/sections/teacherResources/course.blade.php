@extends('web.backend.layout')

@section('title', $course->topic->title.' - კურსი')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">{{$course->topic->title}} - კურსი</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="resource__theme__item">
        <img src="{{asset('storage/topic/min_'.$course->topic->illustration)}}" alt="topic-{{$course->topic->illustration}}" class="resource__theme__item__img">
        <h2 class="resource__theme__item__title">{{$course->topic->title}}</h2>
    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-header-title">ნაწილები  <b>|</b>  ნაწილის დამატება / ედიტი</h3>
            <div class="card-header-right">
                <a href="{{route('teacher_resources.edit', $course->id)}}" class="card-header-btn btn btn-primary">კურსის ედიტი</a>
                <a href="{{route('part.create', $course->id)}}" class="card-header-btn btn btn-primary">ნაწილის დამატება</a>
            </div>
        </div>

        <!-- /.card-header -->
        @if (count($course->parts) > 0)
            <div class="card-body">
                <div class="white-block margin-tp-10"> 
                
                    <div class="text-right margin-bt-20">ქმედება</div>
                
                    <div class="department-sortable dd">
                        @include('web.backend.sections.teacherResources.list-helper', ['course' => $course])
                    </div>
                
                    <button type="button" class="btn btn-primary pull-left btn-save" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading ... ">დასორტირებული მონაცემების შენახვა</button>
                </div>
            </div>
        @endif
        <!-- /.card-body -->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.dd').nestable({
            maxDepth: 1,
        });
        $('.btn-save').click(function(){
            var $this = $(this);
            $this.prop("disabled", true);

            // add spinner to button
            $this.html(
            '<i class="fa fa-circle-o-notch fa-spin"></i> loading...'
            );

            $.post("{{ route('teacher_resources.sort')}}", {orderArr: $('.dd').nestable('serialize'), '_token': "{{ csrf_token() }}", 'id': "{{$course->id}}"}, function(data){
            $this.prop("disabled", false);
            $this.html('დასორტირებული მონაცემების შენახვა');

            });
        });
    });
</script>
@endSection