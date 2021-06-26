@extends('web.backend.layout')

@section('title', 'განმანათლებლები')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-12">
            <h4 class="m-0">განმანათლებლები</h4>
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
                    <h3 class="card-header-title">განმანათლებლები</h3>
                </div>
            <!-- /.card-header -->
                <div class="card-body">
                    <table id="mainDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>სახელი</th>
                                <th>გვარი</th>
                                <th>ელ . ფოსტა</th>
                                <th>პოზიცია</th>
                                <th>რეგიონი</th>
                                <th>ვერიფიკაციის თარიღი</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->surname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->position ? $user->position->name : $user->position_name }}</td>
                                <td>{{$user->region->name}}</td>
                                <td>{{$user->email_verified_at}}</td>
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