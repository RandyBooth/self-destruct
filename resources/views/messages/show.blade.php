@extends('layouts.master')

@section('title', 'Message')

@section('content')
    <div class="w-full md:w-2/3 lg:w-2/3 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12">
        <label class="block text-gray-700 text-lg font-bold mb-2" for="message">
            Message
        </label>
        <textarea
            id="message"
            class="form-textarea mt-1 block w-full p-2 mb-3 border border-gray-300 focus:outline-none focus:shadow-outline"
            rows="10"
            readonly
        >{{ $message_body }}</textarea>
    </div>
@endsection
