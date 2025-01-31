@extends('layout.base')
@section('content')
@if (session('mentor_admin') == 1)
<div class="lg:w-1/2 mx-auto mt-5">
    <h1 class="text-center">Voeg en nieuw kind toe</h1>
    <form action="{{ route('kinderen.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        <!-- firstname -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Voornaam</label>
            <input type="text" name="Voornaam" id="Voornaam" placeholder="Naam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Voornaam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- firstname -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Achternaam</label>
            <input type="text" name="Achternaam" id="Achternaam" placeholder="Achternaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Achternaam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- geboortedatum -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Geboortedatum</label>
            <input type="date" name="Geboortedatum" id="Geboortedatum" placeholder="Geboortedatum" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Geboortedatum')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Email ouders / contact -->
        <div class="mb-4">
            <label for="Contact" class="block font-medium text-gray-700">E-mail ouders</label>
            <input type="text" name="Contact" id="Contact" placeholder="ouderemail@gmail.com" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Contact')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- email -->
        {{-- <div class="mb-4">
            <label for="class" class="block font-medium text-gray-700">Klas</label>
            <select name="Klas" id="Klas" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="">Klas naam</option>
                <option value="class1">klas 1</option>
                <option value="class2">klas 2</option>
                <option value="class3">klas 3</option>
            </select>
            @error('class')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> --}}
        <div class="mb-4">
            <label for="MentorUUID" class="block font-medium text-gray-700">Mentor</label>
            <select name="MentorUUID" id="MentorUUID" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                @foreach($Mentoren as $mentor)
                    <option value="{{ $mentor->UUID }}">{{ $mentor->Voornaam }} {{ $mentor->Achternaam }}</option>
                @endforeach
            </select>
            @error('MentorUUID')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- phone -->

        <!-- <div class="mb-4">
            <label for="phone" class="block font-medium text-gray-700">Phone</label>
            <input type="tel" name="phone" id="phone" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('phone')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> -->


        <div class="mb-4 w-full">
            <button type="submit" class="bg-[#019AAC] text-white py-2 px-4 rounded w-full text-center ">Registreer</button>
        </div>
        <div>
            {{-- <a href="{{ url('/kinderen') }}" class="text-blue-500">Terug</a> --}}
            <a
            href="{{ url('/kinderen') }}"
            class="block text-white w-full bg-[#C8304E] text-center py-2 rounded"
        >
            Annuleren
        </a>
        </div>
    </form>
</div>
@endif
@endsection