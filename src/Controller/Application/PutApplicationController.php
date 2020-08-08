<?php

declare(strict_types=1);

namespace App\Controller\Application;

use App\BusinessRules\Application\Requestors\RegisterApplicationRequest;
use App\BusinessRules\Application\UseCases\RegisterApplication;
use App\Controller\ResponseTrait;
use App\Controller\ValidationRequestControllerTrait;
use App\Model\Application\PutApplicationModel;
use App\ViewModels\Application\ApplicationViewModel;
use App\ViewModels\ViewModelAssembler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class PutApplicationController extends AbstractController
{
    use ResponseTrait;
    use ValidationRequestControllerTrait;

    private RegisterApplication $registerApplication;

    public function __construct(RegisterApplication $registerApplication)
    {
        $this->registerApplication = $registerApplication;
    }

    /**
     * @Route("/api/applications", methods={"PUT"}, defaults={"oauth2_scopes":{"application"}})
     * @IsGranted("ROLE_USER")
     */
    public function post(Request $request): JsonResponse
    {
        /** @var PutApplicationModel $model */
        $model = $this->validateRequest($request, PutApplicationModel::class);

        $response = $this->registerApplication->execute(
            RegisterApplicationRequest::create($model->name, $this->getUser()->getId())
        );

        return $this->createCreatedResponse(null, ViewModelAssembler::create(ApplicationViewModel::class, $response));
    }
}
