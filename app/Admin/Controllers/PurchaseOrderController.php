<?php

namespace App\Admin\Controllers;

use App\Admin\Selectable\PurchaseOrderLinesSelectable;
use App\Models\Products;
use App\Models\Supplier;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\PurchaseOrder;

class PurchaseOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PurchaseOrder';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PurchaseOrder());

        $grid->column('id', __('Id'));
        $grid->column('supplier_id', __('Supplier'));
        $grid->column('grand_total', __('Grand total'));
        $grid->column('status', __('Status'));
        $grid->column('created_by', __('Created by'));
        $grid->column('payment_terms', __('Payment terms'));
        $grid->column('delivery_date', __('Delivery date'));
        $grid->column('remarks', __('Remarks'));
        $grid->column('approved_by', __('Approved by'));
        $grid->column('approved_at', __('Approved at'));
        $grid->column('rejected_by', __('Rejected by'));
        $grid->column('rejected_at', __('Rejected at'));
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
        $show = new Show(PurchaseOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('supplier_id', __('Supplier'));
        $show->field('grand_total', __('Grand total'));
        $show->field('status', __('Status'));
        $show->field('created_by', __('Created by'));
        $show->field('payment_terms', __('Payment terms'));
        $show->field('delivery_date', __('Delivery date'));
        $show->field('remarks', __('Remarks'));
        $show->field('approved_by', __('Approved by'));
        $show->field('approved_at', __('Approved at'));
        $show->field('rejected_by', __('Rejected by'));
        $show->field('rejected_at', __('Rejected at'));
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
        $form = new Form(new PurchaseOrder());


        $form->tab('Invoice', function ($form) {

            $supplier = Supplier::where('status', 'active')
                ->select('supplier_name','id')
                ->pluck('supplier_name','id');

            $form->select('supplier_id', __('Supplier'))->options($supplier)->required();

            $form->text('grand_total', __('Grand total'))->readonly();
            $form->select('status', __('Status'))->options(['Pending', 'Approved', 'Rejected'])->required();

            $form->select('created_by', __('Created by'))->options([auth()->user()->name])->required();

            $form->radio('payment_terms', __('Payment terms'))
                ->options([
                    1 =>'Check',
                    2 =>'Cash',
                ])->when(1, function (Form $form) {

                    $form->date('check_due_date','Check Due Date');

                })->when(2, function (Form $form) {



                });

            $products = Products::where('status', 'active')
                ->select('name','id')
                ->pluck('name','id');

            $form->html(view('welcome'));

        })->tab('Others', function ($form) {

            $form->text('payment_terms', __('Payment terms'));
            $form->datetime('delivery_date', __('Delivery date'))->default(date('Y-m-d H:i:s'));
            $form->textarea('remarks', __('Remarks'));
            $form->textarea('approved_by', __('Approved by'));
            $form->datetime('approved_at', __('Approved at'))->default(date('Y-m-d H:i:s'));
            $form->textarea('rejected_by', __('Rejected by'));
            $form->datetime('rejected_at', __('Rejected at'))->default(date('Y-m-d H:i:s'));


        })->tab('Payments', function ($form) {



        });







//
        return $form;
    }
}
