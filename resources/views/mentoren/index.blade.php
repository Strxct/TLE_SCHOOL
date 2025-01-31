@extends('layout.base') @section('content')

@if (session('mentor_admin') == 1)
<div class="left-0 w-full fixed bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        <a
            href="{{ route('mentoren.create') }}"
            class="bg-[#019AAC] w-full text-center border-black text-white py-2 px-7"
        >
            Voeg mentoor toe
        </a>
    </div>
</div>
@endif


{{-- @if (session('mentor_admin') == 1)
<div class="left-0 w-full fixed bottom-0 lg:block hidden">
    <div class="flex flex-row item-center justify-between">
        <a
            href="{{ route('mentoren.create') }}"
            class="bg-[#019AAC] w-full text-center border-black text-white py-2 px-7"
        >
            Voeg mentoor toe
        </a>
    </div>
</div>
@endif --}}
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

<div class="flex flex-row gap-x-4 items-center ml-2 mb-2">
    @if (session('mentor_admin') == 1)
        <a href="{{ route('mentoren.create') }}" class="bg-[#019AAC] lg:block hidden text-white py-1 px-2 rounded text-center">Voeg mentor toe</a>
    @endif
</div>

<div class="w-full py-0.5 bg-[#C8304E] mb-2"></div>


<div class="mt-4 flex lg:block hidden">
    @foreach($Mentoren as $Mentor)
    <div class="flex flex-row justify-between">
        <div class="px-2 py-2 text-black flex-1">
            <h5 class="font-medium">Voornaam:</h5>
            {{ $Mentor->Voornaam }}
        </div>
        <div class="px-2 py-2 text-black flex-1">
            <h5 class="font-medium">Achternaam:</h5>
            {{ $Mentor->Achternaam }}
        </div>
        <div class="px-2 py-2 text-black flex-1">
            <h5 class="font-medium">Email:</h5>
            {{ $Mentor->Email }}
        </div>
    </div>
    <div class="flex flex-row w-full gap-y-4 lg:gap-y-0 mt-2">
        <a href="{{ route('mentoren.show', $Mentor->UUID) }}" class="bg-green-500 w-full text-white text-center rounded text-sm py-1 px-2 ml-2 mr-2">
            <i class="fas fa-edit"></i> Details
        </a>
        @if (session('mentor_admin') == 1)
        <a href="{{ route('mentoren.edit', $Mentor->UUID) }}" class="bg-[#019AAC] w-full text-white text-center rounded text-sm py-1 px-2 ml-2 mr-2">
            <i class="fas fa-edit"></i> Update
        </a>
        <button class="bg-red-500 w-full text-white rounded text-sm py-1 px-2 ml-2 mr-2 open-modal" data-mentor-name="{{ $Mentor->Voornaam }}" data-mentor-id="{{ $Mentor->UUID }}">
            <i class="fas fa-trash"></i> Verwijderen
        </button>
        @endif
    </div>
    <div class="border-b border-black mt-2"></div>
    @endforeach
</div>


    <div class="lg:hidden block mt-4 w-full"> 
        @foreach($Mentoren as $Mentor)
        <div class="flex flex-col border-b border-black py-4 justify-between">
            <a class="flex flex-row" href="{{ route('mentoren.show', $Mentor->UUID) }}">
            <p class="px-4 py-2">{{ $Mentor["Voornaam"] }}</p>
            <p class="px-4 py-2">{{ $Mentor["Achternaam"] }}</p>
            </a>
            @if (session('mentor_admin') == 1)
            <div class="flex flex-row w-full gap-y-4 lg:gap-y-0">
                <a
                    href="{{ route('mentoren.edit', $Mentor->UUID) }}"
                    class="bg-[#019AAC] w-full mr-4 text-center text-white rounded py-1 px-2"
                >
                    <i class="fas fa-edit"></i> Update
                </a>

                <button
                    class="bg-red-500 w-full ml-4 text-white rounded py-1 px-2 open-modal"
                    data-mentor-name="{{ $Mentor['Voornaam'] }}"
                    data-mentor-id="{{ $Mentor->UUID }}"
                >
                    <i class="fas fa-trash"></i> verwijderen
                </button>
            </div>
            @endif
        </div>
        @endforeach
    </div>

<!-- Modal -->
<div
    id="deleteModal"
    class="hidden fixed inset-0 bg-gray-600 z-50 bg-opacity-50 flex items-center justify-center"
>
    <div class="bg-white p-5 rounded-lg shadow-lg lg:w-1/3">
        <p id="modalMessage" class="text-lg mb-4">
            Weet je zeker dat je deze mentor wilt verwijderen?
        </p>
        <div class="flex justify-end gap-4">
            <button
                id="cancelButton"
                class="bg-gray-300 text-black px-4 py-2 rounded"
            >
                Annuleren
            </button>
            @if (session('mentor_admin') == 1)
            <form id="deleteForm" method="post" action="">
                @csrf @method('DELETE')
                <button
                    type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Ga door
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const modal = document.getElementById("deleteModal");
        const modalMessage = document.getElementById("modalMessage");
        const deleteForm = document.getElementById("deleteForm");
        const cancelButton = document.getElementById("cancelButton");

        document.querySelectorAll(".open-modal").forEach((button) => {
            button.addEventListener("click", () => {
                const mentorName = button.getAttribute("data-mentor-name");
                const mentorId = button.getAttribute("data-mentor-id");

                modalMessage.textContent = `Weet je zeker dat je ${mentorName} wilt verwijderen?`;
                deleteForm.action = `/mentoren/${mentorId}`;
                modal.classList.remove("hidden");
            });
        });

        cancelButton.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        window.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.classList.add("hidden");
            }
        });
    });
</script>

@endsection
