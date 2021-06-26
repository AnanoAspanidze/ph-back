@extends('web.backend.layout')

@section('title', 'ჩვენზე')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">ჩვენზე</h4>
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
                <h3 class="card-header-title">ჩვენზე</h3>
                <div class="card-header-right">
                <a href="{{route('about.create')}}" class="card-header-btn btn btn-primary">დამატება</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow: auto;">
                <table id="mainDataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>სათაური</th>
                    <th>აპინული</th>
                    <th class="text-center">რედაქტირება</th>
                    <th class="text-center">დამალვა</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($abouts as $about)
                    <tr>
                        <td>{{$about->title}}</td>
                        <td>{{$about->pinned ? 'აპინული მთავარზე' : ''}}</td>
                        <td class="text-center"><a href="{{route('about.edit', $about->id)}}"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center">
                            <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('about.activate', $about->id)}}')" @if($about->active) checked="checked" @endif data-toggle="toggle" >
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