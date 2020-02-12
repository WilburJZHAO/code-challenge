<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>
<body>
<div id="app">
    <dashboard id="searchTag" data-user_id="<?php if(auth()->user() == ""){
        echo auth()->user();
    }else{
        echo auth()->user()->id;
    } ?>" />
</div>
<script src="{{ asset('js/app.js') }}"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>