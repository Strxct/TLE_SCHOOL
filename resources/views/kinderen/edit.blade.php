@extends('layout.base')
@section('content')
<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Update kinderen informatie</h1>
    <form action="{{ route('kinderen.update', $Kind->UUID) }}" method="POST" class="max-w-md mx-auto">
        @method('PUT')
        @csrf
            <!-- firstname -->
        <div class="mb-4">
            <label for="firstname" class="block font-medium text-gray-700">Voornaam</label>
            <input type="text" name="Voornaam" id="Voornaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Voornaam }}">
            @error('firstname')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-4">
            <label for="lastname" class="block font-medium text-gray-700">Achternaam</label>
            <input type="text" name="Achternaam" id="Achternaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Achternaam }}">
            @error('lastname')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- email -->
        <div class="mb-4">
            <label for="email" class="block font-medium text-gray-700">Contact</label>
            <input type="email" name="email" id="Contact" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Contact }}">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-4">
            <button type="submit" class="bg-[#019AAC] text-white py-2 px-4 rounded hover:bg-indigo-600 w-full text-center ">Update</button>
        </div>
        <div>
            <a href="{{ url('/kinderen') }}" class="text-blue-500">Terug</a>
        </div>
    </form>
</div>
@endsection