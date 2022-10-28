<?php

namespace Modules\Cms\Admin;

use Hairavel\Core\UI\Form;
use Hairavel\Core\UI\Table;
use Modules\Cms\Model\CmsMark;

class Mark extends \Modules\System\Admin\Expend
{

    public string $model = CmsMark::class;

    protected function table(): Table
    {
        $table = new Table(new $this->model());
        $table->title('template tag');
        $table->action()->button('Add', 'admin.cms.mark.page')->icon('plus')->type('dialog');

        $table->column('#', 'mark_id')->width(80);
        $table->column('name', 'name');
        $column = $table->column('operation')->width('180')->align('right');
        $column->link('edit', 'admin.cms.mark.page', ['id' => 'mark_id'])->type('dialog');
        $column->link('delete', 'admin.cms.mark.del', ['id' => 'mark_id'])->type('ajax', ['method' => 'post']) ;
        return $table;
    }

    public function form(int $id = 0): Form
    {
        $form = new Form(new $this->model());
        $form->dialog(true);
        $form->setKey('mark_id', $id);
        $info = $form->info();
        $form->text('marker name', 'name');
        $form->radio('marker type', 'type', [
            'text' => 'plain text',
            'editor' => 'rich text',
            'image' => 'image',
            'file' => 'file',
        ])->switch('type');
        $form->textarea('mark content', 'type_text')->value($info->type === 'text' ? $info->content : '')->group('type', 'text');
        $form->editor('mark content', 'type_editor')->value($info->type === 'editor' ? $info->content : '')->group('type', 'editor');
        $form->image('mark content', 'type_image')->value($info->type === 'image' ? $info->content : '')->group('type', 'image');
        $form->file('mark content', 'type_file')->value($info->type === 'file' ? $info->content : '')->group('type', 'file');
        $form->before(function ($data, $type, $model) {
            $model->content = $data['type_' . $data['type']];
        });
        return $form;
    }

}
