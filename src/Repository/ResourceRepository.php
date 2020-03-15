<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Resource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Resource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resource[]    findAll()
 * @method Resource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function isSlugFree(?string $slug): bool
    {
        if ($slug === null) {
            return false;
        }

        return $this->count(['slug' => $slug]) === 0;
    }

    public function isSlugCurrent(?string $slug, int $id): bool
    {
        if ($slug === null) {
            return false;
        }

        return $this->count(['slug' => $slug, 'id' => $id]) === 1;
    }
}
