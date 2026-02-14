<?php

declare(strict_types=1);

namespace App\Entities;

class ResponseJsend
{
    private string $status;
    private array $data;
    private ?string $message;
    private ?int $code;

    public function __construct(
        array $data = [],
        string $status = 'success',
        ?string $message = null,
        ?int $code = null
    ) {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
        $this->code = $code;
    }

    public function toArray(): array
    {
        $response = [
            'status' => $this->status,
            'data' => $this->data,
        ];

        if ($this->message !== null) {
            $response['message'] = $this->message;
        }

        if ($this->code !== null) {
            $response['code'] = $this->code;
        }

        return $response;
    }
}