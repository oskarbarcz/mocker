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
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig', ['resources' => $this->resourceRepository->findAll()]);
    }
}
