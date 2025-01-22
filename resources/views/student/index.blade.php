@extends('layout.base')
@section('content')

<div class="p-4">
        <a href="{{ route('kinderen.create') }}" class="w-3/4 mx-auto bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">Add new Kind</a>
    </div>

    <table class="w-3/4 mx-auto">
    <div class="w-3/4 mx-auto">
        {{ $Kinderen->links()  }}
    </div>
       

        <tbody>
            @foreach($Kinderen as $Kind)
                <tr class="border-b flex flex-row justify-between ">
                    <td class=" px-4 py-2">{{ $Kind['firstname'] }}</td>
                    <td class=" px-4 py-2">
    <button class="bg-blue-500 text-white py-1 px-2 rounded">
        <a href="{{ route('kinderen.edit', $Kind->UUID) }}" class="text-white">
            <i class="fas fa-edit"></i> Update
        </a>
    </button>
    <!-- <button class="bg-yellow-500 text-white py-1 px-2 rounded">
        <a href="{{ route('kinderen.show', $Kind->UUID) }}" class="text-white">
            <i class="fas fa-eye"></i> View
        </a>
    </button> -->
    <form action="{{ url('/kinderen/' . $Kind->UUID) }}" method="post" class="inline">
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