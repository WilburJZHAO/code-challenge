@extends('layouts.app')

@section('content')
    <div>
        <table>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>user id</td>
            </tr>
            @foreach($allImages as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->description}}</td>
                    <td>{{$c->user_id}}</td>
                    <td><a href="{{url('collections/'.$c->id.'/edit')}}">Edit</a></td>
                    <td><a >Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

<script src="{{URL::asset('/js/image.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('layer-v3.1.1/layer/layer.js') }}"></script>
