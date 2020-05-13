<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request; 
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoriesController extends Controller
{
    private $_category;
    public function __construct(CategoryRepositoryInterface $category) {
        $this->_category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->_category->getAll();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->_category->options();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => ['required', 'max:50', 'unique:categories,category_name'],
            'image' => 'nullable|image|max:2000'
        ]);
        
        $categories = $this->_category->add($request);

        return      back()
                    ->with('message', 'The category has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $options = $this->_category->options();
        return view('admin.category.edit', compact('category', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name' => ['required', 'max:50', 'unique:categories,category_name,' . $category->id]
        ]);

        $categories = $this->_category->update($request,$category->id);
        return      back()
                    ->with('message', 'The category has been updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->_category->delete($category);
        return      back()
                    ->with('message', 'The category has been deleted successfully.');
    }
}
