@extends('layout')

@section('content')
    @if($errors->any())
        <ul class="alert alert-danger" style="padding: 20px 30px">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="/analyse" method="get">
        <div class="input-group">
            <input type="text" name="tweet" class="form-control" placeholder="Enter Tweet URL ..." aria-label="Enter Tweet URL ...">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Search</button>
            </span>
        </div>
        <small>e.g. https://twitter.com/learnenglish/status/919178501521100800</small>
    </form>
@endsection
