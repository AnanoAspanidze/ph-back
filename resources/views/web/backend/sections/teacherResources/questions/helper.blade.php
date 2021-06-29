<div class="row">
    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-header-title">კითხვების სია</h3>
                <div class="card-header-right">
                    <a href="{{$create}}" target="_blank" class="btn btn-primary">კითხვების დამატება</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="questionDataTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>კითხვის სათაური</th>
                        <th>კითხვის ტიპი</th>
                        <th>პასუხების რაოდენობა</th>
                        <th class="text-center">რედაქტირება</th>
                        <th class="text-center">დამალვა</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            <td>{{$question->title}}</td>
                            <td>{{$question->type}}</td>
                            <td>{{$question->answers_count}}</td>
                            <td class="text-center"><a href="{{route('teacher_resources.question.edit', $question->id)}}"><i class="fas fa-edit"></i></a></td>
                            <td class="text-center">
                                <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('teacher_resources.question.activate', $question->id)}}')" @if($question->active) checked="checked" @endif data-toggle="toggle" >
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

@push('script')
<script type="text/javascript">
    $(function () {
      $('#questionDataTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      });
    });
</script>
@endpush