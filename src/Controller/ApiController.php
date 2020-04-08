<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Resource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    /**
     * @Route("/api/{slug}", name="api_general")
     * @param Resource|null $resource
     * @return Response
     */
    public function readResource(Resource $resource = null): Response
    {
        if (!$resource instanceof Resource) {
            $message = ['code' => 404, 'message' => 'Not Found'];
            return new JsonResponse($message, Response::HTTP_NOT_FOUND);
        }

        $statusCode = $resource->getContent() === null ? Response::HTTP_NO_CONTENT : Response::HTTP_OK;
        return JsonResponse::fromJsonString($resource->getContent(), $statusCode);
    }
}
