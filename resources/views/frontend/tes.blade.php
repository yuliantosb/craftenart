@foreach ($products as $item)
@if ($loop->first)
{{ $item->name }} <br>
--- <br>
@elseif ($loop->last)
--- <br>
{{ $item->name }} <br>
@else 
 -- {{ $item->name }} <br>
@endif

@endforeach