<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCodeScan;

class QrCodeScannerController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Menggunakan tampilan dashboard
    }

    public function scan(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        $code = $request->input('qr_code');

        // Periksa apakah QR code sudah ada di database
        $existingQrCode = QrCodeScan::where('code', $code)->first();
        if ($existingQrCode) {
            return redirect()->route('scanner')->with('error', 'QR Code has already been scanned.');
        }

        // Simpan QR code jika belum pernah di-scan
        $qrCodeScan = QrCodeScan::create([
            'code' => $code,
            'scanned' => true,
        ]);

        return redirect()->route('scanner')->with('success', 'QR Code scanned successfully!');
    }
}
