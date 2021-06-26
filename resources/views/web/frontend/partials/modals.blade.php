<!-- Fullscreen image popup -->
<div class="modal fade" id="fullscreenImgModal" tabindex="-1">
  <div class="modal-dialog modal-fullscreen" id="modal-image-fullscreen">
    <div class="modal-content" id="image-fullscreen">
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>

<!-- Choose Role - Notification popup -->

<div class="modal fade notificationModal chooseRoleModal" id="chooseRoleModal" tabindex="-1"
  aria-labelledby="chooseRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl notificationModal-xl modal-dialog-centered">
    <div class="modal-content radius-16">
      <button type="button" class="game__modal-close center" data-bs-dismiss="modal" aria-label="Close">
        <svg class="icon">
          <use xlink:href="#cancel-icon"></use>
        </svg>
      </button>
      <div class="modal-body notificationModal-body padding-sm">
        <h1 class="section__themes__title">{{__('site.choose')}}</h1>
        <div class="chooseRoleModal__radiobuttons">
          <label class="radiobutton__container choose__student">
            <input type="radio" checked="checked" name="radio">
            <span class="checkmark"></span>
            {{__('site.student')}}
          </label>
          <label class="radiobutton__container choose__teacher">
            <input type="radio" name="radio">
            <span class="checkmark"></span>
            {{__('site.teacher')}}
          </label>
        </div>
        <div class="chooseRoleModal__bottom">
          <div class="document__line"></div>
          <div class="form__section__text-sm chooseRoleModal__bottom__text">
            <span>{{__('site.for_teach_required')}} </span>
            <a href="login.html" class="form__section__text-sm-link">
              {{__('site.autorization')}}
              <svg class="icon">
                <use xlink:href="#feather-arrow-up-right"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Table Of Contents Modal -->
@if(isset($topic) && Request::route() && (Request::route()->getName() === 'topics.inner' || Request::route()->getName() === 'topics.explanation'))
<div class="modal fade notificationModal tableOfConents__modal" id="tableOfConents" tabindex="-1" aria-labelledby="tableOfConentsLabel"
  aria-hidden="true">
  <div class="modal-dialog tableOfConents__modal-dialog">
    <div class="modal-content tableOfConents__modal-content">
      <div class="bg-white">
        <div class="tableOfConents__modal-header">
          <h2 class="tableOfConents__modal__title">{{__('site.content_map')}}</h2>
          <a href="#" class="game__modal-close" id="test" data-bs-dismiss="modal" aria-label="Close">
            <svg class="icon">
              <use xlink:href="#cancel-icon"></use>
            </svg>
          </a>
        </div>
        <div class="document__line m-0"></div>
        <form class="form">
          <div class="dropdown__elem form-control form-select" id="selectTheme">
            <div class="dropdown__elem--inner dropdown--toggler">
              <span class="text--active dropdown--selected">
                {{$topic->title ?? ''}}
              </span>
              <svg class="icon">
                <use xlink:href="#arrow-dropdown"></use>
              </svg>
            </div>
            <div class="dropdown" data-for="selectTheme">
              <nav class="dropdown__nav">
              @if(isset($topics))
                @foreach ($topics as $item)
                  <li class="dropdown__item {{$item->id == $topic->id ? 'dropdown__item--active' : ''}}" value="{{$item->id}}">{{$item->title}}</li>
                @endforeach
              @endif
              </nav>
            </div>
          </div>
          <div class="dropdown__elem form-control form-select" id="pageType">
            <div class="dropdown__elem--inner dropdown--toggler">
              <span class="text--active dropdown--selected">
                აირჩიეთ გვერდის ტიპი
              </span>
              <svg class="icon">
                <use xlink:href="#arrow-dropdown"></use>
              </svg>
            </div>
            <div class="dropdown" data-for="pageType">
              <nav class="dropdown__nav">
                <li class="dropdown__item" value="">{{__('site.all')}}</li>
                @foreach (config('studentpages.pages') as $key => $value )
                  <li class="dropdown__item" value="{{$key}}">{{$value}}</li>
                @endforeach
              </nav>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-body tableOfConents__modal-body">
          @foreach ($topic->resources as $index => $resourceItem )
            @php 
              $resourceableItem = config('resourceable.'.class_basename($resourceItem->resourceable_type));
              $icon = false;
              $pageIndex = $loop->iteration;
              $title = "";
              $basename = class_basename($resourceItem->resourceable_type);
              if(isset($resourceableItem['icon'])) {
                if($basename === 'Other') {
                  $icon = $resourceItem->parent ? $resourceableItem['icon']['discussion'] : $resourceableItem['icon']['complex'];
                  $title = $resourceItem->parent ? __('site.page_type_discussion') : __('site.page_type_complex');
                  $basename = $resourceItem->parent ? 'Discussion' : 'Complex';
                } else {
                  $icon = $resourceableItem['icon'];
                  $title = $resourceableItem['type'];
                }
              }else {
                $title = $resourceableItem['type'];
              }

            @endphp
            @include('web.frontend.partials.modal-helper', [
              'isSubPage' => false,
              'icon' => $icon,
              'index' => $pageIndex,
              'title' => $title,
              'basename' => $basename,
              'active' => (isset($resource) && $resourceItem->id === $resource->id) ? true : false,
              'resourceItem' => $resourceItem,
              'resourceableItem' => $resourceableItem
            ])

            @if ($resourceItem->explanations && count($resourceItem->explanations) > 0)
              @foreach($resourceItem->explanations as $expIndex => $explanationObj)
              
                @php( $explanationItem = config('resourceable.Explanation'))
                @include('web.frontend.partials.modal-helper', [
                  'isSubPage' => true,
                  'icon' => $explanationItem['icon'],
                  'index' => ($pageIndex).'-'.($expIndex + 1),
                  'title' => $explanationItem['type'],
                  'basename' => 'Explanation',
                  'active' => ( isset($explanation) && $explanation->id === $explanationObj->id ) ? true : false,
                  'resourceItem' => $explanationObj,
                  'resourceableItem' => $explanationItem
                ])
    
              @endforeach
            @endif
          @endforeach
      </div>
    </div>
  </div>
</div>
@endif

@section('scripts')
<script type="text/javascript">

$("#pageType .dropdown__item").on("click", function(){

  var selected_type = $(this).attr("value");

  $('.toc-item').show();

  if(selected_type != 0) {
    $('.toc-item[data-page-type!="'+ selected_type +'"]').hide();
  }

})

$("#selectTheme .dropdown__item").on("click", function() {
  
  var selected_theme = $(this).attr("value");

  $(".tableOfConents__modal-body").empty();
  
    $.ajax({
      dataType: "json",
      url: "{{route('topic.pages')}}",
      type: "Get",
      data: {
          'topic_id': selected_theme
      },
      success: function (data) {

        $(".tableOfConents__modal-body").empty();
        if(data.pages) {
          $.each(data.pages, function(key, value) {
    
            let img_visibility = value.icon == "" ? "none" : "inline-block";
            let element =
            '<a href="'+ value.route +'" class="toc-item" data-page-type="'+ value.baseName +'">' +
                '<div class="tableOfConents__item">' +
                  '<div class="d-flex align-items-center"> ' +
                    '<img style="display: ' + img_visibility + '" src="'+ value.icon +'" alt="'+ value.type +'" class="tableOfConents__item__img">' +
                    '<div>' +
                      '<h3 class="tableOfConents__item__title">'+ value.type +'</h3>' +
                      '<p class="tableOfConents__item__text">'+ value.title +'</p>' +
                    '</div>' +
                  '</div>' +
                  '<div class="tableOfConents__item__number">'+ value.index +'</div>' +
                '</div>' +
            '</a>'
            
            $(".tableOfConents__modal-body").append(element);
    
          });
        }
      },
      error: function () {
          console.log("error");
      }
  })

  // $.each(data_array_example, function(key,value) {

  //   var img_visibility = value.page_type_icon == "" ? "none" : "inline-block";

  //   var element =
  //   '<a href="'+ value.href +'" class="toc-item" data-page-type="'+ value.page_type_id +'">' +
  //       '<div class="tableOfConents__item">' +
  //         '<div class="d-flex align-items-center"> ' +
  //           '<img style="display: ' + img_visibility + '" src="'+ value.page_type_icon +'" alt="'+ value.page_type_name +'" class="tableOfConents__item__img">' +
  //           '<div>' +
  //             '<h3 class="tableOfConents__item__title">'+ value.page_type_name +'</h3>' +
  //             '<p class="tableOfConents__item__text">'+ value.page_title +'</p>' +
  //           '</div>' +
  //         '</div>' +
  //         '<div class="tableOfConents__item__number">'+ value.page_number +'</div>' +
  //       '</div>' +
  //   '</a>'

  //   $(".tableOfConents__modal-body").append(element);

  // });

})
</script>
@endsection