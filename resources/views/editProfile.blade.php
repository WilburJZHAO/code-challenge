@extends('layouts.app')
<?php
use App\User;
?>
@section('content')

        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
</head>
<body>
<div id="app">
    <edit-profile id="searchTag" data-user_email="<?php echo auth()->user()->email; ?>"
                  data-user_name="<?php echo auth()->user()->name?>"
                  data-user_password="<?php echo auth()->user()->password; ?>"
                  data-user_role="<?php echo auth()->user()->role; ?>"/>
</div>
</body>
</html>

@endsection

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>