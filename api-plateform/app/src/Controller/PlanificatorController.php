<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Planificator;
use App\Service\PlanificatorCallerService;
use App\Service\StoredVideoCallerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class PlanificatorController extends AbstractController
{
    private $planificatorCallerService;
    private $storedVideoCallerService;

    public function __construct(PlanificatorCallerService $planificatorCallerService, StoredVideoCallerService $storedVideoCallerService)
    {
        $this->planificatorCallerService = $planificatorCallerService;
        $this->storedVideoCallerService = $storedVideoCallerService;
    }

    public function __invoke(Planificator $data): Planificator
    {
        //Update ms planification
        // if -> data -> valid -> data de download [VideoId, dataId
//        dd($data);
        $this->planificatorCallerService->updatePlanificator($data);
        $this->storedVideoCallerService->createStoredVideo([["videoId" => $data->getYoutubeSlug(),
                                                            "dateOfUpload" => $data->getDateOfUpload()]]);
        return $data;
    }
}