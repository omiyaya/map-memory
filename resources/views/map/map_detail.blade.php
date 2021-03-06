@extends('layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/map/map_detail.css') }}">
@endsection

@section('content')
    <div class="map_detail">
        <form action="/map/map_detail/{{ $post['map_info']['area_id'] }}/regist" method="post" enctype="multipart/form-data">
            <map-detail-component :post='{{ $jsonPost }}'></map-detail-component>
            <input type="hidden" name="area_id" id="area_id" value="">
            @csrf
        </form>
    </div>
@endsection