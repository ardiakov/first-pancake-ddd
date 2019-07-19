<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Infrastructure\Dto;

use App\Entity\City;
use App\Entity\Region;
use App\Entity\User\AbstractUser;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePrimaryDivisionDto
{
    /**
     * @Assert\NotBlank()
     */
    private $codeNumber;

    /**
     * @Assert\NotNull()
     */
    private $region;

    /**
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @Assert\NotBlank()
     */
    private $companyName;

    /**
     * @Assert\NotBlank()
     */
    private $author;

    public function __construct(AbstractUser $user)
    {
        $this->author = $user;
    }

    public function getCodeNumber()
    {
        return $this->codeNumber;
    }

    public function setCodeNumber(?string $codeNumber)
    {
        $this->codeNumber = $codeNumber;

        return $this;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion(?Region $region)
    {
        $this->region = $region;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(?City $city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getAuthor(): AbstractUser
    {
        return $this->author;
    }

    public function setAuthor(?AbstractUser $author)
    {
        $this->author = $author;

        return $this;
    }
}
