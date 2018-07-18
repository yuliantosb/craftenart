<div class="media">
  <div class="img-box media-left">
    <img src="{{ Gravatar::get($comment->email, 200) }}" class="media-object" style="width:60px">
  </div>
  <div class="media-body txt">
      <h3><a href="{{ !empty($comment->website) ? $comment->website : '#' }}">{{ $comment->name }}</a></h3>
      <time class="mt-time" datetime="{{ $comment->created_at }}">{{ Carbon\Carbon::parse($comment->created_at)->format('F d, Y') }}</time>
     <p>{!! nl2br($comment->content) !!}</p>
     <br>
     <div class="text-right">
        <button class="btn btn-link btn-sm text-muted btn-reply" style="outline: none" data-value="{{ $comment->id }}">@lang('label.reply') &nbsp; <i class="fa fa-reply"></i></button>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="mt-leave-comment">
            <form action="{{ route('blog.comment', $post->id) }}" class="comment-form-custom form-comment-reply" method="post" id="form-comment-reply-{{ $comment->id }}" style="display: none">
              @csrf

              <h2>@lang('label.reply')</h2>

              <input type="text" name="parent_id" value="{{ $comment->id }}" hidden="hidden">

              <fieldset>

                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="@lang('label.name') *" name="name" required="required" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                      <span class="help-block"></span>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="@lang('label.email') *" name="email" required="required" value="{{ auth()->check() ? auth()->user()->email : '' }} ">
                      <span class="help-block"></span>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="@lang('label.website')" name="website" value="{{ auth()->check() ? auth()->user()->website : '' }}">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <textarea placeholder="@lang('label.message')" name="content" rows="5"></textarea>
                </div>

                <button type="submit" class="btn-custom-primary">@lang('label.reply')</button>

              </fieldset>
            </form>
          </div>
        </div>
      </div>

      <hr>
      @if (count($comment->children) > 0)
        @foreach($comment->children as $comment)
          @include('frontend.blog.partial', ['comment' => $comment, 'post' => $post])
        @endforeach
      @endif

  </div>
</div>
