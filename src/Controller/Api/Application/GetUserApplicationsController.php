<?php

declare(strict_types=1);

namespace App\Controller\Api\Application;

use App\BusinessRules\Application\Requestors\GetUserApplicationsRequest;
use App\BusinessRules\Application\Responders\ApplicationsResponse;
use App\BusinessRules\Application\UseCases\GetUserApplications;
use App\Controller\Api\ResponseTrait;
use App\ViewModels\Application\ApplicationViewModel;
use App\ViewModels\ViewModelAssembler;
use App\ViewModels\ViewModelCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetUserApplicationsController
{
    use ResponseTrait;

    private GetUserApplications $getUserApplications;

    public function __construct(GetUserApplications $getUserApplications)
    {
        $this->getUserApplications = $getUserApplications;
    }

    /**
     * @Route("/api/users/{uuid}/applications", methods={"GET"}, defaults={"oauth2_scopes":{"application"}})
     * @IsGranted("ROLE_USER")
     */
    public function get(string $uuid): JsonResponse
    {
        $response = $this->getApplications($uuid);
        $vm = $this->buildVM($response);

        return $this->createJsonResponse($vm);
    }

    private function getApplications(string $uuid): ApplicationsResponse
    {
        return $this->getUserApplications->execute(GetUserApplicationsRequest::create($uuid));
    }

    private function buildVM(ApplicationsResponse $response): ViewModelCollection
    {
        return ViewModelAssembler::createCollection(ApplicationViewModel::class, $response->getApplications());
    }
}
