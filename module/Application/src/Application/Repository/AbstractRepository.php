<?php
namespace Application\Repository;


class AbstractRepository extends \Doctrine\ORM\EntityRepository
{


    public function save($entity)
    {
        $this->getEntityManager()->persist($entity);
    }

    public function update($entity)
    {
        $this->getEntityManager()->merge($entity);
    }

    public function delete($entity)
    {
        $this->getEntityManager()->remove($entity);
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    public function refresh($entity)
    {
        $this->getEntityManager()->refresh($entity);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function entityManager()
    {
        return $this->getEntityManager();
    }

    protected function calcOffset($pageNo, $limit)
    {
        return (($pageNo - 1) * $limit);
    }
} 