<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Configuration;
use App\Service\ConfigurationManager;
use App\Service\ExportManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends AbstractController
{
    private ConfigurationManager $configurationManager;

    public function __construct(ConfigurationManager $configurationManager)
    {
        $this->configurationManager = $configurationManager;
    }

    /**
     * @Route("admin/settings", name="app_settings")
     */
    public function index(): Response
    {
        return $this->render('admin/settings.html.twig');
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
