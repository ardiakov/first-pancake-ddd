<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Domain;

interface PrimaryDivisionRepositoryInterface
{
    public function findById(int $id);

    public function remove(int $id);

    public function create(PrimaryDivision $primaryDivision);

    public function nextIdentity(): PrimaryDivisionId;
}
