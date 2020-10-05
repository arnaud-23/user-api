<?php

declare(strict_types=1);

namespace App\Controller\Api\Application;

use App\BusinessRules\Application\Requestors\RegisterApplicationRequest;
use App\BusinessRules\Application\Responders\ApplicationResponse;
use App\BusinessRules\Application\UseCases\RegisterApplication;
use App\Controller\Api\ResponseTrait;
use App\Controller\Api\ValidationRequestControllerTrait;
use App\Model\Application\PutApplicationModel;
use App\ViewModels\Application\ApplicationViewModel;
use App\ViewModels\ViewModelAssembler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class PostApplicationController
{
    use ResponseTrait;
    use ValidationRequestControllerTrait;

    private RegisterApplication $registerApplication;

    public function __construct(RegisterApplication $registerApplication)
    {
        $this->registerApplication = $registerApplication;
    }

    /**
     * @Route("/api/users/{uuid}/applications", methods={"POST"}, defaults={"oauth2_scopes":{"application"}})
     * @IsGranted("ROLE_USER")
     */
    public function post(Request $request, string $uuid): JsonResponse
    {
        /** @var PutApplicationModel $model */
        $model = $this->validateRequest($request, PutApplicationModel::class);
        $response = $this->registerApplication($model, $uuid);
        $vm = $this->buildVM($response);

        return $this->createCreatedResponse($vm);
    }

    private function registerApplication(PutApplicationModel $model, string $uuid): ApplicationResponse
    {
        return $this->registerApplication->execute(RegisterApplicationRequest::create($model->name, $uuid));
    }

    private function buildVM(ApplicationResponse $response): ApplicationViewModel
    {
        return ViewModelAssembler::create(ApplicationViewModel::class, $response);
    }
}
