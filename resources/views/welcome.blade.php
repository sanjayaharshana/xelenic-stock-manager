<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>








<div class="col-md-12">
    <div class="card p-0">
        <div class="container-fluid card-header no-border">
            <div class="row" style="background: gainsboro;padding-top: 10px;padding-bottom: 10px;">
               <div class="col-md-4">
                   <select id="item-search" class="form-control">
                       <option value="">Search for an item...</option>
                   </select>
               </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Qty" style="height: 29px;border-style: solid;border-color: #aaaaaa;font-size: 13px;">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Discount" style="height: 29px;border-style: solid;border-color: #aaaaaa;font-size: 13px;">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="Unit" style="height: 29px;border-style: solid;border-color: #aaaaaa;font-size: 13px;">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Add Product</button>

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
                    <tr data-key="1" class="row-1">
                        <td class="column-__row_selector__">
                            <input type="checkbox" class="grid-row-checkbox form-check-input row-selector" data-id="1" onchange="admin.grid.select_row(event,this)" autocomplete="off">
                        </td>
                        <td class="column-id">1</td>
                        <td class="column-prduct_name">PineApple</td>
                        <td class="column-qrt">222</td>
                        <td class="column-discount">0.00</td>
                        <td class="column-created_at">10.00</td>
                        <td class="column-updated_at"><input type="text" value="22200.00"></td>
                        <td class="column-__actions__">
                            <div class="__actions__div ">
                                <a href="http://localhost:8000/admin/auth/users/1/edit" class=""><i class="icon-pen"></i><span class="label">Edit</span></a>
                                <a href="http://localhost:8000/admin/auth/users/1" class=""><i class="icon-eye"></i><span class="label">Show</span></a>
                            </div>
                        </td>
                    </tr>



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
                    // Process the result as needed
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
