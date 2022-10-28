<?php

namespace Modules\Cms\Admin;

use Hairavel\Core\UI\Form;
use Hairavel\Core\UI\Table;

class Menu extends \Modules\System\Admin\Expend
{

    public string $model = \Modules\Cms\Model\CmsMenu::class;

    /**
     * @return Table
     * @throws \Exception
     */
    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('Menu management');
        $table->action()->button('Add', 'admin.cms.menu.page')->icon('plus')->type('dialog');

        $table->column('#', 'menu_id')->width(80);
        $table->column('name', 'name');
        $column = $table->column('operation')->width('180')->align('right');
        $column->link('edit', 'admin.cms.menu.page', ['id' => 'menu_id'])->type('dialog');
        $column->link('delete', 'admin.cms.menu.del', ['id' => 'menu_id'])->type('ajax', ['method' => 'post']) ;
        return $table;
    }

    public function form(int $id = 0): Form
    {
        $form = new Form(new $this->model());
        $form->dialog(true);
        $form->text('menu name', 'name');
        return $form;
    }

}
