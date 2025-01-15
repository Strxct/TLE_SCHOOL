@extends('layout.base')
@section('content')

    <div class="w-full max-w-md mx-auto mt-8 bg-white shadow-lg rounded-lg p-6 sm:p-8">
        <div class="text-center mb-4">
            <img src="{{ asset('images/lovk create.png') }}" alt="LOVK Logo" class="mx-auto w-24">
        </div>

        <div class="mb-4">
            <label for="sort" class="block text-neutral-950 mb-1">Sorteer</label>
            <select id="sort" name="sort" class="w-full border border-gray-300 rounded-md p-2 sm:p-3">
                <option value="uitgeleend">Uitgeleend</option>
                <option value="beschikbaar">Beschikbaar</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="name" class="block text-neutral-950 mb-1">Naam</label>
            <input type="text" id="name" placeholder="Naam ..." class="w-full border border-gray-300 rounded-md p-2 sm:p-3">
        </div>

        <div class="py-4">
            <div style="background-color: #C8304E;" class="w-full h-1 mb-4"></div>
            @foreach($voorwerpen as $voorwerp)
                <div class="mb-4 border-b border-gray-200">
                    <p class="text-lg">{{ $voorwerp->Naam }}</p>
                    <p>Uitleen datum: {{ $voorwerp->Aanmaakdatum }}</p>
                    <p>Uitgeleend aan: {{ $voorwerp->kind ? $voorwerp->kind->Voornaam . ' ' . $voorwerp->kind->Achternaam : 'N/A' }}</p>
                    <div class="text-right">
                        <a href="{{ route('voorwerpen.show', $voorwerp->id) }}" class="text-blue-500">
                            <i class="fas fa-bell"></i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        <a href="{{ route('voorwerpen.create') }}" class="w-full block text-center bg-[#0099ae] text-white rounded-md py-2">
            Toevoegen
        </a>
    </div>

@endsection
