@extends('layouts.app')

@section('content')

        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Home</title>
</head>
<body>
<div>
    <div id="app">
        <home id="searchTag" data-user_id="<?php if (auth()->user() == "") {
            echo auth()->user();
        } else {
            echo auth()->user()->id;
        } ?>"/>
    </div>
</div>

</body>
</html>
@endsection

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{URL::asset('/js/home.js')}}"></script>