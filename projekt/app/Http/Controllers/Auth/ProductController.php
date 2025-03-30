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


                'img1' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'img2' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            Log::info('Validation passed', $validated);


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


            //prida preddefinovanu path k nazvu suboru
            $imgPaths = [];
            foreach (['img1', 'img2', 'img3', 'img4'] as $imgField) {
                if ($request->hasFile($imgField)) {
                    $originalName = $request->file($imgField)->getClientOriginalName();

                    $imgPaths[$imgField] = $folderPrefix . $originalName;
                } else {
                    $imgPaths[$imgField] = '';
                }
            }
            //Log::info('File uploads  processed', $imgPaths);

            // 2) product
            $productData = [
                'product_type_id' => $validated['product_type_id'],
                'manufacturer_id' => $validated['manufacturer_id'],
                'name'            => $validated['name'],
                'description'     => $validated['description'],
                'price'           => $validated['price'],
                'img1'            => $imgPaths['img1'],
                'img2'            => $imgPaths['img2'],
                'img3'            => $imgPaths['img3'],
                'img4'            => $imgPaths['img4'],
            ];

            $product = Product::create($productData);
            Log::info('Product created', $product->toArray());

            // 3) specificke vlastnosti pre produts

            $specRows = [];

            if ($product->product_type_id == 1) {// bow

                $bowLengthAttrId  = 1;
                $drawWeightAttrId = 2;
                $orientationAttrId= 3;

                // bow_length
                if (isset($validated['bow_length'])) {
                    foreach ($validated['bow_length'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $product->id,
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
                                'product_id'   => $product->id,
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
                                'product_id'   => $product->id,
                                'attribute_id' => $orientationAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }


            } elseif ($product->product_type_id == 2) {// crossbow

                $drawWeightAttrId = 2;

                if (isset($validated['draw_weight'])) {
                    foreach ($validated['draw_weight'] as $val) {
                        if (!empty($val)) {
                            $specRows[] = [
                                'product_id'   => $product->id,
                                'attribute_id' => $drawWeightAttrId,
                                'value'        => $val,
                                'created_at'   => now(),
                                'updated_at'   => now(),
                            ];
                        }
                    }
                }
            }
            elseif ($product->product_type_id == 3) {// slings


            }
            elseif ($product->product_type_id == 4) {// arrows


            }
            elseif ($product->product_type_id == 5) {// other


            }

            if (!empty($specRows)) {
                DB::table('product_specifications')->insert($specRows);
                Log::info('Product specifications inserted', $specRows);
            }

            return redirect()->back()->with('success', 'Product added successfully!');

        } catch (\Exception $e) {
            Log::error('Error in ProductController@store', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }








    // UPDATE PRODUKTU

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',

            'img1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

        ]);


        $product->name        = $validated['name'];
        $product->description = $validated['description'];
        $product->price       = $validated['price'];


        $productTypeId = $product->product_type_id;


        if ($request->has('remove_img1')) {
            $product->img1 = '';
        }
        if ($request->has('remove_img2')) {
            $product->img2 = '';
        }
        if ($request->has('remove_img3')) {
            $product->img3 = '';
        }
        if ($request->has('remove_img4')) {
            $product->img4 = '';
        }



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


        foreach (['img1','img2','img3','img4'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $originalName = $request->file($imgField)->getClientOriginalName();


                $product->$imgField = $folderPrefix . $originalName;
            }
        }


        $product->save();

        return redirect()->route('adminPage')->with('success', 'Produkt bol úspešne aktualizovaný.');
    }



    public function index()
    {
        $products = Product::paginate(6);
        return view('searchFilter', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('specifications')->findOrFail($id);//nacita product


        $bowLengths  = $product->specifications->where('attribute_id', 1)->pluck('value');
        $drawWeights = $product->specifications->where('attribute_id', 2)->pluck('value');
        $orientations= $product->specifications->where('attribute_id', 3)->pluck('value');

        return view('productPage', compact('product','bowLengths','drawWeights','orientations'));
    }


    public function showAdminPage()
    {
        $products = Product::paginate(6);
        $manufacturers = Manufacturer::all();
        return view('adminPage', compact('products','manufacturers'));
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success','Product deleted successfully!');
    }


    public function searchFilter($type = null)
    {


        $query = Product::query();

        if ($type) {
            $query->where('product_type_id', $type);
        }


        $products = $query->paginate(6);

        return view('searchFilter', [
            'products' => $products,
            'selectedType' => $type
        ]);
    }

}
