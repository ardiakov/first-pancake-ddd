<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Infrastructure\Service;

use App\Services\PrimaryDivision\Domain\Geo;
use App\Services\PrimaryDivision\Domain\PrimaryDivision;
use App\Services\PrimaryDivision\Domain\PrimaryDivisionRepositoryInterface;
use App\Services\PrimaryDivision\Domain\PrimaryDivisionServiceInterface;
use App\Services\PrimaryDivision\Domain\User;
use App\Services\PrimaryDivision\Infrastructure\Dto\CreatePrimaryDivisionDto;
use App\Services\PrimaryDivision\Infrastructure\Dto\DeletePrimaryDivisionDto;

final class PrimaryDivisionService implements PrimaryDivisionServiceInterface
{
    /**
     * @var PrimaryDivisionRepositoryInterface
     */
    private $repository;

    public function __construct(PrimaryDivisionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreatePrimaryDivisionDto $createDto)
    {
        $primaryDivision = PrimaryDivision::create(
            $this->repository->nextIdentity(),
            $createDto->getCodeNumber(),
            new Geo($createDto->getRegion(), $createDto->getCity()),
            $createDto->getCompanyName(),
            new User($createDto->getAuthor()->getId())
        );

        $this->repository->create($primaryDivision);
    }

    public function remove(DeletePrimaryDivisionDto $deletePrimaryDivisionDto)
    {
        $this->repository->remove($deletePrimaryDivisionDto->getId());
    }
}
