document.addEventListener('DOMContentLoaded', function() {


    var chooseBtn = document.getElementById('chooseProductBtn');
    chooseBtn.addEventListener('click', function() {
        var productType = document.getElementById('product_type').value;
        if (!productType) {
            alert('Please select a product type.');
            return;
        }

        var chooseModalEl = document.getElementById('modalChooseProduct');
        var chooseModal = bootstrap.Modal.getInstance(chooseModalEl);
        if (chooseModal) {
            chooseModal.hide();
        }

        document.getElementById('product_type_id').value = productType;

        showHideFields(productType);

        var addModalEl = document.getElementById('modalAddProduct');
        var addModal = new bootstrap.Modal(addModalEl);
        addModal.show();
    });


    function showHideFields(productType) {
        // Najprv všetko skryjeme
        document.getElementById('field_bow_length').classList.add('d-none');
        document.getElementById('field_draw_weight').classList.add('d-none');
        document.getElementById('field_orientation').classList.add('d-none');
        document.getElementById('field_crossbow_draw_weight').classList.add('d-none');
        document.getElementById('field_sling_shot_rubber_width').classList.add('d-none');
        document.getElementById('field_arrow_length').classList.add('d-none');
        document.getElementById('field_arrow_diameter').classList.add('d-none');


        switch(productType) {
            case '1':
                document.getElementById('field_bow_length').classList.remove('d-none');
                document.getElementById('field_draw_weight').classList.remove('d-none');
                document.getElementById('field_orientation').classList.remove('d-none');
                break;
            case '2':
                document.getElementById('field_crossbow_draw_weight').classList.remove('d-none');
                break;
            case '3':
                document.getElementById('field_sling_shot_rubber_width').classList.remove('d-none');
                break;
                case '4':
                document.getElementById('field_arrow_length').classList.remove('d-none');
                document.getElementById('field_arrow_diameter').classList.remove('d-none');
                break;
            case '5':
                break;

        }
    }


    var bowLengths = [];
    var drawWeights = [];
    var orientations = [];
    var crossbow_draw_weight_list = [];
    var sling_shot_rubber_width_list = [];
    var arrow_length_list = [];
    var arrow_diameter_list = [];
    var addProductForm = document.getElementById('addProductForm');

    function updateListsDisplay() {
        document.getElementById('bowLengthList').textContent =
            bowLengths.length ? 'Bow lengths: ' + bowLengths.join(', ') : '';
        document.getElementById('drawWeightList').textContent =
            drawWeights.length ? 'Draw weights: ' + drawWeights.join(', ') : '';
        document.getElementById('orientationList').textContent =
            orientations.length ? 'Orientations: ' + orientations.join(', ') : '';
        document.getElementById('crossbowDrawWeightList').textContent =
            crossbow_draw_weight_list.length ? 'Draw weights: ' + crossbow_draw_weight_list.join(', ') : '';
        document.getElementById('sling_shot_rubber_width_List').textContent =
            sling_shot_rubber_width_list.length ? 'Rubber widths: ' + sling_shot_rubber_width_list.join(', ') : '';
        document.getElementById('arrow_length_List').textContent =
            arrow_length_list.length ? 'Arrow lengths : ' + arrow_length_list.join(', ') : '';
        document.getElementById('arrow_diameter_List').textContent =
            arrow_diameter_list.length ? 'Arrow diameters: ' + arrow_diameter_list.join(', ') : '';
    }


    document.getElementById('addBowLengthButton').addEventListener('click', function() {
        var input = document.getElementById('bow_length_input');
        var val = input.value.trim();
        if (val && val > 0) {
            bowLengths.push(val);
            input.value = '';
            updateListsDisplay();

            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'bow_length[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });


    document.getElementById('addDrawWeightButton').addEventListener('click', function() {
        var input = document.getElementById('draw_weight_input');
        var val = input.value.trim();
        if (val && val > 0) {
            drawWeights.push(val);
            input.value = '';
            updateListsDisplay();

            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'draw_weight[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });
    
    
    document.getElementById('addOrientationButton').addEventListener('click', function() {
        var select = document.getElementById('orientation_select');
        var val = select.value;
        if (val && !orientations.includes(val)) {
            orientations.push(val);
            updateListsDisplay();
            
            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'orientation[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });
    
    
    document.getElementById('addCrossbowDrawWeightButton').addEventListener('click', function() {
        var input = document.getElementById('crossbow_draw_weight_input');
        var val = input.value.trim();
        if (val && val > 0) {
            crossbow_draw_weight_list.push(val);
            input.value = '';
            updateListsDisplay();

            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'crossbow_draw_weight[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });


    document.getElementById('addCrossbowDrawWeightButton').addEventListener('click', function() {
        var input = document.getElementById('crossbow_draw_weight_input');
        var val = input.value.trim();
        if (val && val > 0) {
            crossbow_draw_weight_list.push(val);
            input.value = '';
            updateListsDisplay();
            
            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'crossbow_draw_weight[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });
    

    document.getElementById('add_sling_shot_rubber_widthButton').addEventListener('click', function() {
        var input = document.getElementById('sling_shot_rubber_width_input');
        var val = input.value.trim();
        if (val && val > 0) {
            sling_shot_rubber_width_list.push(val);
            input.value = '';
            updateListsDisplay();

            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'slingshot_rubber_width[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });


    document.getElementById('add_arrow_lengthButton').addEventListener('click', function() {
        var input = document.getElementById('arrow_length_input');
        var val = input.value.trim();
        if (val && val > 0) {
            arrow_length_list.push(val);
            input.value = '';
            updateListsDisplay();

            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'arrow_length[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });


    document.getElementById('add_arrow_diameterButton').addEventListener('click', function() {
        var input = document.getElementById('arrow_diameter_input');
        var val = input.value.trim();
        if (val && val > 0) {
            arrow_diameter_list.push(val);
            input.value = '';
            updateListsDisplay();

            var hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'arrow_diameter[]';
            hidden.value = val;
            addProductForm.appendChild(hidden);
        }
    });


    var confirmButton = document.getElementById('confirmButton');
    confirmButton.addEventListener('click', function() {
        var product_type_id = document.getElementById('product_type_id').value

        if(document.getElementById('product_name').value.trim() === ""){
            alert('Please add a product name!');
            return;
        }
        if(document.getElementById('product_description').value.trim() === ""){
            alert('Please add a product description!');
            return;
        }
        if(document.getElementById('product_price').value <= 0){
            alert('The product price must not be less than or equal to 0!');
            return;
        }

        switch(product_type_id) {
            case '1':
                if(bowLengths.length === 0){
                    alert('Please add bow lengths!');
                    return;
                }
                if(drawWeights.length === 0){
                    alert('Please add bow draw weights!');
                    return;
                }
                if(orientations.length === 0){
                    alert('Please add bow orientations!');
                    return;
                }
                break;
            case '2':
                if(crossbow_draw_weight_list.length === 0){
                    alert('Please add crossbow draw weights!');
                    return;
                }
                break;
            case '3':
                if(sling_shot_rubber_width_list.length === 0){
                    alert('Please add slingshot rubber widths!');
                    return;
                }
                break;
            case '4':
                if(arrow_diameter_list.length === 0){
                    alert('Please add arrow diamaters!');
                    return;
                }
                if(arrow_length_list.length === 0){
                    alert('Please add arrow lenghts!');
                    return;
                }
                break;
            case '5':
                break;

        }

        var photo_count = 0;
        var p1 = document.getElementById('Photo1').files;
        var p2 = document.getElementById('Photo2').files;
        var p3 = document.getElementById('Photo3').files;
        var p4 = document.getElementById('Photo4').files;
        (p1.length)?photo_count++ : photo_count;
        (p2.length)?photo_count++ : photo_count;
        (p3.length)?photo_count++ : photo_count;
        (p4.length)?photo_count++ : photo_count;
        if (photo_count<2) {
            alert('Please select at least 2 photos!');
            return;
        }
        addProductForm.submit();
    });


    var discardBtn = document.getElementById('discardButton');
    discardBtn.addEventListener('click', function() {
        addProductForm.reset();
        bowLengths = [];
        drawWeights = [];
        orientations = [];
        updateListsDisplay();
    });


    var modalDelete = document.getElementById('modalDelete');
    modalDelete.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute('data-product-id');
        var productName = button.getAttribute('data-product-name');
        var productImg = button.getAttribute('data-product-img');
        var productDescription = button.getAttribute('data-product-description');
        var productPrice = button.getAttribute('data-product-price');

        document.getElementById('delete_modal_product_heading').textContent = productName;
        document.getElementById('delete_modal_product_foto').src = productImg;
        document.getElementById('delete_modal_product_description').textContent = productDescription;
        document.getElementById('delete_modal_product_price').textContent = productPrice;

        var form = document.getElementById('deleteProductForm');
        form.action = '/admin/products/' + productId;
    });

    document.getElementById('edit_modal_submit_btn').addEventListener('click',function(){
        var productPrice = document.getElementById('edit_price').value;
        if (!isNaN(productPrice) && productPrice > 0){
            document.getElementById('editBowForm').submit();
        }
        else{
            alert("The product price must be numeric and greater than 0!");
        }
    });

    var editModal = document.getElementById('modalModify');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productId = button.getAttribute('data-product-id');
        var productName = button.getAttribute('data-product-name');
        var productDescription = button.getAttribute('data-product-description');
        var productPrice = button.getAttribute('data-product-price');
        var imagesData = button.getAttribute('data-product-images') || '[]';
        var productImages = JSON.parse(imagesData);

        var form = document.getElementById('editBowForm');
        form.action = '/admin/products/' + productId;

        document.getElementById('edit_name').value = productName;
        document.getElementById('edit_description').value = productDescription;
        document.getElementById('edit_price').value = productPrice;

        var container = document.getElementById('existingImagesContainer');
        container.innerHTML = '';

        productImages.forEach(function (imgSrc, index) {
            var slotNumber = index + 1;

            var wrapper = document.createElement('div');
            wrapper.className = 'd-flex flex-column align-items-center mb-3';


            var label = document.createElement('div');
            label.className = 'fw-bold mb-1';
            label.textContent = 'IMG' + slotNumber;
            wrapper.appendChild(label);

            if (imgSrc && !imgSrc.endsWith('/')) {
                var imageEl = document.createElement('img');
                imageEl.src = imgSrc;
                imageEl.alt = 'Existing Image ' + slotNumber;
                imageEl.style.width = '100px';
                imageEl.className = 'img-thumbnail mb-1';

                var removeWrapper = document.createElement('div');
                removeWrapper.className = 'd-flex align-items-center';

                var cbInput = document.createElement('input');
                cbInput.type = 'checkbox';
                cbInput.name = 'remove_img' + slotNumber;
                cbInput.value = '1';
                cbInput.className = 'form-check-input ms-2';

                var cbLabel = document.createElement('label');
                cbLabel.textContent = 'Remove';
                cbLabel.className = 'ms-1';

                removeWrapper.appendChild(cbInput);
                removeWrapper.appendChild(cbLabel);

                wrapper.appendChild(imageEl);
                wrapper.appendChild(removeWrapper);


            } else {

                var input = document.createElement('input');
                input.type = 'file';
                input.name = 'img' + slotNumber;
                input.className = 'form-control';
                wrapper.appendChild(input);
            }

            container.appendChild(wrapper);
        });
    });




});
