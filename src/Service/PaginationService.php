<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class PaginationService
{
    private $entityClass;
    private $limit = 9;
    private $currentPage = 1;
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function getPages()
    {
        $repository = $this->manager->getRepository($this->entityClass);
        $total = count($repository->findAll());

        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData()
    {
        $offset = ($this->currentPage - 1) * $this->limit;
        $repository = $this->manager->getRepository($this->entityClass);
        $data = $repository->findBy([], [], $this->limit, $offset);
        
        return $data;
    }

    public function setPage($page)
    {
        $this->currentPage = $page;

        return $this;
    }

    public function getPage()
    {
        return $this->currentPage;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }
    
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }
    
    public function getEntityClass()
    {
        return $this->entityClass;
    }
}