<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Supplier;

class SuppliersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Supplier';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Supplier());

        $grid->column('id', __('Id'));
        $grid->column('supplier_name', __('Supplier name'));
        $grid->column('contact_number', __('Contact number'));
        $grid->column('email', __('Email'));
        $grid->column('contact_person', __('Contact person'));
        $grid->column('status', __('Status'));
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
        $show = new Show(Supplier::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('supplier_name', __('Supplier name'));
        $show->field('address', __('Address'));
        $show->field('contact_number', __('Contact number'));
        $show->field('email', __('Email'));
        $show->field('contact_person', __('Contact person'));
        $show->field('contact_person_number', __('Contact person number'));
        $show->field('contact_person_email', __('Contact person email'));
        $show->field('contact_person_designation', __('Contact person designation'));
        $show->field('register_number', __('Register number'));
        $show->field('vat_number', __('Vat number'));
        $show->field('nic', __('Nic'));
        $show->divider();
        $show->field('bank_name', __('Bank name'));
        $show->field('branch', __('Branch'));
        $show->field('account_number', __('Account number'));
        $show->field('account_name', __('Account name'));
        $show->field('status', __('Status'));
        $show->field('remarks', __('Remarks'));
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
        $form = new Form(new Supplier());


        $form->tab('Basic info', function ($form) {

            $form->text('supplier_name', __('Supplier name'))->required();
            $form->text('register_number', __('Register number'));
            $form->text('vat_number', __('Vat number'));
            $form->select('status', __('Status'))
                ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                ->default('active')->required();

        })->tab('Contact Details', function ($form) {

            $form->phonenumber('contact_number', __('Contact number'))->required();
            $form->textarea('address', __('Address'));
            $form->email('email', __('Email'));

        })->tab('Contact Person Details', function ($form) {

            $form->text('contact_person', __('Contact person'));
            $form->text('contact_person_number', __('Contact person number'))->required();
            $form->email('contact_person_email', __('Contact person email'))->required();
            $form->text('contact_person_designation', __('Contact person designation'));
            $form->text('nic', __('Nic'));


        })->tab('Back Details', function ($form) {
            $form->text('bank_name', __('Bank name'))->required();
            $form->text('branch', __('Branch'))->required();
            $form->text('account_number', __('Account number'))->required();
            $form->text('account_name', __('Account name'))->required();
        })->tab('Other', function ($form) {
            $form->textarea('remarks', __('Remarks'));
        });






        return $form;
    }
}
