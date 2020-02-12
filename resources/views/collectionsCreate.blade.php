@extends('layouts.app')

@section('content')

    <div>
        @foreach($data as $d)
            {{$d->name}}
        @endforeach
{{--        @if(count($errors)>0)--}}
{{--            <div class="mark">--}}
{{--                @if(is_object($errors))--}}
{{--                    @foreach($errors->all() as $error)--}}
{{--                    <p>{{$error}}</p>--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <p>{{$errors}}</p>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--         @endif--}}
        <form action="{{url('collections')}}" method="post">
            {{csrf_field()}}
            <table>
                <tr>
                    <td>name</td>
                    <td><input name="c_name" /></td>
                </tr>
                <tr>
                    <td>user id</td>
                    <td><input name="user_id" /></td>
                </tr>
                <tr>
                    <td>image id</td>
                    <td><input name="image_id" /></td>
                </tr>
                <tr>
                    <td>description</td>
                    <td><input name="c_description" /></td>
                </tr>
                <tr>
                    <td><button type="submit">submit</button></td>
                </tr>
            </table>
        </form>
    </div>

@endsection