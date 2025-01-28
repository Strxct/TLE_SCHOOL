@extends('layout.base')
@section('content')
<div class="lg:w-1/2 mx-auto mt-5">
    <h1 class="text-center">Update kinderen informatie</h1>
    <form action="{{ route('kinderen.update', $Kind->UUID) }}" method="POST" class="max-w-md mx-auto">
        @method('PUT')
        @csrf

        <!-- Voornaam -->
        <div class="mb-4">
            <label for="Voornaam" class="block font-medium text-gray-700">Voornaam</label>
            <input type="text" name="Voornaam" id="Voornaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Voornaam }}">
            @error('Voornaam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Achternaam -->
        <div class="mb-4">
            <label for="Achternaam" class="block font-medium text-gray-700">Achternaam</label>
            <input type="text" name="Achternaam" id="Achternaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Achternaam }}">
            @error('Achternaam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Geboortedatum</label>
            <input type="date" name="Geboortedatum" id="Geboortedatum" placeholder="Geboortedatum" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Geboortedatum }}">
            @error('Geboortedatum')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Contact -->
        <div class="mb-4">
            <label for="Contact" class="block font-medium text-gray-700">Contact</label>
            <input type="email" name="Contact" id="Contact" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Kind->Contact }}">
            @error('Contact')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- MentorUUID -->
        <div class="mb-4">
            <label for="MentorUUID" class="block font-medium text-gray-700">Mentor</label>
            <select name="MentorUUID" id="MentorUUID" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="">Select Mentor</option>
                @foreach($Mentoren as $mentor)
                <option value="{{ $mentor->UUID }}" {{ $mentor->UUID == $Kind->MentorUUID ? 'selected' : '' }}>
                    {{ $mentor->Voornaam }} {{ $mentor->Achternaam }}
                </option>
                @endforeach
            </select>
            @error('MentorUUID')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4 w-full">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-indigo-600 w-full text-center">Update</button>
        </div>
        <div>
            <a href="{{ url('/kinderen') }}" class="block text-white w-full bg-[#C8304E] text-center py-2 rounded">Annuleren</a>
        </div>
    </form>
</div>
@endsection