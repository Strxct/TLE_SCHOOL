@extends('layout.base') @section('content')
<div class="lg:w-1/2 px-2 lg:px-0 mx-auto mt-5">
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

    <!-- Categorie -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">Categorie:</h2>
        <p>{{ optional($voorwerp->categorie)->Naam }}</p>
    </div>

    <!-- Leeftijd -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">Leeftijd:</h2>
        <p>{{ $voorwerp->leeftijd_van }} - {{ $voorwerp->leeftijd_tot }}</p>
    </div>

    <!-- Notities -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">Notities:</h2>
        <p>{{ $voorwerp->Notities }}</p>
    </div>

    <!-- QR -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">QR:</h2>
        <img src="{{ $voorwerp->qr->qr }}" alt="QR Code" class="h-1/10">
        <a href="{{ $voorwerp->qr->qr }}" download="qr_code.png" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Download QR</a>
    </div>

    <!-- Foto -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">Foto:</h2>
        @if (optional($voorwerp->Foto)->Foto)
            <img src="{{ optional($voorwerp->Foto)->Foto }}" alt="Uploaded Image" class="h-40 object-cover">
        @else
            <p class="text-gray-500">Geen foto geselecteerd</p>
        @endif
    </div>

    <!-- Actief -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">Actief:</h2>
        <p>{{ $voorwerp->Actief ? 'Ja' : 'Nee' }}</p>
    </div>

    <!-- Aanmaakdatum -->
    <div class="mb-4">
        <h2 class="font-medium text-gray-700">Aanmaakdatum:</h2>
        <p>{{ $voorwerp->created_at }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ url('/voorwerpen') }}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700">Terug</a>
    </div>
</div>
@endsection