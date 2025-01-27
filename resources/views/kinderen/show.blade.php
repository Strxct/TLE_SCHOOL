@extends('layout.base')
@section('content')

<div class="mt-6 flex w-96 mx-auto flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
  <div class="p-6">

    <!-- firstname -->

    <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
      <strong>Naam: </strong>
      {{ $Kind->Voornaam }} {{ $Kind->Achternaam }}
    </h5>

    <!-- email -->

    <h4 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
      <strong>Email: </strong>
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
  
  <div class="p-6 pt-0">
    <a href="{{ url('/kinderen') }}" class="bg-blue-400 p-3 border-rounded w-full">Back</a>
  </div>
</div>

@endsection