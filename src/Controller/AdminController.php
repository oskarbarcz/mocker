<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\ResourceType;
use App\Repository\ResourceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private ResourceRepository $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    /**
     * @Route("/")
     */
    public function redirectToAdmin(): Response
    {
        return $this->redirectToRoute('app_index');
    }

    /**
     * @Route("/admin/r/{slug}", name="app_index")
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

    /**
     * @Route("/admin/add-resource", name="app_add-resource")
     * @param Request $request
     * @return Response
     */
    public function addNewResource(Request $request): Response
    {
        $form = $this->createForm(ResourceType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render(
                'admin/new_resource.html.twig',
                [
                    'form'      => $form->createView(),
                    'resources' => $this->resourceRepository->findAll(),
                    'current'   => null,
                ]
            );
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($form->getData());
        return $this->redirectToRoute('app_index');
    }
}
