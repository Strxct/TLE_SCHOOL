@extends('layout.base')
@section('content')

<div class="lg:w-1/2 mx-auto mt-5">
    <div class="mb-4">
        <h2 class="text-2xl font-bold">Kind Details</h2>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Naam:</h3>
        <p>{{ $Kind->Voornaam }} {{ $Kind->Achternaam }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Ouder email:</h3>
        <p>{{ $Kind->Contact }}</p>
    </div>

    @php
    use Carbon\Carbon;
    $birthDate = Carbon::parse($Kind->Geboortedatum);
    $formattedBirthDate = $birthDate->format('d-m-Y');
    $age = $birthDate->diffInYears(Carbon::now());
    @endphp

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Geboortedatum:</h3>
        <p>{{ $formattedBirthDate }} ({{ $age }} jaar)</p>
    </div>

    {{-- <div class="mb-4">
        <h3 class="text-lg font-semibold">Leeftijd:</h3>
        <p>{{ $age }} jaar</p>
    </div> --}}

    <div class="mb-4">
        <h3 class="text-lg font-semibold">Mentor:</h3>
        <p>
            <a href="{{ route('mentoren.show', $Kind->mentor->UUID) }}" class="text-blue-500 underline">
                {{ $Kind->mentor->Voornaam }} {{ $Kind->mentor->Achternaam }}
            </a>
        </p>
    </div>

    <div class="w-full py-0.5 bg-[#C8304E] mb-2"></div>
    
    <div class="mb-4">
        <h3 class="text-lg font-semibold">Uitleen geschiedenis:</h3>
    </div>
    <table class="min-w-full border border-gray-200 text-sm text-gray-600 mb-6">
        <thead class="bg-gray-100">
            {{-- <tr>
                <th class="px-4 py-2 text-left font-medium text-gray-800">Naam</th>
                <th class="px-4 py-2 text-left font-medium text-gray-800">Status</th>
            </tr> --}}
        </thead>
        <tbody>
            @foreach ($Uitgeleend as $uitgeleendItem)
            @php
            // Find the corresponding item
            $voorwerp = $Voorwerpen->firstWhere('UUID', $uitgeleendItem->VoorwerpUUID);
            $uitgeleendStatus = $uitgeleendItem->Uitgeleend === 1 ? 'Ja' : 'Nee';
            @endphp
        
            @if ($voorwerp)
            <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">
                <a href="{{ route('voorwerpen.show', $voorwerp->UUID) }}" class="text-blue-500 underline">
                {{ $voorwerp->Naam }}
                </a>
                <div class="text-sm text-gray-500">Uitleendatum: {{ \Carbon\Carbon::parse($uitgeleendItem->Uitleendatum)->format('d-m-Y') }}</div>
            </td>
            <td class="px-4 py-2">
                @if ($uitgeleendStatus === 'Ja')
                <span class="text-green-500">Uitgeleend</span>
                @else
                @endif
            </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
    <div>
        <a href="{{ url('/kinderen') }}" class="block text-white w-full bg-[#C8304E] text-center py-2 rounded">Ga terug</a>
    </div>

</div>

  @endsection