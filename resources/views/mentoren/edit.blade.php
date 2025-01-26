

@extends('layout.base')
@section('content')
<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Update Mentor</h1>
    <form action="{{ route('mentoren.update' , $Mentoren->UUID) }}" method="POST" class="max-w-md mx-auto" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- voornaam -->
        <div class="mb-4">
            <label for="noun" class="block font-medium text-gray-700">Voornaam</label>
            <input type="text" name="Voornaam" id="VSoornaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Mentoren->Voornaam }}">
            @error('Voornaam')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- achternaam -->
        <div class="mb-4">
            <label for="noun" class="block font-medium text-gray-700">Achternaam</label>
            <input type="text" name="Achternaam" id="Achternaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Mentoren->Achternaam }}">
            @error('Achternaam')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Email -->

        <div class="mb-4">
            <label for="quantity" class="block font-medium text-gray-700">Email</label>
            <input type="Email" name="Email" id="Email" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Mentoren->Email }}">
            @error('Email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


         <!-- wachtwoord -->
        <div class="mb-4">
            <label for="price" class="block font-medium text-gray-700">Wachtwoord</label>
            <input type="text" name="wachtwoord" id="wachtwoord" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="">
            @error('wachtwoord')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- admin -->
        <div class="mb-4">
            <label for="Admin" class="block font-medium text-gray-700">Admin</label>
            {{-- <input type="tel" name="Admin" id="Admin" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"> --}}
            <select name="Admin" id="Admin" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            @error('Admin')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- image -->
        {{-- <div class="mb-4">
            <label for="image" class="block font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Mentoren->image }}">
            <img src="/images/{{$Mentoren->image}}" alt="employe image" srcset="">
        </div>
        @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror --}}


        <div class="mb-4">
            <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600">Update Mentoren</button>
        </div>
        <div>
            <a href="{{ url('/mentoren') }}" class="text-blue-500 p-2">Back</a>
        </div>
    </form>
</div>


@stop