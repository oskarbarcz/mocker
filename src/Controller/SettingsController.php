<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Configuration;
use App\Form\ImportType;
use App\Service\ConfigurationManager;
use App\Service\ExportManager;
use App\Service\ImportManager;
use App\Service\UploadManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends AbstractController
{
    private ConfigurationManager $configurationManager;
    private ExportManager $exportManager;
    private ImportManager $importManager;

    public function __construct(
        ConfigurationManager $configurationManager,
        ExportManager $exportManager,
        ImportManager $importManager
    ) {
        $this->configurationManager = $configurationManager;
        $this->exportManager = $exportManager;
        $this->importManager = $importManager;
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
            $file = $form->get('file')->getData();
            $this->importManager->import($file);
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
     * @return Response
     */
    public function createExport()
    {
        $file = $this->exportManager->export();

        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
        return $response;
    }
}
