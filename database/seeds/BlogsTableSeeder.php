<?php

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Blogモデルを使って１５個のモデルを作ってください
        factory (Blog::class , 15)->create();
    }
}
