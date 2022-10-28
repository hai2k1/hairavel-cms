<?php

namespace Modules\Cms\Admin;

use Illuminate\Support\Facades\Log;
use Hairavel\Core\Util\Tree;
use Hairavel\Core\UI\Form;
use Hairavel\Core\UI\Table;
use Modules\Cms\Model\CmsMenuItems;
use Modules\Tools\UI\UrlSelect;

class MenuItems extends MenuExpend
{
    use \Hairavel\Core\Traits\TableSortable;

    public string $model = CmsMenuItems::class;

    /**
     * @return Table
     * @throws \Exception
     */
    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('Menu management');
        $table->model()->scoped(['menu_id' => $this->menuId])->defaultOrder();
        $table->action()->button('Add', 'admin.cms.menuItems.page', ['menu' => $this->menuId])->icon('plus')->type( 'dialog');
        $table->tree();
        // set filter
        $table->filter('name', 'name', function ($query, $value) {
            $query->where('name', 'like', '%' . $value . '%');
        })->text('Please enter the menu name')->quick();
        // set list
        $table->column('menu name', 'name');
        $column = $table->column('operation')->width('140');
        $column->link('edit', 'admin.cms.menuItems.page', ['menu' => $this->menuId, 'id' => 'item_id'])->type('dialog') ;
        $column->link('Delete', 'admin.cms.menuItems.del', ['menu' => $this->menuId, 'id' => 'item_id'])->type('ajax', ['method' => 'post']);
        return $table;
    }

    /**
     * @param null $id
     * @return Form
     */
    public function form($id = 0): \Hairavel\Core\UI\Form
    {
        $model = new $this->model();
        $form = new \Hairavel\Core\UI\Form($model);
        $form->dialog(true);
        $form->action(route('admin.cms.menuItems.save', ['menu' => $this->menuId, 'id' => $id]));

        $form->cascader('Superior Category', 'parent_id', function ($value) {
            return $this->model::scoped(['menu_id' => $this->menuId])->get(['item_id as id', 'parent_id as pid', 'name']);
        });

        $form->text('menu name', 'name')->verify([
            'required',
        ], [
            'required' => 'Please fill in the menu name',
        ]);

        $form->extend('urlSelect', UrlSelect::class);
        $form->urlSelect('menu link', 'url', route('admin.tools.url.data'));

        $form->front(function ($data, $type, $model) {
            $model->menu_id = $this->menuId;
            return $model;
        });

        return $form;
    }


}
