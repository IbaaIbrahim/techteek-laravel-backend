<?php


namespace App\Modules\Article\DataTables;

use App\Modules\Article\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArticleDataTable
{
    public static function toJson(Request $request)
    {
        $query = Article::select('*')->orderBy("id", 'desc');
        $response = Datatables::of($query)
            ->filter(function ($query) {
                if (isset(request('filter')['name'])) {
                    $query->where('name', 'like', "%" . request('filter')['name'] . "%");
                }
            })
            ->toJson();
        return $response;
    }

}
