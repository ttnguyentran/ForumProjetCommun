<?php

namespace App\Repository;

use App\Entity\Thread;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Thread|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thread|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thread[]    findAll()
 * @method Thread[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thread::class);
    }
	
	public function getPubBySearching($search){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM thread WHERE thread LIKE \'%'. $search . '%\' OR content LIKE \'%'. $search . '%\'';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
	
	public function searchThreadByUserId($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM thread WHERE user_id = '. $id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
	
	public function deleteThread($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'DELETE FROM thread WHERE id = '. $id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}