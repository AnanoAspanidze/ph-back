@extends('web.backend.layout')

@section('title', 'ენები')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12">
                <h4 class="m-0">ენები</h4>
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
                <h3 class="card-header-title">ენების სია</h3>
                <div class="card-header-right">
                <a href="{{route('language.create')}}" class="card-header-btn btn btn-primary">დამატება</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="mainDataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ენა</th>
                        <th>იდენტიფიკატორი</th>
                        <th class="text-center">დამალვა</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $language)
                    <tr>
                        <td>{{$language->name}}</td>
                        <td>{{$language->locale}}</td>
                        <td class="text-center">
                            <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('language.activate', $language->id)}}')" @if($language->active) checked="checked" @endif data-toggle="toggle" >
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
        // "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      });
    });
</script>
@endSection