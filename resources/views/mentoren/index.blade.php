@extends('layout.base')
@section('content')

<div class="p-4">
    <a href="{{ route('mentoren.create') }}" class="w-3/4 mx-auto bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">Voeg mentoor toe</a>
</div>

<table class="w-3/4 mx-auto">
    <div class="w-3/4 mx-auto">
        {{ $Mentoren->links() }}
    </div>

    <tbody>
        @foreach($Mentoren as $Mentor)
        <tr class="border-b flex flex-row justify-between">
            <td class="px-4 py-2">{{ $Mentor['Voornaam'] }}</td>
            <td class="px-4 py-2">{{ $Mentor['Achternaam'] }}</td>
            <td class="px-4 py-2">{{ $Mentor['Email'] }}</td>
            <td class="px-4 py-2">
                <button class="bg-blue-500 text-white py-1 px-2 rounded">
                    <a href="{{ route('mentoren.edit', $Mentor->UUID) }}" class="text-white">
                        <i class="fas fa-edit"></i> Update
                    </a>
                </button>

                <form action="{{ url('/mentoren/' . $Mentor->UUID) }}" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white py-1 px-2 rounded" type="submit">
                        <i class="fas fa-trash"></i> verwijderen
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection