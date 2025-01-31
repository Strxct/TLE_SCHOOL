@extends('layout.base')
@section('content')


<div class="left-0 w-full fixed bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        @if (session('mentor_admin') == 1)
        <a href="{{ route('voorwerpen.create') }}" class="bg-[#019AAC] w-full border-r border-black text-white py-2 text-center px-7">Nieuw Voorwerp</a>
        @endif
        <a href="{{ route('voorwerpen.scan') }}" class="bg-[#019AAC] w-full text-white py-2 text-center px-7">Retourneren</a>
    </div>
</div>

<div class="mb-10">
    <p class="px-2">Sorteer</p>
    <select id="sort-select" class="mt-2 block w-full bg-white border border-gray-300 rounded py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <option value="recent" {{ $sort == 'recent' ? 'selected' : '' }}>Recent toegevoegd</option>
        <option value="naam_asc" {{ $sort == 'naam_asc' ? 'selected' : '' }}>Naam (A-Z)</option>
        <option value="naam_desc" {{ $sort == 'naam_desc' ? 'selected' : '' }}>Naam (Z-A)</option>
        <option value="Uitgeleend_desc" {{ $sort == 'Uitgeleend_desc' ? 'selected' : '' }}>Uitgeleend (nieuw-oud)</option>
        <option value="Uitgeleend_asc" {{ $sort == 'Uitgeleend_asc' ? 'selected' : '' }}>Uitgeleend (oud-nieuw)</option>
        <option value="Categorie" {{ $sort == 'Categorie' ? 'selected' : '' }}>Domein</option>
    </select>
    <div id="categorie-select-container" class="mt-2 {{ $sort == 'Categorie' ? '' : 'hidden' }}">
        <p class="px-2">Selecteer Domein</p>
        <select id="categorie-select" class="mt-2 block w-full bg-white border border-gray-300 rounded py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach($Categories as $category)
            <option value="{{ $category->UUID }}" {{ $categorie == $category->UUID ? 'selected' : '' }}>{{ $category->Naam }}</option>
            @endforeach
        </select>
    </div>
</div>



<!-- when domein is selected in the dropdown show another to select what domein to filter bij -->

<!-- Modal -->
{{-- <div id="reserveer-modal" class="fixed z-50  inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center" style="display: none;">
    <div class="relative p-5 border w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <p><strong>Naam:</strong> <span id="modal-voorwerp-naam"></span></p>
            <img id="modal-voorwerp-foto" alt="Uploaded Image" class="h-40 object-cover mx-auto rounded-lg">
            <a id="reserveer-btn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 mt-4">Reserveer</a>
            <button id="close-modal-btn" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 mt-4">Close</button>
        </div>
    </div>
</div> --}}
<div class="flex flex-row gap-x-4 items-center">
    <button class="bg-[#019AAC] lg:block hidden text-white py-1 px-2 rounded">
        <a href="{{ route('voorwerpen.scan') }}" class="text-white">
            <i class="fas fa-edit"></i> Retourneren
        </a>
    </button>
    @if (session('mentor_admin') == 1)
    <div class=" lg:block hidden">
        <a href="{{ route('voorwerpen.create') }}" class="bg-[#019AAC] text-white py-1 px-2 rounded text-center">Nieuw Voorwerp</a>
    </div>
    @endif
</div>

<div class="w-full py-0.5 bg-[#C8304E] mt-2"></div>

<div class="mt-4 flex lg:block hidden">
    @foreach($Voorwerpen as $Voorwerp)
    @php
    // Check if the item is borrowed by this user
    $uitgeleendItem = $Uitgeleend->firstWhere('VoorwerpUUID', $Voorwerp->UUID);
    $kind = $uitgeleendItem ? $Kinderen->firstWhere('UUID', $uitgeleendItem['KindUUID']) : null;
    @endphp
    <div class="flex flex-row justify-between">
        <div class="px-2 py-2 text-black flex-1">
            <h5 class="font-medium">Naam:</h5>
            {{ $Voorwerp->Naam }}
        </div>
        <div class="px-2 py-2 text-black flex-1">
            <h5 class="font-medium">Domein:</h5>
            {{ optional($Voorwerp->categorie)->Naam }}
        </div>
        <div class="px-2 py-2 flex-1">
            <h5 class="font-medium">Foto:</h5>
            <img src="{{ optional($Voorwerp->Foto)->Foto }}" alt="Voorwerp Foto" class="h-20 w-20 object-cover">
        </div>
        <div class="px-2 py-2 text-black flex-1">
            @if($Voorwerp->Notities)
            <h5 class="font-medium">Notities:</h5>
            <span class="text-red-500">Heeft notitie</span>
            @endif
        </div>
        <div class="px-2 py-2 text-black flex-1">
            @if($uitgeleendItem)
            <h5 class="font-medium">Uitleendatum:</h5>
            {{ \Carbon\Carbon::parse($uitgeleendItem['Uitleendatum'])->format('d-m-Y') }}
            @endif
        </div>
        <div class="px-2 py-2 text-black flex-1">
            @if($kind)
            <h5 class="font-medium">Uitgeleend Aan:</h5>
            <a href="{{ route('kinderen.show', $kind['UUID']) }}" class="text-blue-500 underline">
                {{ $kind['Voornaam'] }} {{ $kind['Achternaam'] }}
            </a>
            @endif
        </div>
    </div>
    <div class="flex flex-row w-full gap-y-4 lg:gap-y-0 mt-2">
        <a href="{{ route('voorwerpen.show', $Voorwerp->UUID) }}" class="bg-green-500 w-full text-white text-center rounded text-sm py-1 px-2 ml-2 mr-2">
            <i class="fas fa-edit"></i> Details
        </a>
        @if (session('mentor_admin') == 1)
        <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="bg-[#019AAC] w-full text-white text-center rounded text-sm py-1 px-2 ml-2 mr-2">
            <i class="fas fa-edit"></i> Update
        </a>
        <button class="bg-red-500 w-full text-white rounded text-sm py-1 px-2 ml-2 mr-2 open-modal" data-voorwerp-name="{{ $Voorwerp->Naam }}" data-voorwerp-id="{{ $Voorwerp->UUID }}">
            <i class="fas fa-trash"></i> Verwijderen
        </button>
        @endif
    </div>
    <div class="border-b border-black mt-2"></div>
    @endforeach
</div>



<div class="overflow-y-scroll h-[400px] block lg:hidden block">
    @foreach($Voorwerpen as $Voorwerp)
    @php
    // Match $Voorwerp with $Uitgeleend using VoorwerpUUID
    $uitgeleendItem = $Uitgeleend->firstWhere('VoorwerpUUID', $Voorwerp->UUID);

    // Match $Kinderen using KindUUID from $Uitgeleend
    $kind = $uitgeleendItem ? $Kinderen->firstWhere('UUID', $uitgeleendItem['KindUUID']) : null;
    @endphp
    <div class="py-4 border-b border-black">
        <div class="flex flex-col">
            <a href="{{ route('voorwerpen.show', $Voorwerp->UUID) }}" class="text-white">
                <p class="px-4 text-black">{{ $Voorwerp->Naam }}</p>
            </a>
            @if($uitgeleendItem)
            <p class="px-4 text-black text-sm">
                <strong>Uitleendatum:</strong> {{ $uitgeleendItem['Uitleendatum'] }}<br>
                <strong>Uitgeleend Aan:</strong> 
                @if($kind)
                    <a href="{{ route('kinderen.show', $kind['UUID']) }}" class="text-blue-500 underline">
                        {{ $kind['Voornaam'] }} {{ $kind['Achternaam'] }}
                    </a>
                @else
                    -
                @endif
            </p>
            @endif
        </div>
        @if (session('mentor_admin') == 1)
        <div>
            <div class="flex w-full flex-row gap-y-4 gap-x-4 lg:gap-y-0 mt-2">
                <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="text-white text-center bg-[#019AAC] w-full text-white py-1 px-2">
                    <i class="fas fa-edit"></i> Update
                </a>
                <button
                    class="bg-red-500 text-white w-full py-1 px-2 open-modal"
                    data-voorwerp-name="{{ $Voorwerp->Naam }}"
                    data-voorwerp-id="{{ $Voorwerp->UUID }}">
                    <i class="fas fa-trash"></i> verwijderen
                </button>
            </div>
        </div>
        @endif
    </div>
    @endforeach
</div>
<!-- Modal -->
<div id="deleteModal" class="hidden fixed inset-0  z-50 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-5 rounded-lg shadow-lg lg:w-1/3">
        <p id="modalMessage" class="text-lg mb-4">Weet je zeker dat je dit voorwerp wilt verwijderen?</p>
        <div class="flex justify-end gap-4">
            <button id="cancelButton" class="bg-gray-300 text-black px-4 py-2 rounded">Annuleren</button>
            <form id="deleteForm" method="post" action="">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Ga door</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('deleteModal');
        const modalMessage = document.getElementById('modalMessage');
        const deleteForm = document.getElementById('deleteForm');
        const cancelButton = document.getElementById('cancelButton');

        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', () => {
                const voorwerpName = button.getAttribute('data-voorwerp-name');
                const voorwerpId = button.getAttribute('data-voorwerp-id');

                modalMessage.textContent = `Weet je zeker dat je ${voorwerpName} wilt verwijderen?`;
                deleteForm.action = `/voorwerpen/${voorwerpId}`;
                modal.classList.remove('hidden');
            });
        });

        document.getElementById('sort-select').addEventListener('change', function() {
        var categorieSelectContainer = document.getElementById('categorie-select-container');
        if (this.value === 'Categorie') {
            categorieSelectContainer.classList.remove('hidden');
        } else {
            categorieSelectContainer.classList.add('hidden');
            window.location.href = '/voorwerpen?sort=' + this.value;
        }
    });

    document.getElementById('categorie-select').addEventListener('change', function() {
        var sortValue = document.getElementById('sort-select').value;
        window.location.href = '/voorwerpen?sort=' + sortValue + '&categorie=' + this.value;
    });

        cancelButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>{{-- <script>
    function showReserveerModal(uuid, naam, foto) {
        document.getElementById('modal-voorwerp-naam').innerText = naam;
        document.getElementById('modal-voorwerp-foto').src = foto;
        document.getElementById('reserveer-modal').style.display = 'flex';
        console.log({{ $Session->mentor_uuid }});
let mentorUUID = "{{ $Session->mentor_uuid }}";
let reserveerBtn = document.getElementById('reserveer-btn');
reserveerBtn.href = "{{ route('reserveringen.store', ['MentorUUID' => '" + mentorUUID + "', 'VoorwerpUUID' => '" + uuid + "']) }}"
}

document.getElementById('close-modal-btn').addEventListener('click', function() {
document.getElementById('reserveer-modal').style.display = 'none';
});
</script> --}}


@endsection