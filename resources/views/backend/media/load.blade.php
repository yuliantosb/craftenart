
@foreach ($images as $image)

<div class="col-md-2" style="margin-bottom: 10px">
	<img src="{{ url('uploads/thumbs/'.$image->name) }}" class="img img-responsive" data-value="{{ $image->id }}" data-name="{{ $image->name }}">
</div>

@endforeach