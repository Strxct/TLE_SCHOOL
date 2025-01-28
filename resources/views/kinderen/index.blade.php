@extends('layout.base')
@section('content')

<div class="left-0 w-full fixed bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        <a
            href="{{ route('kinderen.create') }}"
            class="bg-[#019AAC] w-full text-center border-black text-white py-2 px-7">Voeg Kind toe</a>
    </div>
</div>

<table class="w-3/4 mx-auto">
    <div class="w-3/4 mx-auto">
        {{ $Kinderen->links() }}
    </div>

    <tbody>
        @foreach($Kinderen as $Kind)
        <tr class="flex flex-col justify-between border-black">
            <a href="{{ route('kinderen.show', $Kind->UUID) }}" class="text-white flex flex-row gap-x-2">
                <div class="px-4 py-2 text-black">{{ $Kind['Voornaam'] }}</div>
                <div class="px-4 py-2 text-black">{{ $Kind['Achternaam'] }}</div>
            </a>
            <div class="flex flex-row w-full gap-y-4 lg:gap-y-0">
                <a
                    href="{{ route('kinderen.scan', $Kind->UUID) }}"
                    class="bg-green-500 w-full text-white text-center text-sm py-1 px-2 ml-2 mr-2 ">
                    Leen uit
                </a>
                @if (session('mentor_admin') == 1)
                <a
                    href="{{ route('kinderen.edit', $Kind->UUID) }}"
                    class="bg-[#019AAC] w-full text-white text-center text-sm py-1 px-2 ml-2 mr-2 ">
                    <i class="fas fa-edit"></i> Update
                </a>

                <button
                    class="bg-red-500 w-full text-white text-sm py-1 px-2 ml-2 mr-2 open-modal"
                    data-kind-name="{{ $Kind['Voornaam'] }}"
                    data-kind-id="{{ $Kind->UUID }}">
                    <i class="fas fa-trash"></i> verwijderen
                </button>

                @endif
            </div>
            <div class="border-b border-black mt-2 "></div>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white p-5 rounded-lg shadow-lg lg:w-1/3">
        <p id="modalMessage" class="text-lg mb-4">Weet je zeker dat je dit kind wilt verwijderen?</p>
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
                const kindName = button.getAttribute('data-kind-name');
                const kindId = button.getAttribute('data-kind-id');

                modalMessage.textContent = `Weet je zeker dat je ${kindName} wilt verwijderen?`;
                deleteForm.action = `/kinderen/${kindId}`;
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
</script>

@endsection