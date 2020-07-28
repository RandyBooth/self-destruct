@extends('layouts.master')

@section('title', 'Message')

@section('content')
    <form method="POST" action="{{ route('message.password', compact('slug', 'slug_password')) }}">
        {{ csrf_field() }}
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </form>
@endsection
