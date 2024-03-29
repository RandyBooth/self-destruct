@extends('layouts.master')

@section('content')
    <div class="w-full md:w-2/3 lg:w-2/3 mx-auto bg-white shadow-md rounded-sm px-8 pt-10 pb-12">
        <label class="block text-gray-700 text-lg font-bold mb-2" for="note">
            Note
        </label>
        <textarea
            id="note"
            class="form-textarea block appearance-none w-full mt-1 mb-3 p-2 border border-gray-300 rounded-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            rows="10"
            readonly
        >{{ $note['body'] }}</textarea>

        <button
            type="button"
            class="clipboard text-primary text-sm font-bold text-small py-3 px-4"
            data-clipboard-target="#note"
        >
            Copy to clipboard
        </button>
    </div>
@endsection

@section('script-block')
    <!-- Scripts -->
    <script src="{{ mix('js/clipboard.js') }}" defer></script>
@endsection
