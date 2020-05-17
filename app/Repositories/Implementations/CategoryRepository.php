<?php

namespace App\Repositories\Implementations;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface {
    public function getAll() {
        return Category::paginate(10);
    }
    public function getById($id) {

    }

    public function add(Request $request) {
        $fileToStore = $this->_upload($request);
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['parent_id'] = $request->has('parent') ? $request->parent :  null;
        $data['image'] = $fileToStore;
        return Category::create($data)->id;
    }

    public function update(Request $request, $id) {
        $fileToStore = $this->_upload($request);
        if($fileToStore!='') {
            $data['image'] = $fileToStore;
        }    
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['parent_id'] = $request->has('parent') ? $request->parent :  null;
        return Category::find($id)->update($data);
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }

    public function options($withSelect = true) {
        $options = $withSelect ? ['' => 'select an option'] : [];
        $result = Category::pluck('category_name', 'id');
        if($result->count())
            $options += $result->toArray();
        return $options;
    }

    private function _upload(Request $request) {
        $fileToStore = null;
        if($request->hasFile('image')) {
            $fileName = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileToStore = pathinfo($fileName, PATHINFO_FILENAME)
                            . time() . '.' . $extension;
            $request->file('image')->storeAs('public/uploads', $fileToStore);
            
        }
        return $fileToStore;
    }
}