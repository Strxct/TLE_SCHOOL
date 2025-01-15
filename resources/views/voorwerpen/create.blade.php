@extends('layout.base')
@section('content')

    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-4 sm:p-6 mx-auto mt-8">
        <!-- Logo -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/lovk create.png') }}" alt="LOVK Logo" class="mx-auto w-24">
        </div>

        <!-- Formulier -->
        <form action="{{ route('voorwerpen.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto">
            @csrf
            <div class="mb-4">
                <label for="firstname" class="block text-neutral-950 mb-1">Naam</label>
                <input type="text" name="firstname" id="firstname" placeholder="Enter product label" class="w-full border border-gray-300 rounded-md p-2 sm:p-3">
                @error('firstname')
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
                <input type="file" name="foto" id="foto" class="hidden" onchange="previewImage(event)">
                <div class="flex flex-col sm:flex-row gap-2">
                    <button type="button" class="flex-1 bg-[#0099ae] text-white rounded-md p-2 sm:p-3" onclick="openCamera()">
                        Camera
                    </button>
                    <button type="button" class="flex-1 bg-[#0099ae] text-white rounded-md p-2 sm:p-3" onclick="document.getElementById('foto').click()">
                        Zoek foto
                    </button>
                </div>
                <!-- Preview van de geselecteerde foto -->
                <div class="mt-4" id="preview-container">
                    <img id="preview-img" src="" alt="Preview" class="w-full rounded-md hidden">
                </div>
                <!-- Webcam container -->
                <div class="mt-4 hidden" id="camera-container">
                    <video id="webcam" width="100%" height="auto" autoplay></video>
                    <button type="button" class="bg-[#0099ae] text-white rounded-md p-2 sm:p-3 mt-2" onclick="takePhoto()">Neem foto</button>
                    <button type="button" class="bg-[#e91d20] text-white rounded-md p-2 sm:p-3 mt-2 hidden" id="stop-camera" onclick="stopCamera()">Stop camera</button>
                    <canvas id="canvas" class="hidden"></canvas>
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
                <a href="{{ url('/voorwerpen') }}" class="flex-1 text-center bg-[#e91d20] text-white rounded-md p-2 sm:p-3">
                    Annuleren
                </a>
            </div>
        </form>
    </div>


    <script>

        let webcamStream = null;

        // Open de webcam
        function openCamera() {
            const cameraContainer = document.getElementById('camera-container');
            const webcam = document.getElementById('webcam');
            const stopCameraButton = document.getElementById('stop-camera');

            // Webcam openen
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    webcam.srcObject = stream;
                    webcamStream = stream;
                    cameraContainer.classList.remove('hidden');
                    stopCameraButton.classList.remove('hidden');
                })
                .catch(function (error) {
                    console.log('webcam werkt niet', error);
                });
        }

        // Maak een foto van de webcam
        function takePhoto() {
            const webcam = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');

            canvas.width = webcam.videoWidth;
            canvas.height = webcam.videoHeight;

            context.drawImage(webcam, 0, 0, canvas.width, canvas.height);

            const dataUrl = canvas.toDataURL('image/png');
            const previewImg = document.getElementById('preview-img');
            previewImg.src = dataUrl;
            previewImg.classList.remove('hidden');
            stopCamera();
        }

        // Stop de webcam
        function stopCamera() {
            if (webcamStream) {
                const tracks = webcamStream.getTracks();
                tracks.forEach(track => track.stop());
            }

            // Verberg de camera en de stopknop
            document.getElementById('camera-container').classList.add('hidden');
            document.getElementById('stop-camera').classList.add('hidden');
        }

        // Bekijk de afbeelding die geselecteerd is
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function () {
                const previewImg = document.getElementById('preview-img');
                previewImg.src = reader.result;
                previewImg.classList.remove('hidden');
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection
