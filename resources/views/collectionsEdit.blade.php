@extends('layouts.app')

@section('content')

    <div>
        <form action="{{url('collections/'.$field->id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table>
                <tr>
                    <td>name</td>
                    <td><input name="name" value="{{$field->name}}"/></td>
                </tr>
                <tr>
                    <td>user id</td>
                    <td><input name="user_id" value="{{$field->user_id}}"/></td>
                </tr>
                <tr>
                    <td>image id</td>
                    <td><input name="image_id" value="{{$field->image_id}}"/></td>
                </tr>
                <tr>
                    <td><button type="submit">submit</button></td>
                </tr>
            </table>
        </form>
    </div>

@endsection