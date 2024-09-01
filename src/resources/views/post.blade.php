@extends('welcome')

@section('body')
    <comments :post="{{ $post }}" :user="{{ Auth::user() }}"></comments>
@endsection
