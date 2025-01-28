@extends('layout.base') @section('content')

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

<table class="w-3/4 mx-auto">
    <div class="w-3/4 mx-auto">
        {{ $Mentoren->links() }}
    </div>

    <tbody class="lg:block hidden">
        @foreach($Mentoren as $Mentor)
        <tr class="border-b flex flex-row justify-between">
            <td class="px-4 py-2">{{ $Mentor["Voornaam"] }}</td>
            <td class="px-4 py-2">{{ $Mentor["Achternaam"] }}</td>
            <td class="px-4 py-2">{{ $Mentor["Email"] }}</td>
            <td class="px-4 py-2">
                <a
                    href="{{ route('mentoren.edit', $Mentor->UUID) }}"
                    class="text-white bg-[#019AAC] py-1 px-2 rounded bg-[#019AAC] text-white py-1 px-2 rounded text-center"
                >
                    <i class="fas fa-edit"></i> Update
                </a>

                <button
                    class="bg-red-500 text-white py-1 px-2 rounded open-modal"
                    data-mentor-name="{{ $Mentor['Voornaam'] }}"
                    data-mentor-id="{{ $Mentor->UUID }}"
                >
                    <i class="fas fa-trash"></i> verwijderen
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>

    <div class="lg:hidden block">
        @foreach($Mentoren as $Mentor)
        <div class="flex flex-col border-b border-black py-4 justify-between">
            <p class="px-4 py-2">{{ $Mentor["Voornaam"] }}</p>

            <div class="flex flex-row w-full gap-y-4 lg:gap-y-0">
                <a
                    href="{{ route('mentoren.edit', $Mentor->UUID) }}"
                    class="bg-[#019AAC] w-full mr-4 text-center text-white py-1 px-2"
                >
                    <i class="fas fa-edit"></i> Update
                </a>

                <button
                    class="bg-red-500 w-full ml-4 text-white py-1 px-2 open-modal"
                    data-mentor-name="{{ $Mentor['Voornaam'] }}"
                    data-mentor-id="{{ $Mentor->UUID }}"
                >
                    <i class="fas fa-trash"></i> verwijderen
                </button>
            </div>
        </div>
        @endforeach
    </div>
</table>

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
            <form id="deleteForm" method="post" action="">
                @csrf @method('DELETE')
                <button
                    type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Ga door
                </button>
            </form>
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
