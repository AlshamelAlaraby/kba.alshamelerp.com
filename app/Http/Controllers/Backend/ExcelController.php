<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ProductsExport;
use App\Exports\ProductsPricesExport;
use App\Exports\ProductsStockExport;
use App\Imports\CategoryImport;
use App\Imports\ProductGardStockImport;
use App\Imports\ProductPricesImport;
use App\Imports\ProductsImport;
use App\Imports\ProductStockImport;
use App\Jobs\DeleteExcelFile;
use App\Modules\Brand\BrandLibrary;
use App\Modules\Category\CategoryLibrary;
use App\Modules\Product\ProductLibrary;
use App\Modules\Product\ProductStoreLibrary;
use App\Modules\Store\StoreLibrary;
use App\Modules\Unit\UnitLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends BaseController
{
    private $productLibrary, $unitLibrary, $categoryLibrary, $brandLibrary;
    /**
     * @var StoreLibrary
     */
    private $storeLibrary;
    /**
     * @var ProductStoreLibrary
     */
    private $productStoreLibrary;

    public function __construct(ProductLibrary $productLibrary, CategoryLibrary $categoryLibrary, UnitLibrary $unitLibrary, BrandLibrary $brandLibrary, StoreLibrary $storeLibrary, ProductStoreLibrary $productStoreLibrary)
    {
        $this->productLibrary = $productLibrary;
        $this->unitLibrary = $unitLibrary;
        $this->categoryLibrary = $categoryLibrary;
        $this->brandLibrary = $brandLibrary;
        $this->storeLibrary = $storeLibrary;
        $this->productStoreLibrary = $productStoreLibrary;
        parent::__construct();
    }

    public function importCategories()
    {
        $file = request()->file('file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('', $fileName, ['disk' => 'local']);
        $fileUrl = Storage::disk('local')->path($fileName);
        DB::table('categories')->where('id', '>', 65)->delete();
        Excel::import(new CategoryImport($this->categoryLibrary), $fileUrl);
        /*Excel::queueImport(new CategoryImport($this->categoryLibrary), $fileUrl)->chain([
            new DeleteExcelFile($fileName)
        ]);*/
        return back()->with('alert-success', 'Excel File has been imported successfully');
    }

    public function importProducts()
    {
        $file = request()->file('file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('', $fileName, ['disk' => 'local']);
        $fileUrl = Storage::disk('local')->path($fileName);
        //DB::table('categories')->truncate();
        Excel::import(new ProductsImport($this->productLibrary, $this->categoryLibrary, $this->unitLibrary, $this->brandLibrary), $fileUrl);
        /*Excel::queueImport(new CategoryImport($this->categoryLibrary), $fileUrl)->chain([
            new DeleteExcelFile($fileName)
        ]);*/
        return back()->with('alert-success', 'Excel File has been imported successfully');
    }

    public function exportProducts()
    {
        $list = $this->productLibrary->all();
        return Excel::download(new ProductsExport($list), 'products.xlsx');
    }

    public function importPrices()
    {
        $file = request()->file('file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('', $fileName, ['disk' => 'local']);
        $fileUrl = Storage::disk('local')->path($fileName);
        Excel::import(new ProductPricesImport($this->productLibrary), $fileUrl);
        return back()->with('alert-success', 'Excel File has been imported successfully');
    }

    public function importStock(Request $request)
    {
        $store = $this->storeLibrary->find($request->store_id);
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('', $fileName, ['disk' => 'local']);
        $fileUrl = Storage::disk('local')->path($fileName);
        if($request->stock_type=='Gard Stock'){
            Excel::import(new ProductGardStockImport($this->productLibrary, $this->productStoreLibrary, $store->id), $fileUrl);
        }else{
            Excel::import(new ProductStockImport($this->productLibrary, $this->productStoreLibrary, $store->id), $fileUrl);
        }

        return back()->with('alert-success', 'Excel File has been imported successfully');
    }

    public function exportPrices()
    {
        $list = $this->productLibrary->listWithFirstProductStore();
        return Excel::download(new ProductsPricesExport($list), 'prices.xlsx');
    }

    public function exportStock()
    {
        $list = $this->productLibrary->listWithProductStore();
        return Excel::download(new ProductsStockExport($list), 'stock.xlsx');
    }
}
