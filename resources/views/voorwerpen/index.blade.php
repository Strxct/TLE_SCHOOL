@extends('layout.base')
@section('content')

<div class="p-4">
    <h3 class="text-xl font-bold mb-4 text-center my-4">Voorwerpen CRUD Program</h3>
    <a href="{{ route('voorwerpen.create') }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700">Add new Voorwerp</a>
</div>

<!-- alert -->
@if(Session()->has('msg'))
    <div id="alert-2" class="w-3/4 mx-auto flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            {{ Session::get('msg') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif
<!-- end alert -->

<div class="w-3/4 mx-auto">
    {{ $Voorwerpen->links() }}
</div>

<table class="w-3/4 mx-auto">
    <thead>
        <tr>
            <th class="px-4 py-2">Naam</th>
            <th class="px-4 py-2">Categorie</th>
            <th class="px-4 py-2">Beschrijving</th>
            <th class="px-4 py-2">Notities</th>
            <th class="px-4 py-2">QR</th>
            <th class="px-4 py-2">Foto</th>
            <th class="px-4 py-2">Actief</th>
            <th class="px-4 py-2">Aanmaakdatum</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Voorwerpen as $Voorwerp)
            <tr>
                <td class="border px-4 py-2">{{ $Voorwerp->Naam }}</td>'
                <td class="border px-4 py-2">{{ optional($Voorwerp->categorie)->Naam }}</td>
                <td class="border px-4 py-2">{{ $Voorwerp->Beschrijving }}</td>
                <td class="border px-4 py-2">{{ $Voorwerp->Notities }}</td>
                <td class="border px-4 py-2">{{ $Voorwerp->QR }}</td>
                <td class="border px-4 py-2">{{ $Voorwerp->Foto }}</td>
                <td class="border px-4 py-2">{{ $Voorwerp->Actief ? 'Yes' : 'No' }}</td>
                <td class="border px-4 py-2">{{ $Voorwerp->created_at }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="bg-blue-500 text-white py-1 px-2 rounded">Edit</a>
                    <a href="{{ route('voorwerpen.show', $Voorwerp->UUID) }}" class="bg-yellow-500 text-white py-1 px-2 rounded">View</a>
                    <form action="{{ route('voorwerpen.destroy', $Voorwerp->UUID) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="w-3/4 mx-auto">
    {{ $Voorwerpen->links() }}
</div>

@endsection