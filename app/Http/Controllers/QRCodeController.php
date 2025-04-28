<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function index(Request $request, $tid)
    {
        $url = config('app.url').'/menu-table/'.$tid;
        return QrCode::size(300)->generate($url);
    }
}
