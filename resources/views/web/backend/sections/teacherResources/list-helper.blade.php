<ol class="dd-list">
    @foreach ($course->parts as $part)        
        <li class="dd-item" id="li-{{$part->id}}" data-id="{{$part->id}}"  data-movable="true">
        
            <div class="dd-handle dd3-handle">
                <i class="fas fa-bars"></i>
            </div>

            <div class="dd3-content">
                <div class="dd-content-inner"> 
                    <div>
                        {{ 'ნაწილი |  სათაური - '.\Str::limit($part->title, 60) }}
                    </div>
                    <div class="pull-right">
                        <a class="edit-list" href="{{route('part.edit', $part->id)}}"><i class="fas fa-edit"></i></a>
                        <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('part.activate', $part->id)}}')" @if($part->active) checked="checked" @endif data-toggle="toggle" >
                    </div>
                </div>
            </div>

        </li>
    @endforeach
</ol>