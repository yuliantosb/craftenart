@extends('frontend.layouts.master')

@section('title', 'Blog')

@section('content')

<main id="mt-main">
    <!-- Mt Contact Banner of the Page -->
    <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background:  linear-gradient(rgba(241, 241, 241, 0.9), rgba(241, 241, 241, 0.9)), url(&quot;{{ count($posts) > 0 ? url('uploads/'.$posts->first()->feature_image) : '' }}&quot;) ; visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp; background-size: cover; background-repeat: no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center">
            <h1>BLOG</h1>
            <!-- Breadcrumbs of the Page -->
            <nav class="breadcrumbs">
              <ul class="list-unstyled">
                <li><a href="{{ url('/') }}">Home <i class="fa fa-angle-right"></i></a></li>
                <li>Blog</li>
              </ul>
            </nav>
            <!-- Breadcrumbs of the Page end -->
          </div>
        </div>
      </div>
    </section>
    <!-- Mt Contact Banner of the Page end -->
    <!-- Mt Blog Detail of the Page -->
    <div class="mt-blog-detail style1">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-8 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
            @if (count($posts) > 0)
              @foreach ($posts as $post)
              <!-- Blog Post of the Page -->
              <article class="blog-post style2">
                <div class="img-holder">
                  <a href="blog-post-detail-sidebar.html"><img src="{{ !empty($post->feature_image) ? url('uploads/thumbs/'.$post->feature_image) : 'http://placehold.it/280x170' }}" alt="{{ $post->title }}" style="width: 280px; height: 170px; object-fit: cover"></a>
                  <ul class="list-unstyled comment-nav">
                    <li><a href="#"><i class="fa fa-comments"></i>{{ $post->comments->count() }}</a></li>
                    <!-- <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li> -->
                  </ul>
                </div>
                <div class="blog-txt">
                  <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                  <ul class="list-unstyled blog-nav">
                    <li> <i class="fa fa-clock-o"></i>{{ Carbon\Carbon::parse($post->created_at)->format('F jS, Y') }}</li>
                    <li><i class="fa fa-list"></i>
                      @foreach ($post->categories as $category)
                        @if ($loop->last)
                        <a href="{{ url('blog?category='.$category->slug) }}">{{ $category->name }}</a>
                        @else
                        <a href="{{ url('blog?category='.$category->slug) }}">{{ $category->name }}</a>, 
                        @endif
                      @endforeach
                    </a></li>
                    <li> <a href="{{ url('blog/'.$post->slug.'#comment') }}"><i class="fa fa-comment"></i>{{ $post->comments->count() }} {{ str_plural('Comment', $post->comments->count()) }}</a></li>
                  </ul>
                  <p>{{ substr(strip_tags($post->content), 0, 120) }}</p>
                  <a href="{{ route('blog.show', $post->slug) }}" class="btn-more">Read More</a>
                </div>
              </article>
              <!-- Blog Post of the Page end -->
              @endforeach

            
              <!-- Blog Post of the Page end -->
              <!-- Btn Holder of the Page -->
              <div class="btn-holder">
                {{ $posts->appends(request()->except('page'))->links('vendor.pagination.custom') }}
              </div>
              <!-- Btn Holder of the Page end -->
            @else

            <center><h1 class="text-muted text-uppercase">Oopps...! <br>No posts found</h1></center>

            @endif
          </div>

          <div class="col-xs-12 col-sm-4 text-right sidebar wow fadeInRight" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInRight;">
            
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