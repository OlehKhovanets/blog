<?php

namespace App\Traits;

trait Responsible
{
    public function response(int $code, string $processId, array $data)
    {
        return response()->json([
            'processId' => $processId,
            'serviceId' => config('app.serviceId'),
            'code' => $code,
            'data' => $data
        ]);
    }
}
