@foreach($items as $item)
  <li@lm-attrs($item) @if($item->hasChildren())class ="dropdown"@endif @lm-endattrs>
    @if($item->link) <a@lm-attrs($item->link) @if($item->hasChildren()) data-toggle="collapse" @endif @lm-endattrs href="{!! $item->url() !!}">
      <p>{!! $item->title !!}
      @if($item->hasChildren()) <b class="caret"></b> @endif
      </p>
    </a>
    @else
      {!! $item->title !!}
    @endif
    @if($item->hasChildren())
    <div class="collapse" id="{{ $item->nickname }}">
      <ul class="nav">
        @include(config('laravel-menu.views.bootstrap-items'), 
          array('items' => $item->children()))
      </ul> 
    </div>
    @endif
  </li>
  @if($item->divider)
  	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
  @endif
@endforeach
