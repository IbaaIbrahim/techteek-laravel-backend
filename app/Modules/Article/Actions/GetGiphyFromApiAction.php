<?php


namespace App\Modules\Article\Actions;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GetGiphyFromApiAction
{
    public static function execute(Request $request)
    {
        $response = Http::get("https://api.giphy.com/v1/gifs/search?api_key=1D6OtSY6LByfU1KGCd4MqTGxsYBj7ppj&q=$$request->q&limit=25&offset=$request->offset&rating=g&lang=en");
        $data = json_decode($response);
        return Helper::createSuccessResponse(['gifs' => $data], '');
    }

}
