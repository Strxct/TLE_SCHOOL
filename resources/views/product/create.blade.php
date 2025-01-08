@extends('layout.base')
@section('content')

    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-4 sm:p-6 mx-auto mt-8">
        <!-- Logo -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/lovk create.png') }}" alt="LOVK Logo" class="mx-auto w-24">
        </div>

        <!-- Form -->
        <form action="{{ route('products.store') }}" method="POST" class="mx-auto">
            @csrf
            <div class="mb-4">
                <label for="noun" class="block text-neutral-950 mb-1">Naam</label>
                <input type="text" name="noun" id="noun" placeholder="Enter product label" class="w-full border border-gray-300 rounded-md p-2 sm:p-3">
                @error('noun')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-neutral-950 mb-1">Beschrijving</label>
                <textarea id="description" name="description" placeholder="Voer een beschrijving in" class="w-full border border-gray-300 rounded-md p-2 sm:p-3 h-[80px]"></textarea>
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

            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit" class="flex-1 bg-[#0099ae] text-white rounded-md p-2 sm:p-3">
                    Registeren
                </button>
                <a href="{{ url('/products') }}" class="flex-1 text-center bg-[#e91d20] text-white rounded-md p-2 sm:p-3">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
@endsection
