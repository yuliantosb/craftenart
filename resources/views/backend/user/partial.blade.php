@if($users->isEmpty())
    <center><h3 class="text-muted">No result found</h3></center>
@endif

@foreach ($users as $user)
	<div class="col-md-4" style="margin-bottom: 20px">
		<div class="text-center card-box">

            <div class="dropdown pull-right" style="padding: 10px">
                <!-- Single button -->
                <div class="btn-group">

                  <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-h"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.user.edit', $user->id) }}">Edit</a></li>
                    <li><a href="{{ route('admin.user.show', $user->id) }}">View</a></li>
                    <li><a href="javascript:void(0)" onclick="on_delete({{ $user->id }})">Delete</a></li>
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" id="form-delete-{{ $user->id}}" style="display:none">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                  </ul>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="{{ $user->cust->picture }}" class="img-circle img-thumbnail" alt="profile-image" style="width: 90px; height: 90px; object-fit: cover;">
                </div>
                <div class="">
                    <h4 class="m-b-5">{{ $user->name }}</h4>
                    <p>{{ $user->email }} <br> <span class="text-primary"> {{ $user->roles()->pluck('display_name')->implode(', ') }}</a> </span> </p>
                </div>
            </div>
        </div>
    </div>
@endforeach


<div class="col-md-12 m-t-20 text-right">
    {{ $users->links() }}
</div>