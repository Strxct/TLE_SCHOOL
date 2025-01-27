@extends('layout.base')
@section('content')

<div class="p-4 lg:block hidden">
    <a href="{{ route('voorwerpen.create') }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700">Voeg nieuw Voorwerp</a>
</div>

<div class=" left-0 w-full absolute bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        <a href="{{ route('voorwerpen.create') }}" class="bg-[#019AAC] w-full border-r border-black text-white py-2 px-7">Voeg nieuw Voorwerp</a>
        <a href="{{ route('voorwerpen.create') }}" class="bg-[#019AAC] w-full text-white py-2 text-center px-7">Retournen</a>

    </div>
</div>


<div class="mb-10">
    <p class="px-2">Sorteer</p>
    <select class="mt-2 block w-full bg-white border border-gray-300 rounded py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <option value="naam_asc">Naam (A-Z)</option>
        <option value="naam_desc">Naam (Z-A)</option>
        <option value="email_asc">Email (A-Z)</option>
        <option value="email_desc">Email (Z-A)</option>
        <option value="recent">Recent toegevoegd</option>
    </select>
    <select class="mt-4 block w-full bg-white border border-gray-300 rounded py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <option value="naam_asc">Naam (A-Z)</option>
        <option value="naam_desc">Naam (Z-A)</option>
        <option value="email_asc">Email (A-Z)</option>
        <option value="email_desc">Email (Z-A)</option>
        <option value="recent">Recent toegevoegd</option>
    </select>


</div>

<div class="w-3/4 mx-auto">
    {{ $Voorwerpen->links() }}
</div>

<table class="w-3/4 mx-auto hidden md:block">
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
        <tr class="">
            <td class="border px-4 py-2">{{ $Voorwerp->Naam }}</td>
            <td class="border px-4 py-2">{{ optional($Voorwerp->categorie)->Naam }}</td>
            <td class="border px-4 py-2">{{ $Voorwerp->Beschrijving }}</td>
            <td class="border px-4 py-2">{{ $Voorwerp->Notities }}</td>
            <td class="border px-4 py-2"><img src="{{ optional($Voorwerp->qr)->qr }}" alt="qrcode"></td>
            <td class="border px-4 py-2"><img src="{{ optional($Voorwerp->Foto)->Foto }}" alt="Voorwerp Foto"></td>
            <td class="border px-4 py-2">{{ $Voorwerp->Actief ? 'Yes' : 'No' }}</td>
            <td class="border px-4 py-2">{{ $Voorwerp->created_at }}</td>
            <td class="border px-4 py-2">


                <div class=" flex lg:flex-row flex-col gap-y-4 lg:gap-y-0">
                    <button class="bg-blue-500 text-white py-1 px-2 rounded">
                        <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="text-white">
                            <i class="fas fa-edit"></i> Update
                        </a>
                    </button>

                    <form action="{{ route('voorwerpen.destroy', $Voorwerp->UUID) }}" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white py-1 px-2 rounded" type="submit">
                            <i class="fas fa-trash"></i> verwijderen
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="w-full py-0.5 bg-[#C8304E]"></div>
<div class=" overflow-y-scroll h-[400px]">
    @foreach($Voorwerpen as $Voorwerp)
    <div class="  py-4 border-b border-black">
        <div class="flex flex-col ">
            <p class=" px-4  text-black">{{ $Voorwerp->Naam }}</p>
            <!-- <p class=" px-4  text-sm text-gray-400">{{ optional($Voorwerp->categorie)->Naam }}</p> -->
            <!-- <p class=" px-4  text-sm text-gray-400">is het voorwerp actief:{{ $Voorwerp->Actief ? 'Yes' : 'No' }}</p> -->
        </div>
        <!-- <td class="border px-4 py-2">{{ $Voorwerp->Beschrijving }}</td> -->
        <!-- <td class="border px-4 py-2">{{ $Voorwerp->Notities }}</td> -->
        <!-- <td class="border px-4 py-2">{{ $Voorwerp->QR }}</td> -->
        <!-- <td class="border px-4 py-2">{{ $Voorwerp->Foto }}</td> -->
        <!-- <td class="border px-4 py-2">{{ $Voorwerp->created_at }}</td> -->
        <div class="border ">
            <div class=" flex  w-full flex-row gap-y-4 lg:gap-y-0">
                <button class="bg-blue-500 w-full text-white py-1 px-2 ">
                    <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="text-white">
                        <i class="fas fa-edit"></i> Update
                    </a>
                </button>
                <form class="w-full" action="{{ route('voorwerpen.destroy', $Voorwerp->UUID) }}" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white w-full py-1 px-2 " type="submit">
                        <i class="fas fa-trash"></i> verwijderen
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="w-3/4 mx-auto">
    {{ $Voorwerpen->links() }}
</div>

@endsection