@extends('layout.base')
@section('content')

<div class="lg:w-1/2 px-2 lg:px-0 mx-auto mt-5">
    <h2 class="font-medium text-gray-700 text-center mb-4">Scan QR Code</h2>
    <div id="qr-reader" class="border-2 border-gray-300 rounded-lg p-4 mb-4" style="width: 100%;"></div>
    <div id="voorwerp-details" class="bg-gray-100 shadow-md rounded-lg p-4 mb-4 " style="display: none;">
        <h2 class="font-medium text-gray-700 text-center mb-4">Voorwerp Details</h2>
        <div class="mb-2">
            <strong>Naam:</strong> <span id="voorwerp-naam"></span>
        </div>
        <div class="mb-2">
            <strong>Domein:</strong> <span id="voorwerp-categorie"></span>
        </div>
        <div class="mb-2">
            <strong>Beschrijving:</strong> <span id="voorwerp-beschrijving"></span>
        </div>
        <div class="mb-2">
            <strong>Leeftijd:</strong> <span id="voorwerp-leeftijd"></span>
        </div>
        <div class="mb-2">
            <strong>Notities:</strong> <span id="voorwerp-notities"></span>
        </div>
        <div class="mb-2">
            <img id="voorwerp-foto" alt="Uploaded Image" class="h-40 object-cover rounded-lg">
        </div>
        <div class="flex flex-row justify-center">
        <button id="scan-again-btn" class="bg-[#019AAC] text-white py-2 px-4 rounded hover:bg-blue-700 mt-4 ml-5" style="display: none;">Scan opnieuw</button>
        <form id="leen-uit-form" action="{{ route('uitleengeschiedenis.store') }}" method="POST">
            @method('POST')
            @csrf
            <input type="hidden" name="VoorwerpUUID" id="voorwerp-uuid">
            <input type="hidden" name="KindUUID" value="{{ $Kind->UUID }}">
            <input type="hidden" name="Uitgeleend" value="1">
            <button type="submit" id="leen-uit-btn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 mt-4 mr-5" style="display: none;">Leen Uit</button>
        </form>
    </div>
    </div>
    <a href="{{ url('/kinderen')}}" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700">Terug</a>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let scannedCode = null;
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code scanned = ${decodedText}`, decodedResult);

            scannedCode = decodedText;

            fetch(`/api/voorwerpen/${decodedText}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.voorwerp.Actief) {
                    document.getElementById('voorwerp-naam').innerText = data.voorwerp.Naam;
                    document.getElementById('voorwerp-categorie').innerText = data.categorie.Naam;
                    document.getElementById('voorwerp-beschrijving').innerText = data.voorwerp.Beschrijving;
                    document.getElementById('voorwerp-leeftijd').innerText = `${data.voorwerp.leeftijd_van} - ${data.voorwerp.leeftijd_tot}`;
                    document.getElementById('voorwerp-notities').innerText = data.voorwerp.Notities;
                    document.getElementById('voorwerp-foto').src = data.foto ? data.foto.Foto : 'Geen foto geselecteerd';
                    document.getElementById('voorwerp-uuid').value = data.voorwerp.UUID;
                    document.getElementById('voorwerp-details').style.display = 'block';
                    document.getElementById('leen-uit-btn').style.display = 'block'; 
                } else {
                    alert('Voorwerp is niet actief');
                }
                
            })
            .catch(error => console.error('Error fetching voorwerp:', error));
            
            // Stop the scanner after a successful scan
            html5QrCode.stop().then(() => {
                console.log("QR Code scanning stopped.");
                document.getElementById('qr-reader').style.display = 'none';
                document.getElementById('scan-again-btn').style.display = 'block';
            }).catch(err => {
                console.error("Failed to stop QR Code scanner.", err);
            });
        }

        function onScanError(error) {
            console.error(error);
        }

        const html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start({
                facingMode: "environment"
            }, // Use the back camera
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            onScanError
        );

        document.getElementById('scan-again-btn').addEventListener('click', function() {
            document.getElementById('voorwerp-details').style.display = 'none';
            document.getElementById('scan-again-btn').style.display = 'none';
            document.getElementById('qr-reader').style.display = 'block';
            html5QrCode.start({
                    facingMode: "environment"
                }, // Use the back camera
                {
                    fps: 10,
                    qrbox: 250
                },
                onScanSuccess,
                onScanError
            ).catch(err => {
                console.error("Failed to start QR Code scanner.", err);
            });
        });
    });
</script>

@endsection