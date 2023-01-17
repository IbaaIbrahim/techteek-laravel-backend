<?php

namespace App\Modules\Article\Controllers;

use App\Modules\Article\Actions\DeleteArticleAction;
use App\Modules\Article\Actions\StoreArticleAction;
use App\Modules\Article\Actions\UpdateArticleAction;
use App\Modules\Article\DTO\ArticleDTO;
use App\Modules\Article\Models\Article;
use App\Modules\Article\Requests\StoreArticleRequest;
use App\Modules\Article\Requests\UpdateArticleRequest;
use App\Modules\Article\ViewModels\ArticleIndexVM;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\Article\ViewModels\ArticleShowVM;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = Helper::createSuccessResponse(ArticleIndexVM::toArray());
        return response()->json($response, $response['code']);
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
     * Display the specified resource.
     *
     * @param Article $Article
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($Article)
    {
        //
        $Article = Article::find($Article);
        $response = Helper::createSuccessResponse(ArticleShowVM::toArray($Article));
        return response()->json($response, $response['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $updateArticleRequest
     * @param Article $Article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticleRequest $updateArticleRequest, $Article)
    {
        //
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
