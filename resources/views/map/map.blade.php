@extends('layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/map/map.css') }}">
    <script type="text/javascript" src="{{ asset('js/map/map.js') }}" ></script>
@endsection

@section('content')
    <div class="map">
        <map-component :maps='@json($map['large'])'></map-component>
        <input type="hidden" name="area_id" id="area_id" value="">

    </div>
@endsection