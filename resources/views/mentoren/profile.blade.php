

@extends('layout.base')
@section('content')
<div class="lg:w-1/2 mx-auto mt-5">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
    
    <form action="{{ route('Mentoren.updateProfile' , $Mentor->UUID) }}" method="POST" class="max-w-md mx-auto" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- voornaam -->
        <div class="mx-auto mt-5">
            <h1 class="text-center">Mentor Profiel</h1>
        
            <!-- Voornaam -->
            <div class="mb-4">
                <label for="Voornaam" class="block font-medium text-gray-700">Voornaam</label>
                <p id="Voornaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2 bg-gray-100">{{ $Mentor->Voornaam }}</p>
            </div>
        
            <!-- Achternaam -->
            <div class="mb-4">
                <label for="Achternaam" class="block font-medium text-gray-700">Achternaam</label>
                <p id="Achternaam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2 bg-gray-100">{{ $Mentor->Achternaam }}</p>
            </div>
        
            <!-- Email -->
            <div class="mb-4">
                <label for="Email" class="block font-medium text-gray-700">Email</label>
                <p id="Email" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2 bg-gray-100">{{ $Mentor->Email }}</p>
            </div>
        </div>


         <!-- wachtwoord -->
        <div class="mb-4">
            <label for="price" class="block font-medium text-gray-700">Wachtwoord</label>
            <input type="password" name="Wachtwoord" id="Wachtwoord" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="">
            @error('wachtwoord')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block font-medium text-gray-700">Nieuw Wachtwoord</label>
            <input type="password" name="Newwachtwoord" id="Newwachtwoord" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="">
            @error('Newwachtwoord')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="Newwachtwoord_confirmation" class="block font-medium text-gray-700">Bevestig Nieuw Wachtwoord</label>
            <input type="password" name="Newwachtwoord_confirmation" id="Newwachtwoord_confirmation" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
        </div>


        <!-- image -->
        {{-- <div class="mb-4">
            <label for="image" class="block font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2" value="{{ $Mentor->image }}">
            <img src="/images/{{$Mentor->image}}" alt="employe image" srcset="">
        </div>
        @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror --}}


        <div class="mb-4">
            <button type="submit" class="bg-[#019AAC] w-full text-white py-2 px-4 rounded ">Update</button>
        </div>
        <div>
            <a href="{{ url('/mentoren') }}" class="block text-white w-full bg-[#C8304E] text-center py-2 rounded">Annuleren</a>
        </div>
    </form>
</div>


@stop