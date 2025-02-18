<?php

namespace App\Contracts;

interface FrontendApp
{

    /**
     * Get frontend app url.
     *
     * @return string
     */
    public function url(): string;
}
