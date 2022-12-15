<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $response;
    private $logResponse;

    const RESPONSE_200 = 'OK';
	const RESPONSE_201 = 'Resource Created';
	const RESPONSE_400 = 'Bad Request';
	const RESPONSE_401 = 'Not Authorized';
	const RESPONSE_404 = 'Resource Not Found';
	const RESPONSE_409 = 'Conflicted Resource';
	const RESPONSE_500 = 'Internal Server Error';

    public function __construct() {
        $this->logResponse = new Logger('API-Response');
        $handler = new StreamHandler(base_path() . '/storage/logs/api-response.log');
        $handler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message% %context%\n"));
        $this->logResponse->pushHandler($handler);
    }

    public function respond($data = [], $message = RESPONSE_200, $status_code = 200, $extra = null) {

        $response['status'] = true;
        $response['status_code'] = $status_code;
        $response['message'] = $message;
        $response['extra'] = $extra;

        if (isset($data))
            $response['data'] = $data;

        return response()->json($response, $status_code);
    }

    public function respondWithError($message = RESPONSE_400, $status_code = 400, $errors = null) {

        $response['status'] = false;
        $response['status_code'] = $status_code;
        $response['message'] = $message;

        if (isset($errors))
            $response['errors'] = $errors;

        return response()->json($response, $status_code);
    }

    public function success($message = RESPONSE_200, $code = 200, $results = []) {
        $response = [
            'status' => true,
            'message' => $message
        ];

        if(!empty($results))
            $response['results'] = $results;

        return response()->json($response, $code);
    }

    public function respondNotFound($message = RESPONSE_404, $code = 500, $errors = null) {
        return $this->respondWithError($message, $code, $errors);
    }
}
