<head>
  <title><?= $form->forms_title?> | nSmarTrac Form</title>
  <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    .form-group{
      margin: 0
    }

    .form-control{
      height: 1.5em
    }

    .custom-select{
      height: 1.5em;
      padding: 0 10px;
    }

    label{
      font-weight: 500
    }

    p{
      font-weight: 500;
    }

    .table td{
      padding: 0
    }


    
    @media print{
      @page{
        margin: 0,
      }
      body{
        margin: 0
      }
    };
  </style>
  
</head>
<body>
  
  <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />

  <div class="container">
    <div class="card">
      <div class="card-body">
        
        
          <?= form_open_multipart('form/submit/'.$form->forms_id, array("id" => "formMain"));?>
            <div id="windowPreviewcontent" class="row"></div>
          <?php
            if(!isset($_GET["preview"])){
              ?>
                <button type="submit" id="btnFormSubmit" class="btn btn-success btn-block my-2"><i class="fa fa-arrow-circle-up"></i> Submit</button>
                <button id="btnRedo" class="btn btn-link btn-block text-muted">I want to answer this form from scratch again</button>
              <?php
            }
          ?>
        <?= form_close();?>
      </div>

    </div>
  </div>


  <script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="<?= base_url()?>/assets/js/formbuilder.js"></script>
  <script>
    var selectedProducts = []
    var totalPrice = 0
    var tax = 0.25
    
    window.onload = () => {
      loadFormElements(<?= $form->forms_id?>);
    }

    calculateTotalPrices = elementId => {
      subTotalPrice = 0
      selectedProducts.map(product => {
        subTotalPrice += (product.quantity * product.data.price)
      })
      
      totalPrice = subTotalPrice + (subTotalPrice * tax) ;
      document.querySelector(`#table-product-tax-addition-${elementId}`).innerHTML = `Tax: <strong>${tax * 100}%</strong> (+ $${(subTotalPrice * tax).toFixed(2)})`
      document.querySelector(`#table-product-total-price-all-${elementId}`).innerHTML = `Total: <strong>$${totalPrice.toFixed(2)}</strong>`
    }

    addQuantity = (elementId, productId) => {
      selectedProducts.map((product,i) => {
        if( product.data.id == productId){
          
          selectedProducts[i].quantity++
          document.querySelector(`#table-product-quantity-text-${productId}`).innerHTML = product.quantity;
          document.querySelector(`#table-product-total-price-${productId}`).innerHTML = `<strong>$${(product.quantity * product.data.price).toFixed(2)}</strong> <button type="button" onclick="deleteProductFromTable(${elementId}, ${productId})" class="btn btn-danger"><i class="fa fa-trash"></i></button>`;
          calculateTotalPrices(elementId)
        }
      })
    }

    decreaseQuantity = (elementId, productId) => {
      selectedProducts.map((product,i) => {
        if( product.data.id == productId){
          if(product.quantity > 1){
            selectedProducts[i].quantity--
            document.querySelector(`#table-product-quantity-text-${productId}`).innerHTML = product.quantity;
            document.querySelector(`#table-product-total-price-${productId}`).innerHTML = `<strong>$ ${(product.quantity * product.data.price).toFixed(2)}</strong> <button type="button" onclick="deleteProductFromTable(${elementId}, ${productId})" class="btn btn-danger"><i class="fa fa-trash"></i></button>`;
          }
        }
      })
      calculateTotalPrices(elementId)
    }
    
    addProductToTable = (elementId) => {
      let value = document.querySelector(`#selProduct-${elementId}`).value
      let temp = productsList.find(product => { return product.id == value })
      document.querySelector(`#table-product-list-${elementId}`).innerHTML += `
      <tr>
        <td><strong>${temp.title} ${(temp.brand == "")?``:`${temp.brand}`}</strong></td>
        <td>
          <button type="button" id="btnDecreaseQuantity${temp.id}" onclick="decreaseQuantity(${elementId}, ${temp.id})" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></button>
          <span id="table-product-quantity-text-${temp.id}">1</span>
          <button type="button" id="btnAddQuantity${temp.id}" onclick="addQuantity(${elementId}, ${temp.id})" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></button>
        </td>
        <td>$${temp.price}</td>
        <td id="table-product-total-price-${temp.id}" class="text-right">
          <strong>
            $${temp.price}
          </strong>
          <button type="button" id="btnDelete${temp.id}" onclick="deleteProductFromTable(${elementId}, ${temp.id})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        </td>
      </tr>
      `;
      selectedProducts.push({
        elementId: elementId,
        quantity: 1,
        data:temp
      });
      calculateTotalPrices(elementId)
    }

    deleteProductFromTable = (elementId, productId) => {
      document.querySelector(`#table-product-list-${elementId}`).innerHTML = ``;
      console.log(selectedProducts);
      selectedProducts.map((product, i) => {
        if(product.data.id == productId){
          selectedProducts.splice(i, 1);
        }
      }) 
      calculateTotalPrices(elementId)

      selectedProducts.map(temp => {
        document.querySelector(`#table-product-list-${elementId}`).innerHTML += `
          <tr>
            <td><strong>${temp.data.title} ${(temp.data.brand == "")?``:`${temp.data.brand}`}</strong></td>
            <td>
              <button type="button" id="btnDecreaseQuantity${temp.data.id}" onclick="decreaseQuantity(${elementId}, ${temp.data.id})" class="btn btn-secondary"><i class="fa fa-minus"></i></button>
              <span id="table-product-quantity-text-${temp.data.id}">${temp.quantity}</span>
              <button type="button" id="btnAddQuantity${temp.data.id}" onclick="addQuantity(${elementId}, ${temp.data.id})" class="btn btn-secondary"><i class="fa fa-plus"></i></button>
            </td>
            <td>
              $${temp.data.price}</td>
            <td id="table-product-total-price-${temp.data.id}" class="text-right">
              <strong>
                $${temp.data.price}
              </strong>
              <button type="button" id="btnDelete${temp.id}"  onclick="deleteProductFromTable(${elementId}, ${temp.data.id})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </td>
          </tr>
        `;
      })
    }

// might add form products table for this one

    fetchProducts = () => {
      let temp = []
      $.ajax({
        async: false,
        url: `${formBaseUrl}formbuilder/form/element/products`,
        dataType: 'json',
        type: 'GET'
      })
      .done( function( data, textStatus){
        temp = data.data
      })
      return temp
    }

    var productsList = fetchProducts();

    getProductSelection = elementId => {
      setTimeout(() => {
        productsList.map(product => {
          document.querySelector(`#selProduct-${elementId}`).innerHTML += `<option value="${product.id}">${product.title}</option>`
        })
      }, 500);
    }
    
    
    <?php
      if(!isset($_GET["preview"])){
        ?>
          document.querySelector('#btnFormSubmit').addEventListener("click", (e) => {
            selectedProducts.map(product => {
              let data = {
                "fp_form_id": <?= $form->forms_id?>,
                "fp_element_id": product.elementId,
                "fp_item_id": product.data.id,
                "fp_quantity": product.quantity,
                "fp_total_price": product.quantity * product.data.price 
              }
              
              $.ajax({
                async: false,
                data: data,
                url: `${formBaseUrl}formbuilder/form/element/products/add`,
                dataType: 'json',
                type: 'POST'
              })
            })

            window.alert("form submitted")
          })


        <?php
      }
    ?>
    

  </script>
</body>
