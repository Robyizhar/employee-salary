<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class APIController extends Controller {

    public function respond($data, $message = null, $status_code = 200, $extra = null) {

        $response['status'] = true;
        $response['status_code'] = $status_code;
        $response['message'] = $message;
        $response['extra'] = $extra;

        if (isset($data))
            $response['data'] = $data;

        return response()->json($response, $status_code);
    }

    public function respondWithError($message, $status_code = 400, $errors = null) {

        $response['status'] = false;
        $response['status_code'] = $status_code;
        $response['message'] = $message;

        if (isset($errors))
            $response['errors'] = $errors;

        return response()->json($response, $status_code);
    }

}
