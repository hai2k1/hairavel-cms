<?php

namespace Modules\Cms\Resource;

use Hairavel\Core\Resource\BaseCollection;

class MenuItemsCollection extends BaseCollection
{

    public function toArray($request)
    {
        return $this->collection;
    }

}
