@extends('backend.layouts.master')

@section('title', 'View Review')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="col-md-6">
                        <h4 class="title">View Review</h4>
                        <p class="review">Review By {{ $review->user->name }}</p>
                    </div>

                    <div class="col-md-6">
                        <form action="{{ route('admin.review.update', $review->id) }}" method="post">
                            @csrf
                            @method('put')
                            
                            <select name="status" class="select2" style="width: 80%">
                                <option value="0" {{ $review->status == 0 ? 'selected=selected' : '' }}>WAITING</option>
                                <option value="1" {{ $review->status == 1 ? 'selected=selected' : '' }}>APPROVE</option>
                            </select>
                        
                            <button class="btn btn-primary" type="Submit">Submit</button>

                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <img src="{{ $review->user->cust->picture }}" alt="{{ $review->user->name }}" class="img img-circle img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <div class="col-md-10">
                            
                            <p>{!! Helper::getRate($review->rate) !!}</p>

                            <blockquote>
                            <p>{{ $review->content }}</p>
                            <footer>{{ $review->user->name }} <cite title="Source Title"> {{ Carbon\Carbon::parse($review->created_at)->format('F jS, Y') }}</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection