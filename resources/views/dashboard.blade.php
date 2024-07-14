<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        QR Code Scanner
                    </div>

                    <div class="mt-6 text-gray-500">
                        @if (session('success'))
                            <div style="background-color: #28a745; color: white; padding: 10px; border-radius: 5px;">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div style="background-color: #ff0000; color: white; padding: 10px; border-radius: 5px;">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div id="reader" width="600px" class="my-4"></div>
                        <form id="qr-form" action="{{ route('scanner.scan') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="qr_code" id="qr-code">
                            <button type="submit">Submit</button>
                        </form>

                        <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
                        <script>
                            function onScanSuccess(decodedText, decodedResult) {
                                document.getElementById('qr-code').value = decodedText;
                                document.getElementById('qr-form').submit();
                            }

                            function onScanFailure(error) {
                                console.warn(`QR error = ${error}`);
                            }

                            window.addEventListener('load', function() {
                                let html5QrcodeScanner = new Html5QrcodeScanner(
                                    "reader", { fps: 10, qrbox: 250 });
                                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
