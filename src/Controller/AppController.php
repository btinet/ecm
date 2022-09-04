<?php

namespace App\Controller;

use App\Grid\PresentationGridType;
use App\Repository\PresentationScheduleRepository;
use Prezent\Grid\GridFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
class AppController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(GridFactory $factory, PresentationScheduleRepository $scheduleRepository, Request $request): Response
    {

        if($sortBy = $request->query->get('sort_by') and $sortOrder = $request->query->get('sort_order'))
        {
            $presentations = $scheduleRepository->findBy([],[
                $sortBy => $sortOrder
            ]);
        } else {
            $presentations = $scheduleRepository->findAll();
        }

        $grid = $factory->createGrid(PresentationGridType::class);

        return $this->render('app/index.html.twig', [
            'presentations' => $presentations,
            'grid' => $grid->createView()
        ]);
    }
}
