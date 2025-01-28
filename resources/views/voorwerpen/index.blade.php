@extends('layout.base')
@section('content')

<div class="p-4 lg:block hidden">
    <a href="{{ route('voorwerpen.create') }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700">Voeg nieuw Voorwerp</a>
</div>

<div class="left-0 w-full fixed bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        <a href="{{ route('voorwerpen.create') }}" class="bg-[#019AAC] w-full border-r border-black text-white py-2 px-7">Nieuw Voorwerp</a>
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
</div>

<!-- Modal -->
{{-- <div id="reserveer-modal" class="fixed z-40  inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center" style="display: none;">
    <div class="relative p-5 border w-1/3 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <p><strong>Naam:</strong> <span id="modal-voorwerp-naam"></span></p>
            <img id="modal-voorwerp-foto" alt="Uploaded Image" class="h-40 object-cover mx-auto rounded-lg">
            <a id="reserveer-btn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 mt-4">Reserveer</a>
            <button id="close-modal-btn" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 mt-4">Close</button>
        </div>
    </div>
</div> --}}

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
        <tr>
            <td class="border px-4 py-2">{{ $Voorwerp->Naam }}</td>
            <td class="border px-4 py-2">{{ optional($Voorwerp->categorie)->Naam }}</td>
            <td class="border px-4 py-2">{{ $Voorwerp->Beschrijving }}</td>
            <td class="border px-4 py-2">{{ $Voorwerp->Notities }}</td>
            <td class="border px-4 py-2"><img src="{{ optional($Voorwerp->qr)->qr }}" alt="qrcode"></td>
            <td class="border px-4 py-2"><img src="{{ optional($Voorwerp->Foto)->Foto }}" alt="Voorwerp Foto"></td>
            <td class="border px-4 py-2">{{ $Voorwerp->Actief ? 'Yes' : 'No' }}</td>
            <td class="border px-4 py-2">{{ $Voorwerp->created_at }}</td>
            <td class="border px-4 py-2">
                <div class="flex lg:flex-row flex-col gap-y-4 lg:gap-y-0">
                    <button class="bg-blue-500 text-white py-1 px-2 rounded">
                        <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="text-white">
                            <i class="fas fa-edit"></i> Update
                        </a>
                    </button>
                    {{-- <button class="bg-blue-500 w-full text-white text-sm py-1 px-2" onclick="showReserveerModal('{{ $Voorwerp->UUID }}', '{{ $Voorwerp->Naam }}', '{{ $Voorwerp->FotoUUID ? $Voorwerp->Foto->Foto : 'Geen foto geselecteerd' }}')">
                        <i class="fas fa-edit"></i> Reserveer
                    </button> --}}
                    <button
                        class="bg-red-500 text-white py-1 px-2 rounded open-modal"
                        data-voorwerp-name="{{ $Voorwerp->Naam }}"
                        data-voorwerp-id="{{ $Voorwerp->UUID }}">
                        <i class="fas fa-trash"></i> verwijderen
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="w-full py-0.5 bg-[#C8304E]"></div>
<div class="overflow-y-scroll h-[400px] block md:hidden">
    @foreach($Voorwerpen as $Voorwerp)
    <div class="py-4 border-b border-black">
        <div class="flex flex-col">
            <a href="{{ route('voorwerpen.show', $Voorwerp->UUID) }}" class="text-white">
                <p class="px-4 text-black">{{ $Voorwerp->Naam }}</p>
            </a>
        </div>
        <div class="border">
            <div class="flex w-full flex-row gap-y-4 lg:gap-y-0">
                <button class="bg-blue-500 w-full text-white py-1 px-2">
                    <a href="{{ route('voorwerpen.edit', $Voorwerp->UUID) }}" class="text-white">
                        <i class="fas fa-edit"></i> Update
                    </a>
                </button>
                <button
                    class="bg-red-500 text-white w-full py-1 px-2 open-modal"
                    data-voorwerp-name="{{ $Voorwerp->Naam }}"
                    data-voorwerp-id="{{ $Voorwerp->UUID }}">
                    <i class="fas fa-trash"></i> verwijderen
                </button>
            </div>
        </div>
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