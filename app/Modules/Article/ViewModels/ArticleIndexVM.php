<?php

namespace App\Modules\Article\ViewModels;

use App\Modules\Article\Models\Article;

class ArticleIndexVM
{

    public static function handle()
    {
        $Articles = Article::all();
        $arr = [];
        foreach ($Articles as $Article) {
            $ArticleVM = new ArticleShowVM();
            array_push($arr, $ArticleVM->toAttr($Article));
        }
        return $arr;
    }

    public static function toArray()
    {
        return ['Articles' => self::handle()];
    }
}
