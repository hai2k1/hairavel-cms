<?php

namespace Modules\Cms\Web;

use Modules\Article\Resource\ArticleCollection;
use Modules\Cms\Web\Base;

class Form extends Base
{
    public function index($id)
    {
        $formInfo = \Hairavel\Core\Service\Form::form($id);
        $this->meta($formInfo->name);
        $this->assign('formInfo', $formInfo);
        return $this->view($formInfo->tpl_list);
    }

    public function info($id)
    {
        [$info, $formInfo] = \Hairavel\Core\Service\Form::info($id);

        $tpl = $formInfo->tpl_info ?: 'page';
        $this->meta($formInfo->name);
        $this->assign('formInfo', $formInfo);
        $this->assign('info', $info);
        return $this->view($tpl);
    }

    public function push($id)
    {
        $formInfo = \Hairavel\Core\Service\Form::push($id);
        return app_success('Submission succeeded' . ($formInfo->audit ? ', please be patient for review' : ''));
    }
}
