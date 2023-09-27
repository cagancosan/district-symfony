<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorie>
 *
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function save(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMostPopularCategories(): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c, SUM(d.quantite) as total')
            ->join('c.plats', 'p')
            ->join('p.details', 'd')
            ->where('c.active = 1')
            ->groupBy('c.id')
            ->orderBy('total', 'DESC')
            ->addOrderBy('p.libelle', 'ASC')
            ->setMaxResults(6);

        $query = $qb->getQuery();
        return $query->execute();
    }

    public function searchCategorie($search): array
    {
        $search = '%' . $search . '%';
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.active = 1')
            ->andWhere('c.libelle LIKE :search')
            ->orderBy('c.libelle')
            ->setParameter('search', $search);
        $query = $qb->getQuery();
        return $query->execute();
    }

    public function countCategories(): int
    {
        $qb = $this->createQueryBuilder('c')
            ->select('COUNT(c)');
        $query = $qb->getQuery();
        return $query->getSingleScalarResult();
    }

    //    /**
    //     * @return Categorie[] Returns an array of Categorie objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Categorie
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

// SELECT c.*, SUM(c2.quantite) AS "Quantité commandée" FROM categorie c JOIN plat p ON c.id = p.id_categorie JOIN commande c2 ON c2.id_plat = p.id WHERE c.active = "Yes" AND c2.etat IN ("Livrée", "En préparation", "En cours de livraison") GROUP BY c.libelle ORDER BY `Quantité commandée` DESC, c.libelle