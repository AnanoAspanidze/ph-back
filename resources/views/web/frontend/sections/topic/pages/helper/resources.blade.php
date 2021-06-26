<div class="document__line m-0 mt-5"></div>
<section class="section__theme__resources">
      <div class="row">
        <div class="col-12 page__content-col m-auto">
          <h3 class="section__theme__resources__title">{{__("site.additional_resource")}}</h3>
          <div class="row">
            
            @foreach ($resource->resources as $item)
              @include(config('additionaresource.'.$item->type.'.cardlayout'), ['resource' => $item, 'search' => ''])
            @endforeach
            
          </div>
        </div>
      </div>
  </section>