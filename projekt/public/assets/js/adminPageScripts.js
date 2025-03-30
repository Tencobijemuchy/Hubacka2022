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


        switch(productType) {
            case '1':
                document.getElementById('field_bow_length').classList.remove('d-none');
                document.getElementById('field_draw_weight').classList.remove('d-none');
                document.getElementById('field_orientation').classList.remove('d-none');
                break;
            case '2':
                document.getElementById('field_draw_weight').classList.remove('d-none');
                break;

        }
    }


    var bowLengths = [];
    var drawWeights = [];
    var orientations = [];
    var addProductForm = document.getElementById('addProductForm');

    function updateListsDisplay() {
        document.getElementById('bowLengthList').textContent =
            bowLengths.length ? 'Bow lengths: ' + bowLengths.join(', ') : '';
        document.getElementById('drawWeightList').textContent =
            drawWeights.length ? 'Draw weights: ' + drawWeights.join(', ') : '';
        document.getElementById('orientationList').textContent =
            orientations.length ? 'Orientations: ' + orientations.join(', ') : '';
    }


    document.getElementById('addBowLengthButton').addEventListener('click', function() {
        var input = document.getElementById('bow_length_input');
        var val = input.value.trim();
        if (val) {
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
        if (val) {
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


    var confirmButton = document.getElementById('confirmButton');
    confirmButton.addEventListener('click', function() {

        var p1 = document.getElementById('Photo1').files;
        var p2 = document.getElementById('Photo2').files;
        if (!p1.length || !p2.length) {
            alert('Please select Photo1 and Photo2');
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

            if (imgSrc) {

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
