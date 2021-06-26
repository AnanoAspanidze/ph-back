<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">ილუსტრაციების სია</h3>
                <div class="card-header-right">
                    <a href="{{route('illustration.create', $about->id)}}" target="_blank" class="btn btn-primary">ილუსტრაციის დამატება</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="mainDataTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>სათაური</th>
                        <th>ფაილის სახელი</th>
                        <th class="text-center">რედაქტირება</th>
                        <th class="text-center">დამალვა</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($about->aboutImgs as $img)
                        <tr>
                            <td>{{$img->title}}</td>
                            <td>{{$img->file_name}}</td>
                            <td class="text-center"><a href="{{route('illustration.edit', $img->id)}}"><i class="fas fa-edit"></i></a></td>
                            <td class="text-center">
                                <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('illustration.activate', $img->id)}}')" @if($img->active) checked="checked" @endif data-toggle="toggle" >
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