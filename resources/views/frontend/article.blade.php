@extends('frontend.layouts.master')

@section('title')
	{{ $post->title }}
@endsection

@section('content')

<main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background:  linear-gradient(rgba(241, 241, 241, 0.9), rgba(241, 241, 241, 0.9)), url(&quot;{{ url('uploads/'.$post->feature_image)  }}&quot;) ; visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp; background-size: cover; background-repeat: no-repeat; ">
	          <div class="container">
	            <div class="row">
	              <div class="col-xs-12 text-center">
	                <h1>{{ $post->title }}</h1>
	                <!-- <nav class="breadcrumbs">
	                  <ul class="list-unstyled">
	                    <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
	                    <li><a href="#">Blog <i class="fa fa-angle-right"></i></a></li>
	                    <li>Category</li>
	                  </ul>
	                </nav> -->
	              </div>
	            </div>
	        <!-- <div class="row">
              <div class="col-xs-12">
                <a href="#" class="search">Search <i class="fa fa-search"></i></a>
              </div>
            </div> -->
          </div>
        </section>
        <!-- Mt Contact Banner of the Page end -->

        <!-- Mt Blog Detail of the Page -->
        <div class="mt-blog-detail style1">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-8 wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <!-- Blog Post of the Page -->
                <article class="blog-post detail">
                  <div class="img-holder">
                    <a href="blog-right-sidebar.html"><img src="{{ url('uploads/'.$post->feature_image) }}" style="width: 790px; height: 365px; object-fit: cover" alt="{{ $post->title }}"></a>
                  </div>
                  <time class="time" datetime="{{ $post->created_at }}"><strong>{{ Carbon\Carbon::parse($post->created_at)->format('d') }}</strong>{{ Carbon\Carbon::parse($post->created_at)->format('F') }}</time>
                  <div class="blog-txt">
                    <h2><a>{{ $post->title }}</a></h2>
                    <ul class="list-unstyled blog-nav">
                      <li><i class="fa fa-clock-o"></i>{{ Carbon\Carbon::parse($post->created_at)->format('d F Y') }}</li>
                      <li> <i class="fa fa-list"></i>
                        @foreach ($post->categories as $category)
                          @if ($loop->last)
                          <a href="{{ url('blog?category='.$category->slug) }}">{{ $category->name }}</a>
                          @else
                          <a href="{{ url('blog?category='.$category->slug) }}">{{ $category->name }}</a>, 
                          @endif
                        @endforeach
                      </li>
                    </ul>

                    <div class="article-wrapper" 

                      @if (app()->isLocale('en') && empty($post->content_en))

                      <p class="text-muted"><small><em>*) @lang('label.content_not_available_in') English</em></small></p>

                      @elseif (app()->isLocale('id') && empty($post->content_id))

                      <p class="text-muted"><small><em>*) @lang('label.content_not_available_in') Bahasa Indonesia</em></small></p>

                      @endif

                    	{!! $post->content !!}
                    </div>

                    @if (!empty($post->widget_id))

                      @widget($post->widget->type, [
                        'widget' => $post->widget,
                        'count' => $post->widget->limit])

                    @endif

                  </div>
                </article>
               
              </div>

              <div class="col-xs-12 col-sm-4 text-right wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                
                <!-- Category Widget of the Page -->
            
	            @widget('post_categories', ['count' => 5, 'title' => trans('label.categories')])
	            <!-- Category Widget of the Page end -->
	            <!-- Popular Widget of the Page -->
	            @widget('post_recent', ['count' => 5, 'title' => trans('label.recent_post')])
	            <!-- Popular Widget of the Page end -->
	            <!-- Tag Widget of the Page -->
	            @widget('post_tags', ['count' => 5, 'title' => trans('label.tags')])
	            <!-- Tag Widget of the Page end -->

              </div>

            </div>
          </div>
        </div>
        <!-- Mt Blog Detail of the Page end -->
      </main>

@endsection

@push('js')

@if (session()->has('message'))

<script type="text/javascript">
    show_notification("<b>@lang('label.success')</b>",'success', "{{ session()->get('message') }}");
</script>

@endif

<script src="{{ url('frontend/js/post-show.js') }}"></script>
@endpush