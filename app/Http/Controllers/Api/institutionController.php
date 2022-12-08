<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class institutionController extends Controller
{
    public function index(){
        $institutions = Institution::latest()->paginate(4);
    return response()->json([
        'message' => 'Categories in Successfuly', 'data' => $institutions
    ], Response::HTTP_OK);
    }
}
