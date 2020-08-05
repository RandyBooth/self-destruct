@extends('layouts.master')

@section('title', 'Note')

@section('content')
    <div class="w-full md:w-2/3 lg:w-1/2 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12">
        <form method="POST" action="{{ route('note.password', compact('slug', 'slug_password')) }}">
            {{ csrf_field() }}

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2" for="password">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="shadow appearance-none border rounded-sm w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password')border-primary @enderror"
                    placeholder="********"
                />
                @error('password')
                    <p class="text-primary text-xs italic">{{ $errors->first('password') }}</p>
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                    class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-sm shadow focus:outline-none focus:shadow-outline"
                >
                    View Message
                </button>

                <a
                    class="text-primary font-bold py-3 px-4"
                    href="{{ route('home') }}"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
