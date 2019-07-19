<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Domain;

use App\Services\PrimaryDivision\Infrastructure\Dto\CreatePrimaryDivisionDto;
use App\Services\PrimaryDivision\Infrastructure\Dto\DeletePrimaryDivisionDto;

interface PrimaryDivisionServiceInterface
{
    public function create(CreatePrimaryDivisionDto $createDto);

    public function remove(DeletePrimaryDivisionDto $deletePrimaryDivisionDto);
}
