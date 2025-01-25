@extends('layout.base')
@section('content')
<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Voeg een nieuw voorwerp toe</h1>
    <form action="{{ route('voorwerpen.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        <!-- CategorieUUID -->
        <div class="mb-4">
            <label for="CategorieUUID" class="block font-medium text-gray-700">Categorie</label>
            <select name="CategorieUUID" id="CategorieUUID" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                @foreach($Categories as $category)
                    <option value="{{ $category->UUID }}">{{ $category->Naam }}</option>
                @endforeach
            </select>
            @error('CategorieUUID')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Naam -->
        <div class="mb-4">
            <label for="Naam" class="block font-medium text-gray-700">Naam</label>
            <input type="text" name="Naam" id="Naam" placeholder="Naam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Naam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Beschrijving -->
        <div class="mb-4">
            <label for="Beschrijving" class="block font-medium text-gray-700">Beschrijving</label>
            <textarea name="Beschrijving" id="Beschrijving" placeholder="Beschrijving" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"></textarea>
            @error('Beschrijving')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Notities -->
        <div class="mb-4">
            <label for="Notities" class="block font-medium text-gray-700">Notities</label>
            <textarea name="Notities" id="Notities" placeholder="Notities" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2"></textarea>
            @error('Notities')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- QR -->
        <div class="mb-4">
            <label for="QR" class="block font-medium text-gray-700">QR</label>
            <input type="text" name="QR" id="QR" placeholder="QR" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('QR')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label for="Foto" class="block font-medium text-gray-700">Foto</label>
            <input type="text" name="Foto" id="Foto" placeholder="Foto" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Foto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Actief -->
        <div class="mb-4">
            <label for="Actief" class="block font-medium text-gray-700">Actief</label>
            <select name="Actief" id="Actief" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('Actief')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Aanmaakdatum -->
        {{-- <div class="mb-4">
            <label for="Aanmaakdatum" class="block font-medium text-gray-700">Aanmaakdatum</label>
            <input type="date" name="Aanmaakdatum" id="Aanmaakdatum" placeholder="Aanmaakdatum" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('Aanmaakdatum')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> --}}

        <div class="mb-4 w-full">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-indigo-600 w-full text-center">Submit</button>
        </div>
        <div>
            <a href="{{ url('/voorwerpen') }}" class="text-blue-500">Terug</a>
        </div>
    </form>
</div>
@endsection