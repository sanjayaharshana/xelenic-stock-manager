<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Products;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Products());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('sku', __('Sku'));
        $grid->column('barcode', __('Barcode'));
        $grid->column('unit', __('Unit'));
        $grid->column('status', __('Status'));
        $grid->column('list_price', __('List price'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Products::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('sku', __('Sku'));
        $show->field('barcode', __('Barcode'));
        $show->field('description', __('Description'));
        $show->field('unit', __('Unit'));
        $show->field('status', __('Status'));
        $show->field('list_price', __('List price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Products());

        $form->text('name', __('Name'))->required();
        $form->text('sku', __('Sku'));
        $form->text('barcode', __('Barcode'));
        $form->textarea('description', __('Description'));
        $form->select('unit', __('Unit'))->options([
            'pcs' => 'pcs',
            'kg' => 'kg',
            'g' => 'g',
            'm' => 'm',
            'cm' => 'cm',
            'mm' => 'mm',
            'l' => 'l',
            'ml' => 'ml'
        ])->required();
        $form->select('status', __('Status'))->options(['active' => 'active', 'inactive' => 'inactive'])
            ->default('active')
            ->required();
        $form->decimal('list_price', __('List price'))
            ->default('0.00')
            ->required();

        return $form;
    }
}
