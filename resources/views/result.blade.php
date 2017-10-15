@extends('layout')

@section('content')
    @if(isset($Users) && count($Users))
        <table class="table table-striped">
          <thead>
            <tr>
              <th>N&#176;</th>
              <th>User</th>
              <th>followers</th>
            </tr>
          </thead>
          <tbody>
            @foreach($Users as $value => $user)
              <tr>
                  <td>{{$value + 1}}</td>
                  <td>{{$user["name"]}}</td>
                  <td>{{$user["followers"]}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
    @endif
@endsection
