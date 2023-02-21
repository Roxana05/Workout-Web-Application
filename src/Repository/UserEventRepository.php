<?php

namespace App\Repository;

use App\Entity\Achievement;
use App\Entity\User;
use App\Entity\UserEvent;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserEvent>
 *
 * @method UserEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEvent[]    findAll()
 * @method UserEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEvent::class);
    }

    public function getUserEventsForUserForDate(User $user, string $date): array
    {
        $queryBuilder = $this->createQueryBuilder('ue');
        $queryBuilder->select('ue, e')
            ->leftjoin('ue.event', 'e')
            ->andWhere('ue.user = :user')
            ->orderBy('ue.createdAt', 'DESC');

        $queryBuilder->setParameter('user', $user);
        $query = $queryBuilder->getQuery();

        $result = $query->getResult();
        $returnArray = [];

        foreach ($result as $item)
        {
            $newDate = $item->getExerciseDate()->format('Y-m-d');
            if ($newDate === $date)
                array_push($returnArray, $item);
        }
        return $returnArray;
    }

    public function getUserEventsForUser(User $user): array
    {
        $queryBuilder = $this->createQueryBuilder('ue');
        $queryBuilder->select('ue, e')
            ->leftjoin('ue.event', 'e')
            ->andWhere('ue.user = :user')
            ->orderBy('ue.exerciseDate', 'DESC');

        $queryBuilder->setParameter('user', $user);
        $query = $queryBuilder->getQuery();

        $result = $query->getResult();
        $returnArray = [];

        foreach ($result as $item)
        {
            $returnArray[$item->getId()] = $item;
        }
        return $returnArray;
    }
}
