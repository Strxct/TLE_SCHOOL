@extends('layout.base')
@section('content')



<div class="left-0 w-full fixed bottom-0 lg:hidden block">
    <div class="flex flex-row item-center justify-between">
        <a
            href="{{ route('kinderen.create') }}"
            class="bg-[#019AAC] w-full  text-center border-black text-white py-2 px-7">Voeg Kind toe</a>

    </div>
</div>

<table class="w-3/4 mx-auto">
    <div class="w-3/4 mx-auto">
        {{ $Kinderen->links()  }}
    </div>

    <tbody>
        @foreach($Kinderen as $Kind)
        <tr class=" flex  flex-col justify-between ">
            <div class=" px-4 py-2">{{ $Kind['Voornaam'] }}</div>
            <div class="flex flex-row w-full gap-y-4 lg:gap-y-0">
                <button class="bg-blue-500 w-full text-white text-sm py-1 px-2">
                    <a
                        href="{{ route('kinderen.scan', $Kind->UUID) }}"
                        class="text-white">
                        Reserveer voor kind
                    </a>
                </button>
                <button class="bg-blue-500 w-full text-white text-sm py-1 px-2">
                    <a
                        href="{{ route('kinderen.edit', $Kind->UUID) }}"
                        class="text-white">
                        <i class="fas fa-edit"></i> Update
                    </a>
                </button>

                <form
                    action="{{ url('/kinderen/' . $Kind->UUID) }}"
                    method="post"
                    class="inline">
                    @csrf @method('DELETE')
                    <button
                        class="bg-red-500 w-full text-white text-sm py-1 px-2"
                        type="submit">
                        <i class="fas fa-trash"></i> verwijderen
                    </button>
                </form>
            </div>
        </tr>
        @endforeach

    </tbody>

</table>


@endsection