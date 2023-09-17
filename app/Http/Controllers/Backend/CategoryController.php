<?php

namespace App\Http\Controllers\Backend;


use App\Modules\Category\CategoryLibrary;
use App\Modules\Common\Support\Media;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    private $categoryLibrary;

    public function __construct(CategoryLibrary $categoryLibrary)
    {
        $this->categoryLibrary = $categoryLibrary;
        view()->composer('backend.category._form',function($view){
            $view->with([
                'categoryList'=>$this->categoryLibrary->all()
            ]);
        });
        parent::__construct();
    }

    public function index()
    {
        $list = $this->categoryLibrary->all();
        return view('backend.category.index',compact('list'));
    }

    public function create()
    {
        $record = $this->categoryLibrary->model();
        return view('backend.category.create',compact('record'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_feature'] = $request->has('is_feature');
        $data['is_active'] = $request->has('is_active');
        $record = $this->categoryLibrary->create($data);
        if ($request->file('image')) {
            $record->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return back()->with('alert-success','New record has been added successfully');
    }

    public function edit($id)
    {
        $record = $this->categoryLibrary->find($id);
        return view('backend.category.edit',compact('record'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $data['is_feature'] = $request->has('is_feature');
        $data['is_active'] = $request->has('is_active');
        $record = $this->categoryLibrary->update($id,$data);
        if(isset($data['mediaTodelete'])){
            Media::whereIn('id', $data['mediaTodelete'])->delete();
        }
        if ($request->file('image')) {
            $record->clearMediaCollection('images');
            $record->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return back()->with('alert-success','The record has been updated successfully');
    }

    public function destroy($id){
        return $this->categoryLibrary->delete($id);
    }

    public function getCategoryList(){
        $term = request('term');
        $results = array();
        if(!$term)  return response()->json($results);
        $queries = $this->categoryLibrary->model()
            ->where('name->en', 'LIKE', '%'.$term.'%')
            ->orwhere('name->ar', 'LIKE', '%'.$term.'%')
            ->take(5)
            ->get();
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'text' => $query->getTranslation('name','en')];
        }
        return response()->json($results);
    }

}
