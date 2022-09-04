<?php

namespace App\Controller;

use App\Entity\PresentationSubject;
use App\Entity\Subject;
use App\Entity\SubjectType;
use App\Grid\PresentationGridType;
use App\Grid\SubjectGridType;
use App\Repository\PresentationSubjectRepository;
use App\Repository\SubjectRepository;
use App\Repository\SubjectTypeRepository;
use Prezent\Grid\GridFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/subject', name: 'subject_')]
class SubjectController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SubjectTypeRepository $typeRepository): Response
    {
        $subjectTypes = $typeRepository->findAll();

        return $this->render('subject/index.html.twig', [
            'subject_types' => $subjectTypes,
        ]);
    }

    #[Route('/{slug}/list', name: 'list')]
    public function list(GridFactory $factory, SubjectType $subjectType): Response
    {
        $grid = $factory->createGrid(SubjectGridType::class);

        return $this->render('subject/list_type.html.twig', [
            'subject_type' => $subjectType,
            'subject_grid' => $grid->createView()
        ]);
    }

    #[Route('/{subject_type_slug}/show/{slug}', name: 'show')]
    public function show($subject_type_slug, Subject $subject): Response
    {

        return $this->render('subject/show.html.twig', [
            'subject' => $subject,
            'subject_type_slug' => $subject_type_slug,
        ]);
    }

}
