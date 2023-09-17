<?php

namespace App\Modules\Category;

use App\Modules\Category\Repositories\CategoryRepository;
use App\Modules\Common\Support\BaseLibrary;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class CategoryLibrary extends BaseLibrary
{
    protected $http, $categoryRepository;

    public function __construct(HttpClient $http, CategoryRepository $categoryRepository)
    {
        $this->http = $http;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($categoryRepository);
    }

    public function toTree()
    {
        return $this->categoryRepository->all()->toTree();
    }
    public function getByCondition($conditions = []){
        return $this->categoryRepository->getByCondition($conditions);
    }

}
