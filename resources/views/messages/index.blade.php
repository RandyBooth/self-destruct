@extends('layouts.master')

@section('title', 'Home')

@section('content')
    @if(session()->has('link'))
    <div class="w-full md:w-2/3 lg:w-1/2 mx-auto bg-white shadow-md rounded px-8 pt-10 pb-12">
        <div>
            <label class="block text-gray-700 text-lg font-bold mb-2" for="link">
                Link
            </label>
            <input
                type="text"
                name="link"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                readonly
                value="{{ session()->get('link') }}"
            />
        </div>
    </div>
    @else
    <div class="w-full md:w-2/3 lg:w-2/3 mx-auto bg-white shadow-md rounded px-8 pt-10 pb-12">
        <form method="POST" action="{{ route('message.store') }}">
            {{ csrf_field() }}

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2" for="message">
                    Message
                </label>
                <textarea
                    id="message"
                    name="message"
                    class="form-textarea mt-1 block w-full p-2 mb-3 border border-gray-300"
                    rows="10"
                >{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-xs italic">{{ $errors->first('message') }}</p>
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded shadow shadow-inset focus:outline-none focus:shadow-outline"
                >
                    Create Message
                </button>
            </div>
        </form>
    </div>
    @endisset
@endsection
