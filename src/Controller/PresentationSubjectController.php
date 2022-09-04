<?php

namespace App\Controller;

use App\Entity\PresentationSchedule;
use App\Entity\PresentationSubject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/presentation/subject', name: 'presentation_subject_')]
class PresentationSubjectController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('presentation_subject/index.html.twig', [
            'controller_name' => 'PresentationSubjectController',
        ]);
    }

    #[Route('/{slug}/show', name: 'show')]
    public function show(PresentationSchedule    $subject): Response
    {
        return $this->render('presentation_subject/show.html.twig', [
            'subject' => $subject
        ]);
    }
}
