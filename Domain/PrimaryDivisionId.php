<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Domain;

class PrimaryDivisionId
{
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function create(string $id): PrimaryDivisionId
    {
        return new self($id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
