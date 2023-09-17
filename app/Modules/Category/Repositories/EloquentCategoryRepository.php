<?php

namespace App\Modules\Category\Repositories;

use App\Modules\Category\Models\Category;

class EloquentCategoryRepository implements CategoryRepository
{
    public function all()
    {
        return Category::get();
    }

    public function getByCondition($conditions=[])
    {
        $list = Category::query();
        foreach ($conditions as $col=>$val){
            $list->where($col,$val);
        }
        return $list->get();
    }


    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create($data)
    {
        $category = Category::create($data);
        return $category;
    }

    public function update($id,$data){
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id){
        return Category::destroy($id);
    }

    public function model(){
        return new Category();
    }
}
