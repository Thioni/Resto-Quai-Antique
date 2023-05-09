<?php

namespace App\Repository;

use App\Entity\Booking;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Booking>
 *
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function save(Booking $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Booking $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAvailableSeats(\DateTimeInterface $timeslot): int
    {
        $em = $this->getEntityManager();

        $endTime = DateTime::createFromFormat('Y-m-d H:i:s', $timeslot->format('Y-m-d H:i:s'))
            ->modify('+1 hour')
            ->format('Y-m-d H:i:s');

            dump($endTime);
    
        $query = $em->createQuery('
            SELECT SUM(b.seats)
            FROM App\Entity\Booking b
            WHERE b.timeslot >= :timeslot
            AND b.timeslot < :endTime
        ')
        ->setParameter('timeslot', $timeslot)
        ->setParameter('endTime', $endTime);
    
        $result = $query->getSingleScalarResult();
        $reservedSeats = (int) $result;
    
        // Le Nombre de places maximum dans le restaurant est de 90
        $availableSeats = 90 - $reservedSeats;
        dump($reservedSeats);
        return $availableSeats;
    }

//    /**
//     * @return Booking[] Returns an array of Booking objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Booking
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
