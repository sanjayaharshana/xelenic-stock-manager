<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



<div class="col-md-12">
    <div class="card p-0">
        <div class="container-fluid card-header no-border">
            <div class="row" style="background: gainsboro;padding-top: 10px;padding-bottom: 10px;">
               <div class="col-md-4">
                   <small>Select Product</small>
                   <select id="item-search" class="form-control">
                       <option value=""></option>
                   </select>
               </div>
                <div class="col-md-2">
                    <small>Select Qty</small>
                    <input id='qty_add_product_box' value="1" type="number" max="10000" min="1" class="form-control" placeholder="Qty" style="height: 29px;border-style: solid;border-color: #aaaaaa;font-size: 13px;">
                </div>
                <div class="col-md-2">
                    <small>Discount</small>
                    <input id="discount_add_product_box" type="text" value="0.00" class="form-control" placeholder="Discount" style="height: 29px;border-style: solid;border-color: #aaaaaa;font-size: 13px;">
                </div>
                <div class="col-md-2">
                    <small>Unit Price</small>
                    <input id="unit_price" type="text" class="form-control" value="0.00" placeholder="Unit" style="height: 29px;border-style: solid;border-color: #aaaaaa;font-size: 13px;">
                </div>
                <div class="col-md-2">
                    <br>
                    <a id="add_products_pruchase_line" class="btn btn-primary">Add Product</a>

                </div>
            </div>
        </div>
        <div class="with-border collapse  filter-box" id="filter-box">
            <form action="http://localhost:8000/admin/auth/users" class="form pt-0 form-horizontal has-ajax-handler" pjax-container="" method="get" autocomplete="off">

                <div class="row mb-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="fields-group">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label"> ID</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">

                                            <div class="input-group-text with-icon">
                                                <i class="icon-pencil-alt"></i>
                                            </div>

                                            <input type="text" class="form-control id" placeholder="ID" name="id" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="table-responsive" autocomplete="off">
            <table class="table grid-table table-sm table-hover select-table" id="grid-table65ed24335039f">

                <thead>
                    <tr>
                        <th class="column-__row_selector__"> <input type="checkbox" class="grid-select-all form-check-input" onchange="admin.grid.select_all(event,this)" id="grid-select-all">&nbsp;</th>
                        <th class="column-id">ID<a class="icon-fw icon-sort" href="http://localhost:8000/admin/auth/users?_sort%5Bcolumn%5D=id&amp;_sort%5Btype%5D=desc"></a></th>
                        <th class="column-username">Product Name</th>
                        <th class="column-name">Qty</th>
                        <th class="column-roles">Discount</th>
                        <th class="column-created_at">U.Price</th>
                        <th class="column-updated_at">Total (LKR)</th>
                        <th class="column-__actions__">Action</th>
                    </tr>
                </thead>

                <tbody id="product_lines">




                </tbody>
            </table>
        </div>

    </div>
    <!-- /.box-body -->
</div>

<script>
    $(document).ready(function() {
        $('#item-search').select2({
            placeholder: 'Search for an item...',
            ajax: {
                url: '{{ route("search.items") }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        })
                    };
                },
                cache: true
            }
        });

        $('#item-search').on('select2:select', function(e) {
            var selectedId = e.params.data.id;

            $.ajax({
                url: '{{ route("get_product_details") }}',
                type: 'GET',
                data: {
                    id: selectedId
                },
                success: function(result) {
                    console.log(result);
                    $('#unit_price').val(result.list_price);
                    // Process the result as needed
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#add_products_pruchase_line').click(function() {
            var itemName; // Declare itemName globally

            // Your code here
            var item = $('#item-search')





            var itemId = item.val();
            var qty = $('#qty_add_product_box').val();
            var discount = $('#discount_add_product_box').val();
            var unitPrice = $('#unit_price').val();

            // Validate the fields
            if (item === ''){
                alert('Please select an item.');
                return;
            }
            if (qty === '' || qty === "0") {
                alert('Please enter a quantity.');
                return;
            }
            if (discount === '') {
                alert('Please enter a discount.');
                return;
            }
            if (unitPrice === '') {
                alert('Please enter a unit price.');
                return;
            }



            $.ajax({
                url: '{{ route("get_product_details") }}',
                type: 'GET',
                data: {
                    id: itemId
                },
                success: function(result) {
                    var itemName = result.name;
                    // Process the result as needed
                    addProductLine(itemId, itemName, qty, discount, unitPrice);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            console.log(itemName);

        });

        function addProductLine(itemId,itemName, qty, discount, unitPrice) {
            discount = parseFloat(discount); // Convert string to a floating-point number
            unitPrice = parseFloat(unitPrice); // Convert string to a floating-point number

            console.log('serve');
            var total = (qty * unitPrice) - discount;
            var newRow = '<tr data-key="1" class="row-1">' +
                            '<td class="column-__row_selector__">' +
                                '<input type="checkbox" class="grid-row-checkbox form-check-input row-selector" data-id="1" onchange="admin.grid.select_row(event,this)" autocomplete="off">' +
                            '</td>' +
                              '<td class="column-id">'+ itemId +'</td>'+
                              '<td class="column-prduct_name">'+ itemName +'</td>' +
                              '<td class="column-qrt">'+ qty +'</td>' +
                              '<td class="column-discount">' + discount + '</td>' +
                              '<td class="column-created_at">'+ unitPrice +'</td>' +
                              '<td class="column-updated_at"><input type="text" value="'+ total  +'"></td>' +
                              '<td class="column-__actions__">' +
                              '<div class="__actions__div ">' +
                                  '<a href="http://localhost:8000/admin/auth/users/1/edit" class="">' +
                                    '<i class="icon-pen"></i><span class="label">Edit</span>' +
                                  '</a>' +
                                  '<a href="http://localhost:8000/admin/auth/users/1" class="">'+
                                    '<i class="icon-eye"></i><span class="label">Show</span>' +
                                  '</a>' +
                              '</div>' +
                              '</td>' +
                            '</tr>';
            $('#product_lines').append(newRow);
        }

    });
</script>
