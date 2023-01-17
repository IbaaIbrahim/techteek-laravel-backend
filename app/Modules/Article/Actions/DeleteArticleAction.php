<?php


namespace App\Modules\Article\Actions;

use App\Helpers\Helper;
use App\Modules\Article\Models\Article;

class DeleteArticleAction
{
    public static function execute(Article $Article)
    {
        $Article->delete();
        return Helper::createSuccessResponse([], 'Deleted Successfully');
    }

}
