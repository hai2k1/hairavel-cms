<?php

namespace Modules\Cms\Admin;

use Hairavel\Core\UI\Table;
use Modules\Cms\Model\CmsTags;

class Tags extends \Modules\System\Admin\Expend
{



    protected function table(): Table
    {
        $model = CmsTags::class;
        $table = new Table(new $model());
        $table->title('tag management');

        $table->filter('label', 'name', function ($query, $value) {
            $query->where('name', 'like', '%' . $value . '%');
        })->text('Please enter the label name')->quick();

        $table->column('label', 'name');
        $table->column('reference', 'count')->width(100);

        return $table;
    }

}
