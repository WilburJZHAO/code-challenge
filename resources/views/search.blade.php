@extends('layouts.app')
<?php
use App\User;
?>
@section('content')

        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Search</title>
</head>
<body>
<div id="app">
    <search id="searchTag" data-user_id="<?php if (auth()->user() == "") {
        echo auth()->user();
    } else {
        echo auth()->user()->id;
    } ?>"/>
</div>
</body>
</html>
@endsection

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>