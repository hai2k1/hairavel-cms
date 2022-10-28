<?php

namespace Modules\Cms\Listeners;

use Hairavel\Core\UI\Form;

/**
 * form interface
 */
class ManageForm
{

    public function handle($event)
    {

        if ($event->class === \Modules\System\Admin\Setting::class) {
            $this->settingForm($event->form);
        }

    }

    public function settingForm($form)
    {
        $tabs = $form->element[1];

        $tabs->column('Theme configuration', function (Form $form) {
            $form->text('Theme title', 'THEME_TITLE');
            $form->text('Theme keyword', 'THEME_KEYWORD');
            $form->text('Theme description', 'THEME_DESCRIPTION');
            $form->text('pc-side theme', 'THEME_DEFAULT');
            $form->text('Mobile theme', 'THEME_MOBILE');
        }, 1);

    }
}
