<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Infrastructure\Persistence\Doctrine\Repository;

use App\Entity\User\AbstractUser;
use App\Services\PrimaryDivision\Domain\PrimaryDivision as DomainPrimaryDivision;
use App\Services\PrimaryDivision\Domain\PrimaryDivisionId;
use App\Services\PrimaryDivision\Domain\PrimaryDivisionRepositoryInterface;
use App\Services\PrimaryDivision\Infrastructure\Persistence\Doctrine\Entity\PrimaryDivision;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class PrimaryDivisionRepository implements PrimaryDivisionRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findById(int $id)
    {
        return $this->entityManager->find(PrimaryDivision::class, $id);
    }

    public function remove(int $id)
    {
        $primaryDivision = $this->findById($id);

        if (null === $primaryDivision) {
            throw new EntityNotFoundException();
        }

        $this->entityManager->remove($primaryDivision);
    }

    public function create(DomainPrimaryDivision $domainPrimaryDivision)
    {
        $author = $this->entityManager->getRepository(AbstractUser::class)->findOneBy(['id' => $domainPrimaryDivision->getAuthor()->getId()]);
        $primaryDivision = new PrimaryDivision();
        $primaryDivision
            ->setId($domainPrimaryDivision->getId()->getId())
            ->setRegion($domainPrimaryDivision->getGeo()->getRegion())
            ->setCity($domainPrimaryDivision->getGeo()->getCity())
            ->setAuthor($author)
            ->setCodeNumber($domainPrimaryDivision->getCodeNumber());

        foreach ($domainPrimaryDivision->getMembers() as $memberId) {
            $member = $this->entityManager->getRepository(AbstractUser::class)->findOneBy(['id' => $memberId]);
            $primaryDivision->addMember($member);
        }

        $this->entityManager->persist($primaryDivision);
        $this->entityManager->flush();
    }

    public function nextIdentity(): PrimaryDivisionId
    {
        return PrimaryDivisionId::create((string)Uuid::uuid4());
    }
}
