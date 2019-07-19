<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Infrastructure\Dto;

use Symfony\Component\HttpFoundation\Request;

class DeletePrimaryDivisionDto
{
    private $id;

    public function __construct(Request $request)
    {
        $this->id = $request->get('id');
    }

    public function getId()
    {
        return $this->id;
    }
}
