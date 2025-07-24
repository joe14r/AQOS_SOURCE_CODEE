<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class QRCodeController
 *
 * This controller handles the generation of QR codes for specific table IDs.
 * It uses the SimpleSoftwareIO\QrCode package to generate QR codes dynamically.
 *
 * @package App\Http\Controllers
 */
class QRCodeController extends Controller
{
    /**
     * Generate a QR code for a given table ID.
     *
     * This method constructs a URL using the application's base URL and the provided table ID,
     * then generates a QR code for that URL.
     *
     * @param Request $request The HTTP request instance.
     * @param string $tid The table ID for which the QR code is generated.
     * @return \Illuminate\Http\Response A response containing the generated QR code.
     */
    public function index(Request $request, $tid)
    {
        // Construct the URL for the table menu.
        $url = config('app.url').'/menu-table/'.$tid;

        // Generate and return the QR code as a response.
        return QrCode::size(300)->generate($url);
    }
}
