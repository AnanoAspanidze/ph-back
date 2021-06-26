@extends('web.backend.layout')

@section('title', $topic->title.' - რესურსი')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">{{$topic->title}} - რესურსი</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="resource__theme__item">
        <img src="{{asset('storage/topic/min_'.$topic->illustration)}}" alt="topic-{{$topic->illustration}}" class="resource__theme__item__img">
        <h2 class="resource__theme__item__title">{{$topic->title}}</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-header-title">გვერდები  <b>|</b>  გვერდის დამატება</h3>
            <div class="card-header-right">
                <a href="{{route('first_page.create', $topic->id)}}" class="card-header-btn btn btn-primary">პირველი გვერდი</a>
                <a href="{{route('step_page.create', $topic->id)}}" class="card-header-btn btn btn-primary">ნაბიჯი</a>
                <a href="{{route('other_page.create', $topic->id)}}" class="card-header-btn btn btn-primary">გვერდი</a>
                <a href="{{route('game_page.create', $topic->id)}}" class="card-header-btn btn btn-primary">სავარჯიშო</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="white-block margin-tp-10"> 
               
                <div class="text-right margin-bt-20">ქმედება</div>
               
                <div class="department-sortable dd">
                    @include('web.backend.sections.studentResources.list-helper', ['resources' => $topic->resources])
                </div>
               
                @if(count($topic->resources))
                    <!-- <button type="button"  class="btn btn-teal-round cl-white margin-tp-50 margin-bt-10 btn-save" id="load" >
                        დასორტირებული მონაცემების შენახვა
                    </button> -->
                    <button type="button" class="btn btn-primary pull-left btn-save" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading ... ">დასორტირებული მონაცემების შენახვა</button>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.dd').nestable({
            maxDepth: 2,
        });

        $('.btn-save').click(function(){
            var $this = $(this);
            $this.prop("disabled", true);
            // add spinner to button
            $this.html(
            '<i class="fa fa-circle-o-notch fa-spin"></i> loading...'
            );

            $.post("{{ route('student_resources.sort')}}", {orderArr: $('.dd').nestable('serialize'), '_token': "{{ csrf_token() }}"}, function(data){
            $this.prop("disabled", false);
            $this.html('დასორტირებული მონაცემების შენახვა');

            });
        });

        $("#mainDataTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        });
    });
</script>
@endSection