<div class="card card-primary">
    <div class="card-body">
        
        <div class="form-group">
            <label>მშობელი ნაბიჯი</label>
            <select class="form-control" name="resources[parent]" id="pageParent">
                <option value="">არ აქვს</option>
                @foreach($resources as $resource)
                    <option value="{{$resource->id}}">{{Str::limit($resource->resourceable->title, 50)}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>რომელი გვერდის შემდეგ იყოს?</label>
            <select class="form-control" name="resources[sort]" disabled id="prevPageSelect">
                <option value="0">აირჩიეთ გვერდი</option>
                <!-- <option value="2">სავარჯიშო - სათაური</option> -->
            </select>
        </div>

    </div>
</div>

@push('script')
<script type="text/javascript">
     $(function() {
        $("#pageParent").change(function() {
            const selectedStep = $(this).val();
            const childrensSelect = $('#prevPageSelect');
            childrensSelect.prop('disabled', false);
            let data = @json($resources);
            childrensSelect.find('option').remove()
            for (let item of data) {
                if (item && item.children.length > 0 && item.id == selectedStep ) {
                    for (let children of item.children) {
                        childrensSelect.append($('<option>', { 
                                value: children.id,
                                text : children.resourceable.title ?? children.resourceable.sub_title 
                            }));
                    }
                }
            }    
        });
    });
</script>
@endpush