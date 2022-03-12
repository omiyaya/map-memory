@extends('layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/map/map_detail.css') }}">
@endsection

@section('content')
    <div class="map_detail">
        <form action="/map/map_detail/{{ $post['map_info']['map_id'] }}/regist" method="post" enctype="multipart/form-data">
            <map-detail-component :post='{{ $jsonPost }}'></map-detail-component>
            <input type="hidden" name="map_id" id="map_id" value="">
            @csrf
        </form>
    </div>
@endsection