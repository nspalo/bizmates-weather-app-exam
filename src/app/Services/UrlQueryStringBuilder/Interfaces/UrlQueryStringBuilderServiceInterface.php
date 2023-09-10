<?php

declare(strict_types=1);

namespace App\Services\UrlQueryStringBuilder\Interfaces;

interface UrlQueryStringBuilderServiceInterface
{
    /**
     * @param array $queryParam
     * @return string
     */
    public function build(array $queryParam): string;
}
