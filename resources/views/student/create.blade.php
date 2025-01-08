@extends('layout.base')
@section('content')
<div class="w-1/2 mx-auto mt-5">
    <h1 class="text-center">Voeg en nieuw kind toe</h1>
    <form action="{{ route('student.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        <!-- firstname -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700">Naam</label>
            <input type="text" name="name" id="name" placeholder="Naam" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('firstname')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- lastname -->

        <div class="mb-4">
            <label for="parentMail" class="block font-medium text-gray-700">email ouders</label>
            <input type="text" name="parentMail" id="parentMail" placeholder="ouderemail@gmail.com" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('lastname')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- email -->
        <div class="mb-4">
            <label for="class" class="block font-medium text-gray-700">Klas</label>
            <select name="class" id="class" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
                <option value="">Klas naam</option>
                <option value="class1">klas 1</option>
                <option value="class2">klas 2</option>
                <option value="class3">klas 3</option>
            </select>
            @error('class')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- phone -->

        <!-- <div class="mb-4">
            <label for="phone" class="block font-medium text-gray-700">Phone</label>
            <input type="tel" name="phone" id="phone" class="border-gray-300 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border rounded-md shadow-sm p-2">
            @error('phone')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div> -->


        <div class="mb-4 w-full">
            <button type="submit" class="bg-[#019AAC] text-white py-2 px-4 rounded hover:bg-indigo-600 w-full text-center ">Register</button>
        </div>
        <div>
            <a href="{{ url('/students') }}" class="text-blue-500">Terug</a>
        </div>
    </form>
</div>
@endsection