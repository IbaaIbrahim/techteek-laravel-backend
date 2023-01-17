<?php


namespace App\Modules\Article\Actions;

use App\Helpers\Helper;
use App\Modules\Article\DTO\ArticleDTO;
use App\Modules\Article\Models\Article;

class StoreArticleAction
{

    public static function execute(ArticleDTO $ArticleDTO)
    {
        $Article = new Article($ArticleDTO->toArray());
        $Article->save();
        return Helper::createSuccessResponse(['Article' => $Article], 'Added Successfully');
    }
}
