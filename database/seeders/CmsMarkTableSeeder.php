<?php

namespace Modules\Cms\Seeders;

use Illuminate\Database\Seeder;

class CmsMarkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cms_mark')->insert([
            [
                'name' => 'template description',
                'type' => 'text',
                'content' => 'This is a default news center presentation template, including commonly used label examples, you can recreate the theme, or modify the theme to use. ',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);


    }
}
