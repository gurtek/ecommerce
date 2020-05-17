<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Product;
use App\ProductCategory;
use App\ProductAttribute;
use App\ProductAttachement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        //
        return view('admin.product.index');
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
        return view('admin.product.create', compact('categories', 'attributes'));
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
            'quantity' => 'required|numeric'
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
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
}
