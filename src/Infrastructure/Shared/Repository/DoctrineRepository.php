<?php

namespace App\Infrastructure\Shared\Repository;

use Doctrine\ORM\Query;
use Pagerfanta\Pagerfanta;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;

abstract class DoctrineRepository
{
    private ?EntityRepository $repository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->repository = null;
        $this->entityManager = $entityManager;
    }

    protected function getRepository(): EntityRepository
    {
        if (null === $this->repository) {
            /** @var EntityRepository $repository */
            $repository = $this->entityManager->getRepository(
                $this->getRepositoryName()
            );

            $this->repository = $repository;
        }

        return $this->repository;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function findPaginated(
        Query $query,
        ?int $pageNumber = null,
        ?int $rowsPerPage = null
    ): Pagerfanta {
        $doctrineAdapter = new QueryAdapter($query);
        $pagination = new Pagerfanta($doctrineAdapter);

        if (null !== $rowsPerPage) {
            $pagination->setMaxPerPage($rowsPerPage);
        }

        if (null !== $pageNumber) {
            $pagination->setCurrentPage($pageNumber);
        }

        return $pagination;
    }

    abstract protected function getRepositoryName(): string;
}