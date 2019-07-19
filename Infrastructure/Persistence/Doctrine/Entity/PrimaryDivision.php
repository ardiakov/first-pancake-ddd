<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Infrastructure\Persistence\Doctrine\Entity;

use App\Entity\City;
use App\Entity\Region;
use App\Entity\User\AbstractUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ruvents\RuworkBundle\Doctrine\Traits\CreationTimeTrait;

/**
 * @ORM\Entity()
 */
class PrimaryDivision
{
    use CreationTimeTrait;

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var null|string
     */
    private $codeNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region")
     *
     * @var null|Region
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City")
     *
     * @var null|City
     */
    private $city;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User\AbstractUser")
     *
     * @var Collection|AbstractUser[]
     */
    private $members;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User\AbstractUser")
     *
     * @var null|AbstractUser
     */
    private $author;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCodeNumber(): ?string
    {
        return $this->codeNumber;
    }

    public function setCodeNumber(?string $codeNumber)
    {
        $this->codeNumber = $codeNumber;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region)
    {
        $this->region = $region;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city)
    {
        $this->city = $city;

        return $this;
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function setMembers(Collection $members)
    {
        $this->members = $members;

        return $this;
    }

    public function getAuthor(): ?AbstractUser
    {
        return $this->author;
    }

    public function setAuthor(?AbstractUser $author)
    {
        $this->author = $author;

        return $this;
    }

    public function addMember(AbstractUser $user)
    {
        $this->members->add($user);

        return $this;
    }

    public function removeMember(AbstractUser $user)
    {
        $this->members->removeElement($user);

        return $this;
    }
}
