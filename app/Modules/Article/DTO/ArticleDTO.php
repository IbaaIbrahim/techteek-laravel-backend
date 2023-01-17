<?php


namespace App\Modules\Article\DTO;

use Spatie\DataTransferObject\DataTransferObject;


class ArticleDTO extends DataTransferObject
{

    /** @var string $key */
    public $name;

    /** @var string $text */
    public $text;

    public static function fromRequest($request)
    {
        return new self([
            'name' => $request['name'],
            'text' => $request['text']
        ]);
    }

    public static function fromRequestForUpdate($request, $Article)
    {
        return new self([
            'name' => isset($request['name']) ? $request['name'] : $Article->name,
            'text' => isset($request['text']) ? $request['text'] : $Article->text
        ]);
    }
}
