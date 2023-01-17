<?php


namespace App\Modules\Article\Actions;

use App\Helpers\Helper;
use App\Modules\Article\DTO\ArticleDTO;
use App\Modules\Article\Models\Article;
use Illuminate\Support\Facades\Auth;

class UpdateArticleAction
{
    public static function execute(Article $Article, ArticleDTO $ArticleDTO)
    {
        $Article->update($ArticleDTO->toArray());
        return Helper::createSuccessResponse(['Article' => $Article], 'Updated Successfully');
    }

}
