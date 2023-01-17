<?php

namespace App\Modules\Article\Controllers;

use App\Modules\Article\Actions\DeleteArticleAction;
use App\Modules\Article\Actions\StoreArticleAction;
use App\Modules\Article\Actions\GetGiphyFromApiAction;
use App\Modules\Article\Actions\UpdateArticleAction;
use App\Modules\Article\DataTables\ArticleDataTable;
use App\Modules\Article\DTO\ArticleDTO;
use App\Modules\Article\Models\Article;
use App\Modules\Article\Requests\StoreArticleRequest;
use App\Modules\Article\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\Article\ViewModels\ArticleShowVM;
use Illuminate\Http\Request;

class ArticleDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $response = ArticleDataTable::toJson($request);
        $response = Helper::createSuccessDTResponse($response, '');
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGiphyApi(Request $request)
    {
        $response = GetGiphyFromApiAction::execute($request);
        $response = Helper::createResponse($response);
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $Article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Article $Article)
    {
        //
        $response = Helper::createSuccessResponse(ArticleShowVM::toArray($Article));
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreArticleRequest $storeArticleRequest)
    {
        $ArticleDTO = ArticleDTO::fromRequest($storeArticleRequest);
        $response = Helper::createResponse(StoreArticleAction::execute($ArticleDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticleRequest $updateArticleRequest, $Article)
    {
        $Article = Article::find($Article);
        $ArticleDTO = ArticleDTO::fromRequestForUpdate($updateArticleRequest, $Article);
        $response = Helper::createResponse(UpdateArticleAction::execute($Article, $ArticleDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $Article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($Article)
    {
        //
        $Article = Article::find($Article);
        $response = Helper::createResponse(DeleteArticleAction::execute($Article));
        return response()->json($response, $response['code']);
    }
}
