<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'content' => '家事',
        ];
        Tag::create($param);
        $param = [
            'content' => '勉強',
        ];
        Tag::create($param);
        $param = [
            'content' => '運動',
        ];
        Tag::create($param);
        $param = [
            'content' => '食事',
        ];
        Tag::create($param);
        $param = [
            'content' => '移動',
        ];
        Tag::create($param);
    }
}
