<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = \App\Role::create([
            'name'=>'Author',
            'slug'=> 'author',
            'permissions'=>[
                'create_post' =>true
            ],
        ]);

        $editor = \App\Role::create([
            'name'=>'Editor',
            'slug'=> 'editor',
            'permissions'=>[
                'update_post' =>true,
                'publish_post' => true
            ],
        ]);
    }
}
