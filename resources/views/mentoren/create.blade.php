

@extends('layout.base')
@section('content')
<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Create Employe</h1>
    <form action="{{ route('mentoren.store') }}" method="post" class="max-w-md mx-auto" enctype="multipart/form-data">
        @csrf
        <!-- firstname -->
        <div class="mb-4">
            <label for="noun" class="block font-medium text-gray-700">Voornaam</label>
            <input type="text" name="Voornaam" id="Voornaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Voornaam')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Achternaam -->
        <div class="mb-4">
            <label for="noun" class="block font-medium text-gray-700">Achternaam</label>
            <input type="text" name="Achternaam" id="Achternaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Achternaam')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- email -->

        <div class="mb-4">
            <label for="quantity" class="block font-medium text-gray-700">Email</label>
            <input type="email" name="Email" id="Email" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


         <!-- Wachtwoord -->
        <div class="mb-4">
            <label for="price" class="block font-medium text-gray-700">Wachtwoord</label>
            <input type="text" name="Wachtwoord" id="Wachtwoord" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Wachtwoord')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Admin -->
        <div class="mb-4">
            <label for="Admin" class="block font-medium text-gray-700">Admin</label>
            {{-- <input type="tel" name="Admin" id="Admin" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"> --}}
            <select name="Admin" id="Admin" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="0">Nee</option>
                <option value="1">Ja</option>
            </select>
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- image -->
        {{-- <div class="mb-4">
            <label for="image" class="block font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
        </div> --}}


        <div class="mb-4">
            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600">Create Employe</button>
        </div>
        <div>
            <a href="{{ url('/mentoren') }}" class="text-blue-500 p-2">Back</a>
        </div>
    </form>
</div>


@stop