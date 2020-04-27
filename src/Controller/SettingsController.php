<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Configuration;
use App\Form\ImportType;
use App\Service\ConfigurationManager;
use App\Service\ExportManager;
use App\Service\UploadManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

use function dd;

class SettingsController extends AbstractController
{
    private ConfigurationManager $configurationManager;

    public function __construct(ConfigurationManager $configurationManager)
    {
        $this->configurationManager = $configurationManager;
    }

    /**
     * @Route("admin/settings", name="app_settings")
     * @param Request       $request
     * @param UploadManager $uploadManager
     *
     * @return Response
     */
    public function index(Request $request, UploadManager $uploadManager): Response
    {
        $form = $this->createForm(ImportType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            $content = file_get_contents($file->getPathname());

            dd($content);
        }

        return $this->render('admin/settings.html.twig', ['importForm' => $form->createView()]);
    }

    /**
     * @Route("admin/settings/set-theme/{themeName}", name="app_settings_theme-change")
     * @param string $themeName
     *
     * @return Response
     */
    public function changeTheme(string $themeName): Response
    {
        $configuration = new Configuration();
        $configuration->setTheme($themeName);

        $this->configurationManager->set($configuration);
        return $this->redirectToRoute('app_settings');
    }

    /**
     * @Route("admin/export", name="app_settings_export-create")
     * @param ExportManager $manager
     *
     * @return Response
     */
    public function createExport(ExportManager $manager)
    {
        $file = $manager->export();

        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
        return $response;
    }
}
