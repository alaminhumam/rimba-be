<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends Resource
{
    /**
     * @var string
     */
    protected $code;

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'errors';

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @param  int    $statusCode
     * @param  string $message
     * @return void
     */
    public function __construct($resource, $statusCode = 500, $code = null)
    {
        $this->statusCode = $statusCode;

        if ($resource instanceof \Throwable) {
            if (config('app.debug') === true) {
                $msg = $resource->getMessage() ?: __('errors.generic');
                JsonResource::__construct([$msg]);
            } else {
                JsonResource::__construct([__('errors.generic')]);
            }

            if (method_exists($resource, 'getStatusCode')) {
                $this->statusCode = $resource->getStatusCode();
            }
        } elseif (is_string($resource)) {
            JsonResource::__construct([$resource]);
        } else {
            JsonResource::__construct($resource);
        }

        $this->code = $code ?? $this->buildErrorCode();
        $this->message = __('errors.'.$this->code);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => false,
            'code' => $this->code,
            'message' => $this->message,
        ];
    }

    /**
     * Convert error code from status code if it wasn't already present.
     *
     * @return string
     */
    protected function buildErrorCode()
    {
        if ($this->code) {
            return $this->code;
        }

        return 'ERR'.substr($this->statusCode, 0, 1).'0'.substr($this->statusCode, 1, 2);
    }
}
