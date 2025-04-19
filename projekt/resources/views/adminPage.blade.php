@extends('layouts.app')

@section('content')
    <!-- navbar -->
    <nav class="navbar navbar-expand-sm navbar-light mb-2 bg-dark">
        <div class="container d-flex align-items-center justify-content-between flex-nowrap">
            <div class="d-flex align-items-center flex-nowrap">
                <a href="#" class="me-3">
                    <img class="img-fluid" style="width:60px;" src="assets/images/logo.svg" alt="logo">
                </a>
                <h1 class="mb-0 fs-4"><a href="#" class="text-white text-decoration-none">LukEshop</a></h1>
            </div>
            <div></div>
            <h1 class="pe-5 text-white">Admin</h1>
            <div></div>
            <div class="d-flex align-items-center flex-nowrap">
                <a type="button" class="btn btn-danger d-flex align-items-center" href="{{ route('index') }}">
                    <i class="bi bi-person-dash fs-4 me-2"></i>Log out
                </a>
            </div>
        </div>
    </nav>

    <!-- search box and shopping cart icon -->
    <div class="container d-flex align-items-center justify-content-between rounded-2 shadow bg-dark">
        <form action="{{ route('adminPage') }}" method="GET" class="flex-grow-1 d-flex justify-content-center ps-5">
            <div class="py-2 d-flex w-100" style="max-width: 700px;">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control me-2" placeholder="Search box" />
                <button type="submit" class="btn btn-light">Search</button>
            </div>
        </form>

        <div>
            <h2 class="mb-0 px-1">
                <a href="{{ route('shoppingCart') }}" class="text-dark">
                    <i class="bi bi-bag-fill"></i>
                </a>
            </h2>
        </div>
    </div>

  <!-- quick select -->
  <div class="container rounded-2 p-3 my-2 shadow bg-dark">
    <div class="row g-3">
      <div class="col-6 col-md">
          <a type="button" class="btn {{ $type == 1 ? 'btn-secondary' : 'btn-light' }} w-100" href="{{ route('adminPage',1) }}">Luky</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn {{ $type == 2 ? 'btn-secondary' : 'btn-light' }} w-100" href="{{ route('adminPage',2) }}">Kuše</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn {{ $type == 3 ? 'btn-secondary' : 'btn-light' }} w-100" href="{{ route('adminPage',3) }}">Praky</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn {{ $type == 4 ? 'btn-secondary' : 'btn-light' }} w-100" href="{{ route('adminPage',4) }}">Šípy</a>
      </div>
      <div class="col-6 col-md">
        <a type="button" class="btn {{ $type == 5 ? 'btn-secondary' : 'btn-light' }} w-100" href="{{ route('adminPage',5) }}">Príslušenstvo</a>
      </div>
    </div>
  </div>

    <div class="container d-flex justify-content-center">
        <div class="btn btn-danger fs-5 px-3 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#modalChooseProduct">
            <i class="bi bi-folder-plus"></i> Add Item
        </div>
    </div>

    <!-- PRODUKTY NA ADMIN PAGE-->
    <div class="container bg-dark rounded-2 gap-3 p-2">
        @foreach($products as $product)
            <div class="bg-white rounded-3 p-2 d-flex justify-content-center mb-2">
                <div class="row w-100">
                    <!-- Image Column -->
                    <div class="col-12 col-md-2 text-center mb-3 mb-md-0" style="overflow: hidden;">
                        <img src="{{ asset($product->img1) }}" class="img-fluid bg-light rounded-2 shadow" style="height: 200px; width: auto; object-fit: cover;" alt="Product image">
                    </div>
                    <!-- Description + Buttons Column -->
                    <div class="col-9 col-md-10 d-flex flex-column">
                        <div>
                            <h3 class="py-2">{{ $product->name }}</h3>
                            <span>{{ $product->description }}</span><br>
                        </div>
                        <!-- Buttons aligned at the bottom -->
                        <div class="d-flex justify-content-between mt-auto gap-2">
                            <div>
                                <button class="btn btn-warning active">
                                    Price : {{ number_format($product->price, 2) }}€
                                </button>
                            </div>
                            <div>
                                <!-- EDIT BUTTON -->
                                <button class="btn btn-outline-secondary me-2"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalModify"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-description="{{ $product->description }}"
                                        data-product-price="{{ number_format($product->price, 2) }}"
                                        data-product-images="{{ json_encode([$product->img1, $product->img2, $product->img3, $product->img4]) }}">
                                    <i class="bi bi-gear"></i> Edit
                                </button>
                                <!-- DELETE BUTTON -->
                                <button class="btn btn-outline-danger"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-img="{{ asset($product->img1) }}"
                                        data-product-description="{{ $product->description }}"
                                        data-product-price="{{ number_format($product->price, 2) }}€">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>








    <!-- CHOOSE PRODUCT MODAL  -->
    <div class="modal fade" id="modalChooseProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chooseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="chooseModalLabel">
                        <i class="bi bi-folder-plus"></i> Add new product
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="was-validated">
                        <label for="product_type" class="col-4 col-form-label">Product type</label>
                        <div class="col">
                            <select id="product_type" name="product_type" class="form-select" required>
                                <option value="" selected disabled>Select type</option>
                                <option value="1">Luk</option>
                                <option value="2">Kuša</option>
                                <option value="3">Prak</option>
                                <option value="4">Šíp</option>
                                <option value="5">Ostatné</option>
                            </select>
                        </div>
                        <div class="modal-footer d-flex justify-content-between px-5">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="chooseProductBtn">
                                <i class="bi bi-journal-bookmark me-2"></i> Choose
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <!-- ADD PRODUCT MODAL -->
    <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalAddProductLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light">
                    <form id="addProductForm" class="was-validated" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="product_type_id" id="product_type_id" value="">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="product_name" required>
                        </div>


                        <!-- Manufacturer -->
                        <div class="mb-3">
                            <label class="form-label">Manufacturer</label>
                            <select name="manufacturer_id" id="product_manufacturer" class="form-select" required>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="product_description" rows="3" required></textarea>
                        </div>


                        <!-- Price -->
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="product_price" step="0.01" required>
                        </div>



                        <!-- BOW_LENGTH -->
                        <div class="mb-3 d-none" id="field_bow_length">
                            <label class="form-label">Bow length</label>
                            <div class="input-group">
                                <input type="text" id="bow_length_input" class="form-control" placeholder="Enter bow length">
                                <button type="button" id="addBowLengthButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="bowLengthList" class="text-muted"></small>
                        </div>


                        <!-- DRAW_WEIGHT BOW -->
                        <div class="mb-3 d-none" id="field_draw_weight">
                            <label class="form-label">Draw weight</label>
                            <div class="input-group">
                                <input type="text" id="draw_weight_input" class="form-control" placeholder="Enter draw weight">
                                <button type="button" id="addDrawWeightButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="drawWeightList" class="text-muted"></small>
                        </div>



                        <!-- ORIENTATION -->
                        <div class="mb-3 d-none" id="field_orientation">
                            <label class="form-label">Orientation</label>
                            <div class="input-group">
                                <select id="orientation_select" class="form-select">
                                    <option value="">Select orientation</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                    <option value="universal">Universal</option>
                                </select>
                                <button type="button" id="addOrientationButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="orientationList" class="text-muted"></small>
                        </div>

                        <!-- DRAW_WEIGHT CROSSBOW -->
                        <div class="mb-3 d-none" id="field_crossbow_draw_weight">
                            <label class="form-label">Draw weight</label>
                            <div class="input-group">
                                <input type="text" id="crossbow_draw_weight_input" class="form-control" placeholder="Enter draw weight">
                                <button type="button" id="addCrossbowDrawWeightButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="crossbowDrawWeightList" class="text-muted"></small>
                        </div>


                        <!-- SLINGSHOT RUBBER WIDTH -->
                        <div class="mb-3 d-none" id="field_sling_shot_rubber_width">
                            <label class="form-label">Rubber Width</label>
                            <div class="input-group">
                                <input type="text" id="sling_shot_rubber_width_input" class="form-control" placeholder="Enter Rubber Width">
                                <button type="button" id="add_sling_shot_rubber_widthButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="sling_shot_rubber_width_List" class="text-muted"></small>
                        </div>




                        <!-- ARROW LENGTH -->
                        <div class="mb-3 d-none" id="field_arrow_length">
                            <label class="form-label">Arrow Length</label>
                            <div class="input-group">
                                <input type="text" id="arrow_length_input" class="form-control" placeholder="Enter Arrow Length">
                                <button type="button" id="add_arrow_lengthButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="arrow_length_List" class="text-muted"></small>
                        </div>

                        <!-- ARROW DIAMETER -->
                        <div class="mb-3 d-none" id="field_arrow_diameter">
                            <label class="form-label">Arrow Diameter</label>
                            <div class="input-group">
                                <input type="text" id="arrow_diameter_input" class="form-control" placeholder="Enter Arrow Diameter">
                                <button type="button" id="add_arrow_diameterButton" class="btn btn-outline-secondary">Add</button>
                            </div>
                            <small id="arrow_diameter_List" class="text-muted"></small>
                        </div>





                        <!-- Photo1 - Photo4 -->
                        <div class="mb-3">
                            <label class="form-label">Photo1</label>
                            <input type="file" class="form-control" name="img1" id="Photo1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo2</label>
                            <input type="file" class="form-control" name="img2" id="Photo2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo3</label>
                            <input type="file" class="form-control" name="img3" id="Photo3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo4</label>
                            <input type="file" class="form-control" name="img4" id="Photo4">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="discardButton">Discard</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>




    <!-- EDIT MODAL -->
    <div class="modal fade" id="modalModify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBowForm" method="POST" action="{{ route('admin.products.update', ['product' => 'id_here']) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- PRODUCT NAME -->
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="edit_name" required>
                        </div>

                        <!-- PRODUCT DESC -->
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="edit_description" rows="3" required></textarea>
                        </div>

                        <!-- PRODUCT PRICE -->
                        <div class="mb-3">
                            <label for="edit_price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="edit_price" step="0.01" required>
                        </div>

                        <!-- EXISTING IMAGES SECTION -->
                        <div class="mb-3">
                            <label class="form-label">EXISTING IMAGES</label>
                            <div class="d-flex flex-wrap gap-4" id="existingImagesContainer">
                                <!-- doplnene v adminPageScripts -->
                            </div>
                        </div>


                        <div class="my-4 border-top"></div>




                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- DELETE MODAL -->
    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Permanently delete this product?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center g-2">
                        <div class="col-4">
                            <img id="delete_modal_product_foto" class="img-fluid" src="" alt="Product Image">
                        </div>
                        <div class="col">
                            <h4 id="delete_modal_product_heading" class="py-3"></h4>
                            <span id="delete_modal_product_description"></span><br>
                            <span id="delete_modal_product_price"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between px-5">
                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">No</button>
                    <form id="deleteProductForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-trash me-2"></i>Yes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
