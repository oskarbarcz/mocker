<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private ResourceRepository $resourceRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/{slug}", name="app_index")
     * @param string|null $slug
     * @return Response
     */
    public function index(string $slug = null): Response
    {
        $currentResource = ($slug !== null) ? $this->resourceRepository->findOneBy(['slug' => $slug]) : null;

        return $this->render(
            'admin/admin.html.twig',
            [
                'resources' => $this->resourceRepository->findAll(),
                'current'   => $currentResource,
            ]
        );
    }
}
