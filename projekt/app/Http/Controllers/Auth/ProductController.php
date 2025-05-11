<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Manufacturer;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        Log::info('ProductController@store started', $request->all());

        try {

            $validated = $request->validate([
                'product_type_id'  => 'required|integer',
                'name'             => 'required|string|max:255|unique:products,name',
                'description'      => 'required|string',
                'price'            => 'required|numeric',
                'manufacturer_id'  => 'required|exists:manufacturers,id',

                'bow_length'       => 'nullable|array',
                'bow_length.*'     => 'nullable|numeric',
                'draw_weight'      => 'nullable|array',
                'draw_weight.*'    => 'nullable|numeric',
                'orientation'      => 'nullable|array',
                'orientation.*'    => 'nullable|string|in:left,right,universal',

                'crossbow_draw_weight'   => 'nullable|array',
                'crossbow_draw_weight.*' => 'nullable|numeric',
                
                'slingshot_rubber_width'   => 'nullable|array',
                'slingshot_rubber_width.*' => 'nullable|numeric',

                'arrow_length'     => 'nullable|array',
                'arrow_length.*'   => 'nullable|numeric',
                'arrow_diameter'   => 'nullable|array',
                'arrow_diameter.*' => 'nullable|numeric',


                'img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
                'img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ]);


            if ($request->input('product_type_id') == 1) {

                $folderPrefix = 'assets/images/bows/';
            }
            elseif ($request->input('product_type_id') == 2) {

                $folderPrefix = 'assets/images/crossbows/';
            }
            elseif ($request->input('product_type_id') == 3) {

                $folderPrefix = 'assets/images/slings/';
            }
            elseif ($request->input('product_type_id') == 4) {

                $folderPrefix = 'assets/images/arrows/';
            }
            elseif ($request->input('product_type_id') == 5) {

                $folderPrefix = 'assets/images/other/';
            }


            $uploadedImages = [];

            foreach (['img1', 'img2', 'img3', 'img4'] as $imgField) {
                if ($request->hasFile($imgField)) {
                    $originalName = $request->file($imgField)->getClientOriginalName();
                    $uploadedImages[] = $folderPrefix . $originalName;
                }
            }

            $finalImages = [];
            for ($i = 0; $i < 4; $i++) {
                $finalImages['img' . ($i + 1)] = $uploadedImages[$i] ?? ''; 
            }



            // 2) product
            $productData = [
                'product_type_id' => $validated['product_type_id'],
                'manufacturer_id' => $validated['manufacturer_id'],
                'name'            => $validated['name'],
                'description'     => $validated['description'],
                'price'           => $validated['price'],
                'img1'            => $finalImages['img1'],
                'img2'            => $finalImages['img2'],
                'img3'            => $finalImages['img3'],
                'img4'            => $finalImages['img4'],
            ];

            $nextProductId = DB::table('products')->max('id') + 1;

            // 3) specificke vlastnosti pre produts

            $specRows = [];

            if ($productData['product_type_id'] == 1) {// bow

                $bowLengthAttrId  = 1;
                $drawWeightAttrId = 2;
                $orientationAttrId= 3;

                // bow_length
                if (isset($validated['bow_length'])) {
                    foreach ($validated['bow_length'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $bowLengthAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }



                // draw_weight
                if (isset($validated['draw_weight'])) {
                    foreach ($validated['draw_weight'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $drawWeightAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }



                // orientation
                if (isset($validated['orientation'])) {
                    foreach ($validated['orientation'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $orientationAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }



            } elseif ($productData['product_type_id'] == 2) {// crossbow

                $drawWeightAttrId = 4;

                if (isset($validated['crossbow_draw_weight'])) {
                    foreach ($validated['crossbow_draw_weight'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $drawWeightAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }

            }
            elseif ($productData['product_type_id'] == 3) {// slings
                
                $rubberWidthAttrId = 5;
    
                if (isset($validated['slingshot_rubber_width'])) {
                    foreach ($validated['slingshot_rubber_width'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $rubberWidthAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }
                
            }
            elseif ($productData['product_type_id'] == 4) {// arrows
                
                $arrowLengthAttrId = 6;
                $arrowDiameterAttrId = 7;
    
                if (isset($validated['arrow_length'])) {
                    foreach ($validated['arrow_length'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $arrowLengthAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }


                if (isset($validated['arrow_diameter'])) {
                    foreach ($validated['arrow_diameter'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $nextProductId,
                                'attribute_id' => $arrowDiameterAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }
                
            }
            elseif ($productData['product_type_id'] == 5) {// other


            }

            Log::info('Validation passed', $validated);
            
            $product = Product::create($productData);
            Log::info('Product created', $product->toArray());

            if ($product && !empty($specRows)) {
                foreach ($specRows as &$row) {
                    $row['product_id'] = $product->id;
                }
                DB::table('product_specifications')->insert($specRows);
                Log::info('Product specifications inserted', $specRows);
            }

            return redirect()->back()->with('success', 'Product added successfully!');

        } catch (\Exception $e) {
            Log::error('Error in ProductController@store', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }








    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',

            'img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];

         $productTypeId = $product->product_type_id;

        if ($productTypeId == 1) {
            $folderPrefix = 'assets/images/bows/';
        } elseif ($productTypeId == 2) {
            $folderPrefix = 'assets/images/crossbows/';
        } elseif ($productTypeId == 3) {
            $folderPrefix = 'assets/images/slings/';
        } elseif ($productTypeId == 4) {
            $folderPrefix = 'assets/images/arrows/';
        } elseif ($productTypeId == 5) {
            $folderPrefix = 'assets/images/other/';
        }

        $existingImages = [];
        $imagesToRemove = [];

        foreach (['img1', 'img2', 'img3', 'img4'] as $imgField) {
            $removeField = 'remove_' . $imgField;

            if ($request->has($removeField) && $request->$removeField == '1') {
                if (!empty($product->$imgField)) {
                    $imagesToRemove[] = $product->$imgField;
                    $product->$imgField = ''; // clear from DB
                }
            } else {
                if (!empty($product->$imgField)) {
                    $existingImages[] = $product->$imgField;
                }
            }
        }

        foreach (['img1', 'img2', 'img3', 'img4'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $file = $request->file($imgField);
                $filename = $file->getClientOriginalName();
                $file->move(public_path($folderPrefix), $filename);
                $path = $folderPrefix . $filename;
                $existingImages[] = $path;
            }
        }

        if (count($existingImages) < 2) {
            return redirect()->back()->with('error', 'You must have at least 2 images.');
        }

        foreach ($imagesToRemove as $imgPath) {
            $fullPath = public_path($imgPath);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $existingImages = array_pad($existingImages, 4, '');

        $product->img1 = $existingImages[0];
        $product->img2 = $existingImages[1];
        $product->img3 = $existingImages[2];
        $product->img4 = $existingImages[3];

        $product->save();

        return redirect()->route('adminPage')->with('success', 'Product updated successfully.');
    }



    public function index()
    {
        $products = Product::paginate(6);
        return view('searchFilter', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('specifications')->findOrFail($id);


        $bowLengths  = $product->specifications->where('attribute_id', 1)->pluck('value');
        $drawWeights = $product->specifications->where('attribute_id', 2)->pluck('value');
        $orientations= $product->specifications->where('attribute_id', 3)->pluck('value');
        
        $crossbowDrawWeights = $product->specifications->where('attribute_id', 4)->pluck('value');
        
        $slingshotRubberWidth = $product->specifications->where('attribute_id', 5)->pluck('value');
        
        $arrowLength = $product->specifications->where('attribute_id', 6)->pluck('value');
        $arrowDiameter = $product->specifications->where('attribute_id', 7)->pluck('value');

        return view('productPage', compact('product','bowLengths','drawWeights','orientations','crossbowDrawWeights','slingshotRubberWidth','arrowLength','arrowDiameter'));
    }


    public function showAdminPage(Request $request, $type = null)
    {
        $query = Product::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
            $type = null;
        } elseif ($type !== null) {
            $query->where('product_type_id', $type);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        $manufacturers = Manufacturer::all();

        return view('adminPage', compact('products', 'manufacturers', 'type'));
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success','Product deleted successfully!');
    }


    public function searchFilter(Request $request, $type = null)
    {
        $query = DB::table('products')
            ->select('products.*')
            ->leftJoin('product_specifications', 'products.id', '=', 'product_specifications.product_id');

        // Search by name overrides product type
        if ($request->filled('name')) {
            $query->where('products.name', 'LIKE', '%' . $request->input('name') . '%');
            $type = null;
        }

        if (!is_null($type)) {
            $query->where('products.product_type_id', $type);
        }

        // Price filters
        if ($request->filled('price_min')) {
            $query->where('products.price', '>=', $request->input('price_min'));
        }
        if ($request->filled('price_max')) {
            $query->where('products.price', '<=', $request->input('price_max'));
        }

        // Manufacturer filter
        if ($request->filled('manufacturer')) {
            $query->where('products.manufacturer_id', $request->input('manufacturer'));
        }

        // Product specification filters
        $attributeFilters = [
            'bow_draw_weight' => 2,
            'crossbow_draw_weight' => 4,
            'slingshot_rubber_width' => 5,
            'arrow_diameter' => 7,
        ];

        foreach ($attributeFilters as $inputKey => $attributeId) {
            if ($request->filled($inputKey)) {
                $query->where('product_specifications.attribute_id', $attributeId)
                    ->where('product_specifications.value', $request->input($inputKey));
            }
        }

        // Sorting
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('products.price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('products.price', 'desc');
                break;
        }

        $products = $query->distinct('products.id')->paginate(6)->appends($request->query());
        $manufacturers = DB::table('manufacturers')->get();

        $specOptions = [
            'bow_draw_weights' => [1, 2],
            'crossbow_draw_weights' => [2, 4],
            'slingshot_rubber_width' => [3, 5],
            'arrow_diameter' => [4, 7],
        ];

        $bow_draw_weights = $crossbow_draw_weights = $slingshot_rubber_width = $arrow_diameter = [];

        foreach ($specOptions as $var => [$checkType, $attrId]) {
            if ($type == $checkType) {
                $$var = DB::table('product_specifications')
                    ->join('products', 'product_specifications.product_id', '=', 'products.id')
                    ->where('products.product_type_id', $checkType)
                    ->where('product_specifications.attribute_id', $attrId)
                    ->select('product_specifications.value')
                    ->distinct()
                    ->get();
            }
        }

        return view('searchFilter', [
            'products' => $products,
            'selectedType' => $type,
            'searchedName' => $request->name,
            'manufacturers' => $manufacturers,
            'bow_draw_weights' => $bow_draw_weights,
            'crossbow_draw_weights' => $crossbow_draw_weights,
            'slingshot_rubber_width' => $slingshot_rubber_width,
            'arrow_diameter' => $arrow_diameter,
        ]);
    }



}
