<?php

namespace App\Imports;

use App\Modules\Category\CategoryLibrary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithChunkReading, WithHeadingRow, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $categoryLibrary;

    public function __construct(CategoryLibrary $categoryLibrary)
    {
        $this->categoryLibrary = $categoryLibrary;

    }

    public function model(array $row)
    {
        $row['parent_id'] = null;
        if($row['parent_category_en']){
            $parent = $this->categoryLibrary
                ->model()
                ->where('name->en',$row['parent_category_en'])
                ->first();
            $row['parent_id'] = $parent->id??null;
        }
        $this->categoryLibrary->create([
            'name'=>[
                    'en'=>$row['category_name_en'],
                    'ar'=>$row['category_name_ar'],
                ],
            'parent_id'=>$row['parent_id'],
            'is_feature'=>$row['featured']??0
        ]);
    }

    public function batchSize(): int
    {

        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
