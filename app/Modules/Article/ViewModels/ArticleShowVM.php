<?php

namespace App\Modules\Article\ViewModels;

use App\Modules\Article\Models\Article;

class ArticleShowVM
{

    public static function handle($Article)
    {
        return $Article;
    }

    public static function toArray(Article $Article)
    {
        return ['Article' => self::handle($Article)];
    }

    public static function toAttr(Article $Article)
    {
        return self::handle($Article);
    }
}
