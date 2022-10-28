<?php

namespace Modules\Cms\Listeners;

/**
 * Data installation interface
 */
class InstallSeed
{

    /**
     * @param $event
     * @return array[]
     */
    public function handle($event)
    {
        return \Modules\Cms\Seeders\DatabaseSeeder::class;
    }
}
