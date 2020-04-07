<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Configuration;
use App\Service\ConfigurationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("admin/settings/set-theme/{themeName}")
     * @param string $themeName
     * @return Response
     */
    public function changeTheme(string $themeName): Response
    {
        $configuration = new Configuration();
        $configuration->setTheme($themeName);

        $this->configurationManager->set($configuration);
        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
