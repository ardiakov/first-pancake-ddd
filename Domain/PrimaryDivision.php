<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Domain;

use App\Services\PrimaryDivision\Domain\Exception\UserAlreadyConsistInDivisionException;
use App\Services\PrimaryDivision\Domain\Exception\UserNotConsistInDivisionException;

class PrimaryDivision
{
    /**
     * @var PrimaryDivisionId
     */
    private $id;

    private $codeNumber;

    private $geo;

    private $companyName;

    private $members = [];

    private $author;

    private function __construct(PrimaryDivisionId $divisionId, string $codeNumber, Geo $geo, string $companyName, User $user)
    {
        $this->id = $divisionId;
        $this->codeNumber = $codeNumber;
        $this->geo = $geo;
        $this->companyName = $companyName;
        $this->author = $user;

        $this->addMember($user);
    }

    public static function create(PrimaryDivisionId $id, string $codeNumber, Geo $geo, string $companyName, User $user)
    {
        return new self($id, $codeNumber, $geo, $companyName, $user);
    }

    public function getCodeNumber(): string
    {
        return $this->codeNumber;
    }

    public function getGeo(): Geo
    {
        return $this->geo;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @param User $user
     *
     * @throws UserAlreadyConsistInDivisionException
     */
    public function addMember(User $user): void
    {
        if (in_array($user->getId(), $this->members)) {
            throw new UserAlreadyConsistInDivisionException();
        }

        $this->members[] = $user->getId();
    }

    /**
     * @param User $user
     *
     * @throws UserNotConsistInDivisionException
     */
    public function removeMember(User $user): void
    {
        if (!in_array($user->getId(), $this->members)) {
            throw new UserNotConsistInDivisionException();
        }

        if (($key = array_search($user->getId(), $this->members)) !== false) {
            unset($this->members[$key]);
        }
    }

    public function getId(): PrimaryDivisionId
    {
        return $this->id;
    }

    public function getMembers(): array
    {
        return $this->members;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }
}
