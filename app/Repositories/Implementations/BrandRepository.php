<?php

namespace App\Repositories\Implementations;

use App\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BrandRepositoryInterface;



class BrandRepository implements BrandRepositoryInterface {

    public function getAll() {
        return Brand::paginate(10);

    }

    public function getById() {

    }

    public function add(Request $request) {
        $fileToStore = $this->_upload($request);
        if($fileToStore!='') {
            $data['image'] = $fileToStore;
        }   

        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        
        
        return Brand::create($data)->id;

    }

    public function update(Request $request, $id) {
        $fileToStore = $this->_upload($request);
        if($fileToStore!='') {
            $data['image'] = $fileToStore;
        }   

        $data['brand_name'] = $request->brand_name;
        $data['brand_name'] = Str::slug($request->brand_name, '-');
       
        return Brand::find($id)->update($data);

    }

    public function delete(Brand $brand) {
        return $brand->delete();
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