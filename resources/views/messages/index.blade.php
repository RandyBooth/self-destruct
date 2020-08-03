@extends('layouts.master')

@section('title', 'Home')

@section('content')
    @if(session()->has('link'))
    <div class="w-full md:w-2/3 lg:w-1/2 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12">
        <div>
            <label class="block text-gray-700 text-lg font-bold mb-2" for="link">
                Link
            </label>
            <input
                type="text"
                name="link"
                class="shadow appearance-none border rounded-sm w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                readonly
                value="{{ session()->get('link') }}"
            />
        </div>
    </div>
    @else
    <div class="w-full md:w-2/3 lg:w-2/3 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12">
        <form method="POST" action="{{ route('message.store') }}">
            {{ csrf_field() }}

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2" for="message">
                    Message
                </label>
                <textarea
                    id="message"
                    name="message"
                    class="form-textarea mt-1 block w-full p-2 mb-3 border border-gray-300 focus:outline-none focus:shadow-outline"
                    rows="10"
                >{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-primary text-xs italic">{{ $errors->first('message') }}</p>
                @enderror
            </div>

            {{-- <div>
                <span class="block my-4 text-lg text-primary font-bold">-- Test Start --</span>

                <pre><code>{{ var_dump($errors) }}</code></pre>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Password
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"  type="password" name="password">
                    </div>

                    @error('password')
                        <p class="text-primary text-xs italic">{{ $errors->first('password') }}</p>
                    @enderror
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Expired
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div class="relative">
                            <select class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 pr-8 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"  name="expired">
                                <option></option>
                                @foreach($expires as $key => $val)
                                <option value="{{ $key }}" {{ old('expired') == $key ? 'selected' : ''  }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>

                        @error('expired')
                            <p class="text-primary text-xs italic">{{ $errors->first('expired') }}</p>
                        @enderror
                    </div>
                </div>

                <span class="block my-4 text-lg text-primary font-bold">-- Test End --</span>
            </div> --}}

            <div>
                <button
                    type="submit"
                    class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-sm shadow focus:outline-none focus:shadow-outline"
                >
                    Create Message
                </button>
            </div>
        </form>
    </div>
    @endisset
@endsection
