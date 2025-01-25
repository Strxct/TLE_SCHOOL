@extends('layout.base')
@section('content')

<div class="p-4">
        <h3 class="text-xl font-bold mb-4 text-center my-4 ">Employes crud Program</h3>
        <a href="{{ route('mentoren.create') }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700">Add new Mentor</a>
</div>

    <table class="w-3/4 mx-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">UUID</th>
                <th class="px-4 py-2">Voornaam</th>
                <th class="px-4 py-2">Achternaam</th>
                <th class="px-4 py-2">email</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($Mentoren as $Mentor)
                <tr>
                    <td class="border px-4 py-2">{{ $Mentor['UUID'] }}</td>
                    <td class="border px-4 py-2">{{ $Mentor['Voornaam'] }}</td>
                    <td class="border px-4 py-2">{{ $Mentor['Achternaam'] }}</td>
                    <td class="border px-4 py-2">{{ $Mentor['Email'] }}</td>
                    
                    <td class="border px-4 py-2">
                        <button class="bg-blue-500 text-white py-1 px-2 rounded">
                            <a href="{{ route('mentoren.edit' , $Mentor->UUID) }}" class="text-white">Edit</a>
                        </button>
                        <button class="bg-yellow-500 text-white py-1 px-2 rounded">
                            <a href="{{ route('mentoren.show' , $Mentor->UUID) }}" class="text-white">View</a>
                        </button>
                        <form action="{{ url('/mentoren/' . $Mentor->UUID) }}" method="post" class="inline">
                            @csrf 
                            @method('DELETE')
                            <button class="bg-red-500 text-white py-1 px-2 rounded" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection