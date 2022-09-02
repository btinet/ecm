<?php

namespace App\Controller\Admin;

use App\Entity\PresentationSchedule;
use App\Entity\PresentationSubject;
use App\Entity\PresentationType;
use App\Entity\Subject;
use App\Entity\SubjectType;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        $test = [
            [
                'label' => 'Hauptfach',
                'description' => 'Das nimmst du als erstes.'
            ],
            [
                'label' => 'Referenzfach',
                'description' => 'Darauf beziehst du dich.'
            ],
        ];

        return $this->render('admin/dashboard.html.twig',[
            'test' => $test
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Treptow Kolleg - PKM');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Restricted Subjects','fas fa-school');
        yield MenuItem::linkToCrud('Presentation Schedule', 'fas fa-calendar', PresentationSchedule::class);

        yield MenuItem::section('Subjects','fas fa-school');
        yield MenuItem::linkToCrud('Subject', 'fas fa-person-chalkboard', Subject::class);
        yield MenuItem::linkToCrud('SubjectType', 'fas fa-gears', SubjectType::class);

        yield MenuItem::section('Presentation','fas fa-chalkboard');
        yield MenuItem::linkToCrud('PresentationSubjects', 'fas fa-person-chalkboard', PresentationSubject::class);
        yield MenuItem::linkToCrud('PresentationTypes', 'fas fa-list', PresentationType::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
    }
}
