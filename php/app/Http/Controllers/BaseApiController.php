<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BaseContract;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseApiController extends Controller
{
    const RESPONSE_STATUS_OK = 200;
    const RESPONSE_STATUS_ERROR = 400;

    protected $repository, $modelResource, $relations = [], $statusCode;

    /**
     * BaseApiController constructor.
     *
     * @param BaseContract $repository
     * @param string $modelResource
     */
    public function __construct(BaseContract $repository, $modelResource = JsonResource::class)
    {
        $this->repository = $repository;
        $this->modelResource = $modelResource;

        // Include embedded data
        if (request()->has('embed')) {
            $this->parseIncludes(request('embed'));
        }
    }

    /**
     * index() Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $page = 1;
        $limit = 0;
        $order = false;
        $filters = request()->all();

        if (request()->has('page')) {
            $page = request('page');
        }

        if (request()->has('limit')) {
            $limit = request('limit');
        }

        if (request()->has('order')) {
            $order = request('order');
        }

        $models = $this->repository->search($filters, $this->relations, $order, $page, $limit);

//        if ($models->count() == 1) {
//            return $this->respondWithModel($models->first());
//        }

        return $this->respondWithCollection($models);
    }

    /**
     * parseIncludes() used to explode embed relations array
     *
     * @param $embed
     */
    protected function parseIncludes($embed)
    {
        $this->relations = explode(',', $embed);
    }

    /**
     * setStatusCode() set status code value
     *
     * @param $statusCode
     * @return $this
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * getStatusCode() return status code value
     *
     * @return int
     */
    protected function getStatusCode()
    {
        return $this->statusCode ?: self::RESPONSE_STATUS_OK;
    }

    /**
     * respond() used to return resource with status and headers
     *
     * @param $resources
     * @param array $headers
     * @return mixed
     */
    protected function respond($resources, $headers = [])
    {
        return $resources
            ->additional(['status' => $this->getStatusCode()])
            ->response()
            ->setStatusCode($this->getStatusCode())
            ->withHeaders($headers);
    }

    /**
     * respondWithArray() used to return json response array with status and headers
     *
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithArray($data, $headers = [])
    {
        return response()->json($data, $data['status'], $headers);
    }

    /**
     * respondWithCollection() used to take collection
     * and return its data transformed by resource response
     *
     * @param $collection
     * @param int|null $statusCode
     * @param array $headers
     * @return mixed
     */
    protected function respondWithCollection($collection, int $statusCode = null, array $headers = [])
    {
        $statusCode = $statusCode ?? self::RESPONSE_STATUS_OK;

        $resources = forward_static_call([$this->modelResource, 'collection'], $collection);

        return $this->setStatusCode($statusCode)->respond($resources, $headers);
    }


    /**
     * respondWithModel() used to return result with one model relation
     *
     * @param $model
     * @param int|null $statusCode
     * @param array $headers
     * @return mixed
     */
    protected function respondWithModel($model, int $statusCode = null, array $headers = [])
    {
        $statusCode = $statusCode ?? self::RESPONSE_STATUS_OK;

        $resource = new $this->modelResource($model); // ???

        return $this->setStatusCode($statusCode)->respond($resource, $headers);
    }


    /**
     * respondWithSuccess() used to return success message
     *
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithSuccess($message = null, $data = [])
    {
        $response = [
            'status' => self::RESPONSE_STATUS_OK,
        ];

        $response['message'] = !empty($message) ? $message : __('Success');

        if (!empty($data)) $response['data'] = $data;

        return $this->setStatusCode(self::RESPONSE_STATUS_OK)->respondWithArray($response);
    }


    /**
     * respondWithError() used to return error message
     *
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError($message)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }
        return $this->respondWithErrors($message, $this->statusCode);
    }


    /**
     * respondWithErrors()
     *
     * @param string $errors
     * @param null $statusCode
     * @param array $data
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithErrors($errors = 'messages.error', $statusCode = null,
                                         $data = [], $message = null)
    {
        $statusCode = !empty($statusCode) ? $statusCode : self::RESPONSE_STATUS_ERROR;

        if (is_string($errors)) $errors = __($errors);

//        $response = ['status' => $statusCode, 'errors' => $errors];
        $response = ['status' => $statusCode,'message' => $message, 'errors' => ['message' => [$errors]]];

        if (!empty($message)) $response['message'] = $message;

        if (!empty($data)) $response['data'] = $data;

        return $this->setStatusCode($statusCode)->respondWithArray($response);
    }

    /**
     * respondWithBoolean() used to determine if process success or failed
     *
     * @param $result
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithBoolean($result)
    {
        return $result ? $this->respondWithSuccess() : $this->errorUnknown();
    }

    /**
     * **************************************************************************
     *                           Response Status Helpers
     * **************************************************************************
     */

    /**
     * errorWrongArgs() Generates a Response with a 400 HTTP header and a given message.
     *
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorWrongArgs($message = null)
    {
        if (empty($message)) $message = __('Wrong Arguments');
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * errorUnauthorized() Generates a Response with a 401 HTTP header and a given message.
     *
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorUnauthorized($message = null)
    {
        if (empty($message)) $message = __('Unauthorized');
        return $this->respondWithErrors($message,401);
    }

    /**
     * errorForbidden() Generates a Response with a 403 HTTP header and a given message.
     *
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorForbidden($message = null)
    {
        if (empty($message)) $message = __('Forbidden');
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * errorNotFound() Generates a Response with a 404 HTTP header and a given message.
     *
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorNotFound($message = null)
    {
        if (empty($message)) $message = __('Not Found');
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * errorInternalError() Generates a Response with a 500 HTTP header and a given message.
     *
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorInternalError($message = null)
    {
        if (empty($message)) $message = __('Internal Server Error');
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * errorUnknown() Generates a Response with a 500 HTTP header and a given message.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorUnknown($message = 'dashboard.unknown_error')
    {
        if (empty($message)) $message = __('Unknown Error');
        return $this->setStatusCode(500)->respondWithError($message);
    }
}
