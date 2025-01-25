@extends('layout.base')
@section('content')

<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Voorwerp Details</h1>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Naam -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Naam:</h2>
            <p>{{ $voorwerp->Naam }}</p>
        </div>

        <!-- Beschrijving -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Beschrijving:</h2>
            <p>{{ $voorwerp->Beschrijving }}</p>
        </div>

        <!-- Notities -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Notities:</h2>
            <p>{{ $voorwerp->Notities }}</p>
        </div>

        <!-- QR -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">QR:</h2>
            <p>{{ $voorwerp->QR }}</p>
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Foto:</h2>
            <p>{{ $voorwerp->Foto }}</p>
        </div>

        <!-- Actief -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Actief:</h2>
            <p>{{ $voorwerp->Actief ? 'Yes' : 'No' }}</p>
        </div>

        <!-- Aanmaakdatum -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Aanmaakdatum:</h2>
            <p>{{ $voorwerp->created_at }}</p>
        </div>

        <!-- Categorie -->
        <div class="mb-4">
            <h2 class="font-medium text-gray-700">Categorie:</h2>
            <p>{{ optional($voorwerp->categorie)->Naam}}</p>
        </div>

        <div class="mt-4">
            <a href="{{ url('/voorwerpen') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Back</a>
        </div>
    </div>
</div>

@endsection