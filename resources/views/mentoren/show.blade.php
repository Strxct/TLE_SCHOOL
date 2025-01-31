@extends('layout.base')
@section('content')

<div class="lg:w-1/2 mx-auto mt-5">
    <div class="mb-4">
        <h2 class="text-2xl font-bold">Mentor Details</h2>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Naam:</h3>
        <p>{{ $Mentor->Voornaam }} {{ $Mentor->Achternaam }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Email:</h3>
        <p>{{ $Mentor->Email }}</p>
    </div>

    <div class="w-full py-0.5 bg-[#C8304E] mb-2"></div>
    
    <div class="mb-4">
        <h3 class="text-lg font-semibold">Kinderen toegewezen aan deze mentor:</h3>
    </div>
    <table class="min-w-full border border-gray-200 text-sm text-gray-600 mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left font-medium text-gray-800">Naam</th>
                <th class="px-4 py-2 text-left font-medium text-gray-800">Leeftijd</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Kinderen as $kind)
            @php
            $birthDate = \Carbon\Carbon::parse($kind->Geboortedatum);
            $formattedBirthDate = $birthDate->format('d-m-Y');
            $age = $birthDate->diffInYears(\Carbon\Carbon::now());
            @endphp
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">
                    <a href="{{ route('kinderen.show', $kind->UUID) }}" class="text-blue-500 underline">
                        {{ $kind->Voornaam }} {{ $kind->Achternaam }}
                    </a>
                </td>
                <td class="px-4 py-2">{{ $age }} jaar</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div>
        <a href="{{ url('/mentoren') }}" class="block text-white w-full bg-[#C8304E] text-center py-2 rounded">Ga terug</a>
    </div>

</div>

@endsection