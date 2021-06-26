<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">განმარტებების სია</h3>
                <div class="card-header-right">
                    <a href="{{route('explanation_page.create', $resource->id)}}" target="_blank" class="btn btn-primary">განმარტების დამატება</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="mainDataTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>განმარტების სათაური</th>
                        <th>ლინკი</th>
                        <th class="text-center">რედაქტირება</th>
                        <th class="text-center">დამალვა</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($resource->explanations as $explanation)
                        <tr>
                            <td>{{$explanation->title}}</td>
                            <td>
                                <a href="{{route('topics.explanation', $explanation->id)}}">{{route('topics.explanation', $explanation->id)}}</a>
                            </td>
                            <td class="text-center"><a href="{{route('explanation_page.edit', $explanation->id)}}"><i class="fas fa-edit"></i></a></td>
                            <td class="text-center">
                                <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('explanation_page.activate', $explanation->id)}}')" @if($explanation->active) checked="checked" @endif data-toggle="toggle" >
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