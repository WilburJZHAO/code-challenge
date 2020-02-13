@extends('layouts.app')

@section('content')


        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
</head>
<body>
<div id="app">
    <div style="margin-top: 1vw; width: 100%; height: auto;">
        <div style="width: 80%; margin-left: 10%">
            <b-card-group style="width: 40%; margin-left: 0; " deck>
                <b-card
                        style="border: 0; text-align: left;"
                >
                    <img src="https://picsum.photos/400/400/?image=20" style="width: 150px; height: 150px"/>
                </b-card>

                <b-card style="border: 0" title={{auth()->user()->name}}>

                    <b-card-text>{{auth()->user()->email}}</b-card-text>
                    <b-button variant="outline-primary" href="/editProfile">Edit profile</b-button>
{{--                    <b-modal id="eidtProfile" centered title="Edit Profile" size="xl"--}}
{{--                             scrollable>--}}
{{--                        <edit-profile/>--}}
{{--                        <template v-slot:modal-footer="{ ok, hide }">--}}
{{--                            <b-button size="md" variant="primary" @click="ok()">--}}
{{--                                Cancel--}}
{{--                            </b-button>--}}
{{--                        </template>--}}
{{--                    </b-modal>--}}
                </b-card>
            </b-card-group>
        </div>
    </div>
    <dashboard id="searchTag" data-user_id="<?php if (auth()->user() == "") {
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
<script src="{{URL::asset('/js/home.js')}}"></script>