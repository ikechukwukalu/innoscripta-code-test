<?php

namespace App\Services;

use App\Actions\ResponseData;

class TheGuardianService extends NewsOutletService
{

    /**
     * Summary of authorization
     * @return array{apiKey: string}
     */
    public function authorization(): array
    {
        return [
            'apiKey' => '',
        ];
    }

    public function fetchArticles(): ResponseData
    {
        return responseData(true, 200, trans('general.success'));
    }
}
