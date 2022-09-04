<?php

namespace App\Grid;

use Prezent\Grid\BaseGridType;
use Prezent\Grid\Extension\Core\Type\DateTimeType;
use Prezent\Grid\Extension\Core\Type\StringType;
use Prezent\Grid\GridBuilder;
use Prezent\Grid\GridView;

class PresentationGridType extends BaseGridType
{

    public function buildGrid(GridBuilder $builder, array $options = [])
    {
        $builder
            ->addColumn('label', StringType::class, [])
            ->addColumn('mainSubject', StringType::class, [])
            ->addColumn('referenceSubject', StringType::class, [])
            ->addColumn('held', DateTimeType::class, ['pattern' => 'yyyy'])
        ;
    }

    public function buildView(GridView $view, array $options = [])
    {
            $view->vars['attr']['class'] = 'tablesorter table table-borderless';
            $view->vars['attr']['id'] = 'table';

    }

}