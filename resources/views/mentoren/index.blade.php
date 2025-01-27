@extends('layout.base') @section('content')



<div class="left-0 w-full fixed bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        <a
            href="{{ route('mentoren.create') }}"
            class="bg-[#019AAC] w-full  text-center border-black text-white py-2 px-7"
            >Voeg mentoor toe</a
        >
      
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
                <button class="bg-[#019AAC] text-white py-1 px-2 rounded">
                    <a
                        href="{{ route('mentoren.edit', $Mentor->UUID) }}"
                        class="text-white bg-[#019AAC] py-1 px-2 rounded"
                    >
                        <i class="fas fa-edit"></i> Update
                    </a>
                </button>

                <form
                    action="{{ url('/mentoren/' . $Mentor->UUID) }}"
                    method="post"
                    class="inline"
                >
                    @csrf @method('DELETE')
                    <button
                        class="bg-red-500 text-white py-1 px-2 rounded"
                        type="submit"
                    >
                        <i class="fas fa-trash"></i> verwijderen
                    </button>
                </form>
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

                <form
                    action="{{ url('/mentoren/' . $Mentor->UUID) }}"
                    method="post"
                    class="inline"
                >
                    @csrf @method('DELETE')
                    <button
                        class="bg-red-500 w-full ml-4 text-white py-1 px-2"
                        type="submit"
                    >
                        <i class="fas fa-trash"></i> verwijderen
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</table>

@endsection
