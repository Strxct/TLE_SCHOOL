@extends('layout.base')
@section('content')

<div class="p-4">
        <a href="{{ route('student.create') }}" class="w-3/4 mx-auto bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">Add new Student</a>
    </div>

    <table class="w-3/4 mx-auto">
    <div class="w-3/4 mx-auto">
        {{ $Students->links()  }}
    </div>
       

        <tbody>
            @foreach($Students as $Student)
                <tr class="border-b flex flex-row justify-between ">
                    <td class=" px-4 py-2">{{ $Student['firstname'] }}</td>
                    <td class=" px-4 py-2">
    <button class="bg-blue-500 text-white py-1 px-2 rounded">
        <a href="{{ route('student.edit', $Student->id) }}" class="text-white">
            <i class="fas fa-edit"></i> Update
        </a>
    </button>
    <!-- <button class="bg-yellow-500 text-white py-1 px-2 rounded">
        <a href="{{ route('student.show', $Student->id) }}" class="text-white">
            <i class="fas fa-eye"></i> View
        </a>
    </button> -->
    <form action="{{ url('/students/' . $Student->id) }}" method="post" class="inline">
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