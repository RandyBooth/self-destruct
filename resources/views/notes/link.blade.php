@extends('layouts.master')

@section('title', 'Note')

@section('content')
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
                value=""
            />
        </div>
    </div>
@endsection
