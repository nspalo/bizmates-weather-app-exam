<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class Resource extends JsonResource
{
    /**
     * Return this resource as an array
     *
     * @noinspection PhpMissingParentCallCommonInspection
     *
     * @param Request $request
     *
     * @return string[]
     */
    public function toArray($request): array
    {
        return $this->getResponse();
    }

    abstract public function getResponse(): array;
}
