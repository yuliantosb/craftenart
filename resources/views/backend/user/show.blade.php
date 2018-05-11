@extends('backend.layouts.master')
@section('title')
	{{ $user->name }}
@endsection
@section('content')
<div class="container-fluid">
	<div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <div class="pull-left">
                    <h4 class="title">{{ $user->name }}</h4>
                </div>
                <div class="pull-right">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

	        <div class="col-md-12">
				

			</div>

		</form>
			
	</div>
</div>

@endsection