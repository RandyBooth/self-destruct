@extends('layouts.master')

@section('title', 'Message')

@section('content')
    <div>
        <label class="block text-gray-700 text-lg font-bold mb-2" for="message">
            Message
        </label>
        <textarea
            id="message"
            class="form-textarea mt-1 block w-full p-2"
            rows="10"
            readonly
        >{{ $message_body }}</textarea>
    </div>
@endsection
