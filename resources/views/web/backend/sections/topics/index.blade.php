@extends('web.backend.layout')

@section('title', 'თემები')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">თემები</h4>
        </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-header-title">თემების სია</h3>
                    <div class="card-header-right">
                    <a href="{{route('topic.create')}}" class="card-header-btn btn btn-primary">დამატება</a>
                    </div>
                </div>
            <!-- /.card-header -->
                <div class="card-body">
                    <table id="mainDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>თემის სახელი</th>
                                <th>ილუსტრაცია</th>
                                <th>თეგები</th>
                                <th class="text-center">რედაქტირება</th>
                                <th class="text-center">დამალვა</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topics as $topic)
                            <tr>
                                <td>{{$topic->title}}</td>
                                <td>
                                    <img src="{{asset($topic->getUrlPath().'/min_'.$topic->illustration)}}" alt="theme" class="table-img">
                                </td>
                                <td>{{$topic->tags}}</td>
                                <td class="text-center"><a href="{{route('topic.edit', $topic->id)}}"><i class="fas fa-edit"></i></a></td>
                                <td class="text-center">
                                    <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('topic.activate', $topic->id)}}')" @if($topic->active) checked="checked" @endif data-toggle="toggle" >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
      $("#mainDataTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      });
    });
</script>
@endSection