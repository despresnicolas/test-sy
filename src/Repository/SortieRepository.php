<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Curl\User;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<Sortie>
 *
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    /**
     * @param Sortie $entity
     * @param bool $flush
     * @return void
     */
    public function add(
        Sortie $entity,
        bool   $flush = false
    ): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Sortie $entity
     * @param bool $flush
     * @return void
     */
    public function remove(
        Sortie $entity,
        bool   $flush = false
    ): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Sortie[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('sortie');

        $query->addSelect('sortie')
            ->leftJoin('sortie.siteOrganisateur', 'campus')
            ->addSelect('campus')
            ->leftJoin('sortie.lieu', 'lieu')
            ->addSelect('lieu')
            ->leftJoin('sortie.organisateur', 'organisateur')
            ->addSelect('organisateur');


        if (!empty($search->textQuery)) {
            $query
                ->andWhere('sortie.nom LIKE :q')
                ->setParameter('q', "%{$search->textQuery}%");
        }

        if (!empty($search->dateDebut)) {
            $query
                ->andWhere('sortie.dateHeureDebut >= :dateDebut')
                ->setParameter('dateDebut', $search->dateDebut);
        }

        if (!empty($search->dateFin)) {
            $query
                ->andWhere('sortie.dateHeureDebut <= :dateFin')
                ->setParameter('dateFin', $search->dateFin);
        }

//        if (!empty($search->)) {
//            $query
//                ->andWhere('sortie.etat != :')
//                ->setParameter('passees', new \DateTime('now'));
//        }


        $result = $query->getQuery();
        return $result->getResult();

    }
}
