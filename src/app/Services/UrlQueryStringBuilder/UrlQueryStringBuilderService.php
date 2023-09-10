<?php

declare(strict_types=1);

namespace App\Services\UrlQueryStringBuilder;

use App\Services\UrlQueryStringBuilder\Interfaces\UrlQueryStringBuilderServiceInterface;

class UrlQueryStringBuilderService implements UrlQueryStringBuilderServiceInterface
{
    /**
     * @param array $queryParam
     * @return string
     */
    public function build(array $queryParam): string
    {
        return implode(
            '&',
            array_map(
                static function ($key, $value) {
                    return $key . '=' . $value;
                },
                array_keys($queryParam),
                $queryParam
            )
        );
    }
}
