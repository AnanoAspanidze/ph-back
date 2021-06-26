@extends('web.backend.layout')

@section('title', 'დამატებითი რესურსები')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">დამატებითი რესურსები</h4>
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
                <h3 class="card-header-title">დამატებითი რესურსები</h3>
                <div class="card-header-right">
                <a href="{{route('additional_resources.create')}}" class="card-header-btn btn btn-primary">დამატება</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow: auto;">
                <table id="mainDataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>მიმართულება</th>
                        <th>რესურსის ტიპი</th>
                        <th>სად ჩანს</th>
                        <th>თემა</th>
                        <th>სათაური</th>
                        <th>ვიზუალი</th>
                        <th>აღწერა</th>
                        <th>წყარო</th>
                        <th class="text-center">რედაქტირება</th>
                        <th class="text-center">დამალვა</th>
                        <th class="text-center">წაშლა</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($additionalResources as $additionalResource)
                    <tr id="tr-{{$additionalResource->id}}">
                        <td>{{__('site.'.$additionalResource->direction)}}</td>
                        <td>{{config('additionaresource.'.$additionalResource->type.'.name')}}</td>
                        <td>{{$additionalResource->pinned ? 'რესურსების გვერდზე' : 'თემაში'}}</td>
                        <td>{{$additionalResource->topic->title}}</td>
                        <td>{{$additionalResource->title}}</td>
                        <td>
                            {!! config('additionaresource.'.$additionalResource->type.'.listfunc')($additionalResource) !!}
                        </td>
                        <td>{{$additionalResource->description ?? ''}}</td>
                        <td>{{$additionalResource->source ?? ''}}</td>
                        <td class="text-center"><a href="{{route('additional_resources.edit', $additionalResource->id)}}"><i class="fas fa-edit"></i></a></td>
                        <td class="text-center">
                            <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('additional_resources.activate', $additionalResource->id)}}')" @if($additionalResource->active) checked="checked" @endif data-toggle="toggle" >
                        </td>
                        <td>
                            <button href="javascript:;"
                                onclick="deleteData('tr-{{$additionalResource->id}}',`{{route('additional_resources.destroy', $additionalResource->id)}}`)"
                                class="btn btn-danger btn-icon delete-section">
                                    <div><i class="fas fa-trash"></i></div>
                            </button>
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
        "autoWidth": true,
      });
    });
</script>
@endSection