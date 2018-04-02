<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $ids = [1, 2, 3, 4, 5];

        $posts = factory(\App\Models\Post::class)
            ->times(30)
            ->make()
            ->each(function ($post, $index) use ($faker, $ids) {
                $post->user_id = $faker->randomElement($ids);
            });

        // 插入数据库
        \App\Models\Post::insert($posts->toArray());
    }
}
