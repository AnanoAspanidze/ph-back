<ol class="dd-list">
  @foreach($resources as $resource)
    <li class="dd-item" id="li-{{$resource->id}}" data-id="{{ $resource->id }}"  data-movable="true">
      <div class="dd-handle dd3-handle">
          <i class="fas fa-bars"></i>
      </div>
      @php 
          $resourceable = config('resourceable.'.class_basename($resource->resourceable_type));
          $title =  class_basename($resource->resourceable_type) === 'Intro' ? $topic->title : $resource->resourceable[$resourceable['title']];
          $type = class_basename($resource->resourceable_type) === 'Other' ? ($resource->parent ? 'მსჯელობა' : 'კომპლექსური დავალება' ) : $resourceable['type'];
      @endphp
      <div class="dd3-content">
          <div class="dd-content-inner"> 
            <div>
                {{ 'ტიპი - ' . $type . ' |  სათაური - '.\Str::limit($title, 60)}}
            </div>
            <div class="pull-right">
                <a class="edit-list" href="{{route($resourceable['route-edit'], $resource->resourceable_id)}}"><i class="fas fa-edit"></i></a>
                <input type="checkbox" class="toggle-switch" onchange="toggleData(this,'{{route('student_resources.activate', $resource->id)}}')" @if($resource->active) checked="checked" @endif data-toggle="toggle" >
            </div>
          </div>
      </div>
      @if(count($resource->children) > 0 )
        @include('web.backend.sections.studentResources.list-helper', ['resources' => $resource->children])
      @endif
    </li>
  @endforeach
</ol>