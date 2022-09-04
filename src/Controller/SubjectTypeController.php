<?php

namespace App\Controller;

use App\Repository\SubjectRepository;
use App\Repository\SubjectTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/subject_type', name: 'subject_type_')]
class SubjectTypeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SubjectTypeRepository $typeRepository): Response
    {
        $subjectTypes = $typeRepository->findAll();

        return $this->render('subject/index.html.twig', [
            'subject_types' => $subjectTypes,
        ]);
    }
}
