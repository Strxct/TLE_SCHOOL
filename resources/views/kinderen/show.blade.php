@extends('layout.base')
@section('content')

<div class="mt-6 flex lg:w-6/12 mx-auto flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
  <div class="p-6">

    <!-- firstname -->

    <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
      <strong>Naam: </strong>
      {{ $Kind->Voornaam }} {{ $Kind->Achternaam }}
    </h5>

    <!-- email -->

    <h4 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
      <strong>Ouder email: </strong>
      {{ $Kind->Contact }}
    </h4>


    <!-- phone -->


    {{-- <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
      <strong>Phone: </strong>
      {{ $Kind->phone }}
    </h5> --}}
    <div class="mb-4">
      <h5 class="font-medium text-gray-700">Geboortedatum:</h5>
      <p>{{ $Kind->Geboortedatum }}</p>
      <h5 class="font-medium text-gray-700">Leeftijd:</h5>
      <p>
        @php
        $birthDate = new DateTime($Kind->Geboortedatum);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        echo $age . ' jaar';
        @endphp
      </p>
    </div>

    <!-- Show Items That Are Uitgeleend by This User -->
    <p>Uitgeleende geschiedenis</p>
    <table class="min-w-full border border-gray-200 text-sm text-gray-600">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2 text-left font-medium text-gray-800">Naam</th>
          <th class="px-4 py-2 text-left font-medium text-gray-800">Beschrijving</th>
          <th class="px-4 py-2 text-left font-medium text-gray-800">Leeftijd</th>
          <th class="px-4 py-2 text-left font-medium text-gray-800">Uitgeleend</th>
          <th class="px-4 py-2 text-left font-medium text-gray-800">Uitgeleend op</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($Voorwerpen as $voorwerp)
        @php
        // Check if the item is borrowed by this user
        $uitgeleendItem = $Uitgeleend->firstWhere(function ($u) use ($voorwerp, $Kind) {
        return $u->VoorwerpUUID === $voorwerp->UUID
        && $u->KindUUID === $Kind->UUID;
        });
        $uitgeleendStatus = $uitgeleendItem && $uitgeleendItem->Uitgeleend === 1 ? 'Ja' : 'Nee';
        @endphp

        <tr class="border-t hover:bg-gray-50">
          <td class="px-4 py-2">{{ $voorwerp->Naam }}</td>
          <td class="px-4 py-2">{{ $voorwerp->Beschrijving }}</td>
          <td class="px-4 py-2">{{ $voorwerp->leeftijd_van }} - {{ $voorwerp->leeftijd_tot }}</td>
          <td class="px-4 py-2">{{ $uitgeleendStatus }}</td>
          <td class="px-4 py-2">{{ $uitgeleendItem ? $uitgeleendItem->Uitleendatum : '-' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="  pt-10">
      <a href="{{ url('/kinderen') }}" class="bg-blue-400  p-3 border-rounded w-full">Ga terug</a>
    </div>
  </div>

  @endsection