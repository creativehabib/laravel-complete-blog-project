<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Meta;
use App\View\Components\FlashMessages;
use Throwable;

class CategoryController extends Controller
{
    use FlashMessages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = (new Category())->get_category_list();
        return view('modules.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('modules.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try{
            $category = (new Category())->storeCategory($request);
            (new Meta())->store_meta($request, $category);
            self::message('success', 'Category created successfully.');
            return redirect()->route('category.index');
        }catch(Throwable $throwable){

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       return view('modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('modules.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try{
            (new Category())->update_category($request, $category);
            (new Meta())->update_meta($request, $category);
            return redirect()->route('category.index')->with('success','Category updated successfully');
        }catch(Throwable $throwable){

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        (new Category())->delete_category($category);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
