@extends('layout.base')
@section('content')
    <div class="w-full max-w-md mx-auto mt-5 bg-white shadow-lg rounded-lg p-6 sm:p-8">

        <div class="text-center mb-4">
            <img src="{{ asset('images/lovk create.png') }}" alt="LOVK Logo" class="mx-auto w-24">
        </div>

        <form action="{{ route('products.update', $Product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-neutral-950 mb-1">Naam</label>
                <input type="text" id="name" name="name" placeholder="Naam" value="{{ $Product->name }}" class="w-full border border-gray-300 rounded-md p-2 sm:p-3">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-neutral-950 mb-1">Beschrijving</label>
                <textarea id="description" name="description" placeholder="Omschrijving" class="w-full border border-gray-300 rounded-md p-2 sm:p-3 h-[80px]">{{ $Product->description }}</textarea>
                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-neutral-950 mb-1">Foto</label>
                <div class="flex flex-col sm:flex-row gap-2">
                    <button type="button" class="flex-1 bg-[#0099ae] text-white rounded-md p-2 sm:p-3">
                        Maak foto
                    </button>
                    <button type="button" class="flex-1 bg-[#0099ae] text-white rounded-md p-2 sm:p-3">
                        Zoek foto
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-neutral-950 mb-1">QR Code</label>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <img src="https://cdn.webcrumbs.org/assets/images/ask-ai/qrcode.png" alt="QR Code" class="object-contain w-24 h-24 mx-auto sm:mx-0">
                    <button type="button" class="bg-[#0099ae] text-white rounded-md p-2 sm:p-3">
                        Download
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label for="note" class="block text-neutral-950 mb-1">Notitie</label>
                <textarea id="note" name="note" placeholder="Notitie" class="w-full border border-gray-300 rounded-md p-2 sm:p-3 h-[80px]">{{ $Product->note }}</textarea>
            </div>

            <div class="mb-4 flex items-center">
                <label for="active" class="block text-neutral-950 mb-1 mr-2">Actief</label>
                <input type="checkbox" id="active" name="active" {{ $Product->active ? 'checked' : '' }} class="toggle-checkbox">
            </div>

            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex-1 bg-[#0099ae] text-white rounded-md p-2 sm:p-3">
                    Update
                </button>
                <a href="{{ url('/products') }}" class="flex-1 text-center bg-[#e91d20] text-white rounded-md p-2 sm:p-3">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
@stop
