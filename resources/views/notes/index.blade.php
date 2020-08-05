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
        <form method="POST" action="{{ route('note.store') }}">
            {{ csrf_field() }}

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2" for="note">
                    Note
                </label>
                <textarea
                    id="note"
                    name="note"
                    class="form-textarea mt-1 block w-full p-2 mb-3 border border-gray-300 focus:outline-none focus:shadow-outline @error('note')border-primary @enderror"
                    rows="10"
                >{{ old('note') }}</textarea>
                @error('note')
                    <p class="text-primary text-xs italic">{{ $errors->first('note') }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <div>
                    <label class="block text-gray-700 text-lg font-bold mb-2" for="inline-full-name">
                        Password
                    </label>
                        <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input mt-1 block w-full p-2 mb-3 border border-gray-300 focus:outline-none focus:shadow-outline @error('password')border-primary @enderror"
                    >
                    @error('password')
                        <p class="text-primary text-xs italic">{{ $errors->first('password') }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-lg font-bold mb-2" for="inline-full-name">
                        Expired
                    </label>
                    <div class="relative">
                        <select
                            class="form-input mt-1 block w-full p-2 mb-3 border border-gray-300 focus:outline-none focus:shadow-outline @error('expired')border-primary @enderror"
                            name="expired"
                        >
                            <option value="">Destruct after reading</option>
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

            <div>
                <button
                    type="submit"
                    class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-sm shadow focus:outline-none focus:shadow-outline"
                >
                    Create Note
                </button>
            </div>
        </form>
    </div>
    @endisset
@endsection
