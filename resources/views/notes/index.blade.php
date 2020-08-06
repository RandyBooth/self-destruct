@extends('layouts.master')

@section('content')
    @if(session()->has('link'))
    <div class="w-full md:w-2/3 lg:w-1/2 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12">
        <div>
            <label class="block text-gray-700 text-lg font-bold mb-2" for="link">
                Link
            </label>
            <input
                type="text"
                id="link"
                name="link"
                class="block appearance-none w-full mt-1 mb-3 p-2 border border-gray-300 rounded-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                readonly
                value="{{ session()->get('link') }}"
            />

            <button
                type="button"
                class="clipboard text-primary text-sm font-bold text-small py-3 px-4"
                data-clipboard-target="#link"
            >
                Copy to clipboard
            </button>
        </div>
    </div>
    @else
    <div class="w-full md:w-2/3 lg:w-2/3 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12" x-data="{ open: false }">
        <form method="POST" action="{{ route('note.store') }}">
            {{ csrf_field() }}

            <div class="mb-6">
                <label class="block text-gray-700 text-lg font-bold mb-2" for="note">
                    Note
                </label>
                <textarea
                    id="note"
                    name="note"
                    class="form-textarea block appearance-none w-full mt-1 mb-3 p-2 border border-gray-300 rounded-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('note')border-primary @enderror"
                    rows="10"
                    placeholder="Enter your note..."
                >{{ old('note') }}</textarea>
                @error('note')
                    <p class="text-primary text-xs italic">{{ $errors->first('note') }}</p>
                @enderror

                <div class="text-right">
                    <button
                        type="button"
                        class="text-primary text-sm font-bold text-small py-3 px-4"
                        @click="open = !open"
                    >
                        <template x-if="open !== true"><span>Show options</span></template>
                        <template x-if="open === true"><span>Hide options</span></template>
                    </button>
                </div>
            </div>

            <div x-show="open">
                <div class="mb-6">
                    <label class="block text-gray-700 text-lg font-bold mb-2" for="inline-full-name">
                        Password
                    </label>
                        <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input block appearance-none w-full mt-1 mb-3 p-2 border border-gray-300 rounded-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password')border-primary @enderror"
                    >
                    @error('password')
                        <p class="text-primary text-xs italic">{{ $errors->first('password') }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-lg font-bold mb-2" for="inline-full-name">
                        Expiration
                    </label>
                    <div class="relative">
                        <select
                            class="form-select block appearance-none w-full mt-1 mb-3 p-2 border border-gray-300 rounded-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('expiration')border-primary @enderror"
                            name="expiration"
                        >
                            <option value="">Destruct after reading</option>
                            @foreach($expires as $key => $val)
                            <option value="{{ $key }}" {{ old('expiration') == $key ? 'selected' : ''  }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('expiration')
                        <p class="text-primary text-xs italic">{{ $errors->first('expiration') }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-sm shadow focus:outline-none focus:shadow-outline mr-2"
                >
                    Create Note
                </button>
            </div>
        </form>
    </div>
    @endisset
@endsection

@section('script-block')
    <!-- Scripts -->
    <script src="{{ mix('js/alpine.js') }}" defer></script>
    <script src="{{ mix('js/clipboard.js') }}" defer></script>
@endsection
