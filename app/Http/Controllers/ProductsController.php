<?php

namespace App\Http\Controllers;

use App\Brand;
use Exception;
use Validator;
use App\Product;
use App\ProductCategory;
use App\ProductAttribute;
use App\ProductAttachement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\ProductAttributeView;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\AttributeRepositoryInterface;

class ProductsController extends Controller
{
    private $_category;
    private $_attribute;
    public function __construct(CategoryRepositoryInterface $category,
                                AttributeRepositoryInterface $attribute) {
        $this->_category = $category;
        $this->_attribute = $attribute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('productCategories')
                    ->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function listProducts($type = null, $value = null) {
        
        $products = Product::with('productCategories')->get();

        if($type == 'brand' && $value != null && is_numeric($value)) {
            $products = Product::where('brand_id', $value)->get();
        } else if($type == 'category' && $value != null ) {
            $productsIds = ProductCategory::where('category_id', $value)->get(['product_id']);
            if($productsIds->count()) {
                $products = Product::whereIn('id', $productsIds)->with('attachements')
                        ->get();
            }
        } 
        
        return view('front.product.index', compact('products'));
    }

    public function searchProduct(Request $request) {
        
        if($request->get('value') == null) {
            abort(404);
        } 
        $value = $request->get('value');
        $products = Product::where('product_name', 'like', '%' . $value . '%')->get();
        return view('front.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->_category->options(false);
        $attributes = $this->_attribute->attributeOptions();
        $brands = (new Brand)->options();
        return view('admin.product.create', compact('categories', 'attributes', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) {
            abort(404);
        }
        $requestData = $request->all();        
        $data=  array();
        parse_str($requestData['formdata'], $data);


        $validator = Validator::make($data, [
            'product_name' => 'required|unique:products,product_name',
            'product_description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'brand' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $this->_renderErrorMessages($validator->errors())
            ], 200);
        }

        # check if the categories are sent
        if(!isset($data['categories'])) {
            return response()->json([
                'status' => 422,
                'message' => 'Please choose at least one category'
            ], 200);
        }
        
        DB::beginTransaction();
        try {

            #insert product
            $productId = $this->_insertProduct($data);
            
            #insert product categories
            $this->_insertProductCategories($data, $productId);

            # insert attributes if any
            $this->_insertProductAttributes($data, $productId);

            # insert product attachements
            $this->_insertProductAttachements($data, $productId);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Product has been saved successfully.'
            ], 200);

        } catch(Exception $exception) {
            // log exception
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    private function _insertProduct($data) {
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->product_slug = Str::slug( $data['product_name'], '-');
        $product->product_description = $data['product_description'];
        $product->product_price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->brand_id = $data['brand'];
        $product->save();
        return $product->id;
    }

    

    private function _insertProductAttributes($data, $productId) {
        $ids = $this->_sanitizeAttributeValueIds($data);
        $productAttributeData = [];
        if( count($ids) ) {
            foreach($ids as $key => $value) {
                $quantity = 0;
                $price = 0;
                if(isset($data['attribute_quantity']) && is_array($data['attribute_quantity']) 
                    && key_exists($key, $data['attribute_quantity']) 
                    && is_numeric($data['attribute_quantity'][$key])) {
                        $quantity = $data['attribute_quantity'][$key];
                }

                if(isset($data['attribute_price']) && is_array($data['attribute_price']) 
                    && key_exists($key, $data['attribute_price']) 
                    && is_numeric($data['attribute_price'][$key])) {
                        $price = $data['attribute_price'][$key];
                }

                $productAttributeData[$key] = [
                    'product_id' => (int) $productId,
                    'attribute_value_id' => (int)  $value,
                    'quantity' => (int) $quantity,
                    'price' => floatval($price)
                ];
            }

            ProductAttribute::insert($productAttributeData);
            return true;
        }
        return false;
    }

    // sanitize inputs 
    private function _sanitizeAttributeValueIds($data) {
        $ids = array();
        if(isset($data['attribute_value_id']) && is_array($data['attribute_value_id'])) {
            $ids = array_unique(array_filter($data['attribute_value_id']));
        }
        return $ids;
    }

    private function _insertProductCategories($data, $productId) {
        if(isset($data['categories']) && is_array($data['categories'])) {
            $productCategoryData = array();
            $ids = array_unique(array_filter($data['categories']));
            if(count($ids)) {
                foreach($ids as $key => $id) {
                    $productCategoryData[$key] = [
                        'product_id' => $productId,
                        'category_id' => $id
                    ];
                }
                ProductCategory::insert($productCategoryData);
                return true;
            }
        }
        return false;
    }

    private function _insertProductAttachements($data, $productId) {
        if(isset($data['image']) && is_array($data['image'])) {
            $productAttachementData = array();
            $paths = array_unique(array_filter($data['image']));
            if(count($paths)) {
                foreach($paths as $key => $path) {
                    $productAttachementData[$key] = [
                        'product_id' => $productId,
                        'file_path' => $path
                    ];
                }
                ProductAttachement::insert($productAttachementData);
                return true;
            }
        }
        return false;
    }

     

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = $this->_category->options(false);
        $attributes = $this->_attribute->attributeOptions();
        $brands = (new Brand)->options();
        $productCategories = ProductCategory::where('product_id', $product->id)
        ->pluck('category_id');

        $productCategories = $productCategories->count() ? $productCategories->toArray() : [];
       
        $productAttributes = ProductAttributeView::where('id', $product->id)->get();

        return view('admin.product.edit', compact('categories', 'productAttributes', 'attributes', 'productCategories', 
        'brands', 'product'));
    }

    public function ajaxUpdate(Request $request) {
        if(!$request->ajax()) {
            abort(404);
        }
        $requestData = $request->all();        
        $data=  array();
        parse_str($requestData['formdata'], $data);


        $validator = Validator::make($data, [
            'product_id' => 'required|numeric',
            'product_name' => 'required|unique:products,product_name,' . $data['product_id'],
            'product_description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'brand' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $this->_renderErrorMessages($validator->errors())
            ], 200);
        }

        DB::beginTransaction();
        try {

            #insert product
            $this->_updateProduct($data);
            
            #insert product categories
            //delete all entries
            $productCategoryIds = ProductCategory::where('product_id', $data['product_id'])
                                ->pluck('product_id');
                                //dd($productCategoryIds->count());
            if($productCategoryIds->count()) {
                ProductCategory::where('product_id', $data['product_id'])->delete();
            }


            $this->_insertProductCategories($data, $data['product_id']);

            $productAttribtueIds = ProductAttribute::where('product_id', $data['product_id'])
                                ->pluck('id');
            if($productAttribtueIds->count()) {
                ProductAttribute::whereIn('id', $productAttribtueIds)->delete();
            }

            # insert attributes if any
            $this->_insertProductAttributes($data, $data['product_id']);


            # insert product attachements
            $productImageIds = ProductAttachement::where('product_id', $data['product_id'])
                                ->pluck('id');
            if($productImageIds->count()) {
                ProductAttachement::whereIn('id', $productImageIds)->delete();
            }
            
            $this->_insertProductAttachements($data, $data['product_id']);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Product has been updated successfully.'
            ], 200);

        } catch(Exception $exception) {
            // log exception
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage()
            ], 200);
        }
    }

    private function _updateProduct($data) {
        $product = Product::find($data['product_id']);
        $product->product_name = $data['product_name'];
        $product->product_slug = Str::slug( $data['product_name'], '-');
        $product->product_description = $data['product_description'];
        $product->product_price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->brand_id = $data['brand'];
        $product->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('message', 'The product has been deleted.');
    }

    public function getAttributeValueById(Request $request) {
        if(!$request->ajax()) {
            abort(500);
        }
        $id = $request->get('id');

        $values = $attributes = $this->_attribute
                                     ->attributeValueOptions($id, false);

        return view('admin.attribute.ajax_attribute_values', compact('values'));
    }

    private function _renderErrorMessages($errors) {
        $messages = [];
        if($errors->any()) {
            foreach($errors->all() as $error) {
                $messages[] = $error;
            }
        }
        return $messages;
    }

    // method for product detail front-end

    public function productDetail($slug = null) {
        
        if($slug == null) {
            abort(404);
        }

        $product = Product::where('product_slug', $slug)
                    ->with('attachements')
                    ->firstOrFail();
        $attributes = ProductAttributeView::where('id', $product->id)->get()
                            ->groupBy('attribute_name');

        //dump($attributes);
        return view('front.product.detail', compact('product', 'attributes'));
    }

}
