<?php

declare(strict_types=1);

namespace App\Services\UrlQueryStringBuilder\Interfaces;

interface UrlQueryStringBuilderServiceInterface
{
    public function build(array $queryParam): string;
}
