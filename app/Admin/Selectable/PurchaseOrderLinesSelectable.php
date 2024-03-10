<?php

namespace App\Admin\Selectable;

use App\Models\User;
use OpenAdmin\Admin\Grid\Filter;
use OpenAdmin\Admin\Grid\Selectable;

class PurchaseOrderLinesSelectable extends Selectable
{
    public $model = User::class;
    public static $display_field = "tag"; // display field when using in grid

    public function make()
    {
        $this->column('id');
        $this->column('name');
        $this->column('email');



        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }

}
