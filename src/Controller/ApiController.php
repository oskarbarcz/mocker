<?php declare(strict_types=1);

namespace App\Controller;

use App\Exception\FileNotFoundException;
use App\Service\JsonFileLoader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    private JsonFileLoader $fileLoader;

    public function __construct(JsonFileLoader $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    /**
     * @Route("/api/{filename}")
     * @param string $filename
     * @return Response
     */
    public function readFromFile(string $filename): Response
    {
        try {
            $json = $this->fileLoader->load($filename);
            return JsonResponse::fromJsonString($json);
        } catch (FileNotFoundException $e) {
            return new JsonResponse(['code' => 404, 'message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
