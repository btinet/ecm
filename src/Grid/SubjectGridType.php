<?php

namespace App\Grid;

use Prezent\Grid\BaseGridType;
use Prezent\Grid\Extension\Core\Type\CollectionType;
use Prezent\Grid\Extension\Core\Type\DateTimeType;
use Prezent\Grid\Extension\Core\Type\StringType;
use Prezent\Grid\GridBuilder;
use Prezent\Grid\GridView;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\MakerBundle\Str;

class SubjectGridType extends BaseGridType
{

    public function buildGrid(GridBuilder $builder, array $options = [])
    {
        $builder
            ->addColumn('label', StringType::class, [])
            ->addColumn('countPresentationSubjects', StringType::class, [])
        ;
    }

    public function buildView(GridView $view, array $options = [])
    {
            $view->vars['attr']['class'] = 'tablesorter table table-borderless';
            $view->vars['attr']['id'] = 'table';

    }

}