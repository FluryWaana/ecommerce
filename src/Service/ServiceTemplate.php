<?php

namespace App\Service;

use App\Entity\ArticleCategorie;
use App\Repository\ArticleCategorieRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceTemplate
{
    /**
     * @var ArticleCategorieRepository
     */
    private $repository;

    /**
     * ServiceTemplate constructor.
     * @param ArticleCategorieRepository $repository
     */
    public function __construct(ArticleCategorieRepository $repository)
    {
        $this->repository = $repository;
    }

    //------------------------------------------------------------------------

    /**
     * @return ArticleCategorie[]|object[]
     * @throws \Exception
     */
    public function getCategories()
    {
        return $this->repository->findBy(['articleCategorie' => null]);
    }
}