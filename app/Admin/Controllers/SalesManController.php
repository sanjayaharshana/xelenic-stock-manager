<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Salesman;

class SalesManController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Salesman';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Salesman());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('address', __('Address'));
        $grid->column('date_of_birth', __('Date of birth'));
        $grid->column('nic', __('Nic'));
        $grid->column('maid_address', __('Maid address'));
        $grid->column('contact_number', __('Contact number'));
        $grid->column('email', __('Email'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Salesman::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('address', __('Address'));
        $show->field('date_of_birth', __('Date of birth'));
        $show->field('nic', __('Nic'));
        $show->field('maid_address', __('Maid address'));
        $show->field('contact_number', __('Contact number'));
        $show->field('email', __('Email'));
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
        $form = new Form(new Salesman());

        $form->text('name', __('Name'))->required();
        $form->textarea('address', __('Address'))->required();
        $form->date('date_of_birth', __('Date of birth'))->default(date('H:i:s'))->required();
        $form->text('nic', __('Nic'))->required();
        $form->textarea('maid_address', __('Maid address'));
        $form->phonenumber('contact_number', __('Contact number'))->required();
        $form->text('email', __('Email'));

        return $form;
    }
}
