<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array
     */
    public $response = [
        'error' => false,
        'response_text' => 'Success',
        'response_body' => [],
    ];

    /**
     * Validate all input data
     *
     * @param $request
     * @param $validation_rules
     * @param array $messages
     *
     * @return bool
     */
    protected function validateRequest($request, $validation_rules, $messages = [])
    {
        $validator = $this->getValidationFactory()->make($request, $validation_rules, $messages);

        if ($validator->fails()) {
            $this->response['response_text'] = $validator->messages()->first();

            return false;
        }

        return true;
    }

    /**
     * @param null $message
     * @param int $status
     * @return mixed
     */
    protected function responseError($message = null, $status = 200)
    {
        $this->response['error'] = true;

        $response_text = $this->response['response_text'];
        if ($response_text === 'Success') {
            $response_text = $message ?: 'Invalid request';
        }
        $this->response['response_text'] = $response_text;

        return Response::json($this->response, $status);
    }
}
