<?php

namespace Modules\Cms\Admin;

use Hairavel\Core\UI\Form;
use Hairavel\Core\UI\Table;

class Page extends \Modules\System\Admin\Expend
{

    public string $model = \Modules\Cms\Model\CmsPage::class;

    /**
     * @return Table
     * @throws \Exception
     */
    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('custom page');
        $table->action()->button('Add', 'admin.cms.page.page')->icon('plus')->type('dialog');

        $table->column('#', 'page_id')->width(80);
        $table->column('page name', 'name');
        $table->column('page information', 'keywords')->desc('description');
        $table->column('template file', 'tpl', static function($vo) {
            return $vo ? $vo . '.blade.php' : '-';
        });
        $column = $table->column('operation')->width('180')->align('right');
        $column->link('edit', 'admin.cms.page.page', ['id' => 'page_id'])->type('dialog');
        $column->link('delete', 'admin.cms.page.del', ['id' => 'page_id'])->type('ajax', ['method' => 'post']) ;
        return $table;
    }

    /**
     * @param int $id
     * @return Form
     */
    public function form(int $id = 0): Form
    {
        $form = new Form(new $this->model());
        $form->dialog(true);
        $form->text('page name', 'name');
        $form->tags('page keywords', 'keywords');
        $form->textarea('page description', 'description');
        $form->text('template name', 'tpl')->afterText('.blade.php')->prompt('template name is the template file name under the current theme');
        return $form;
    }

}
