<div class="row ajax-data">
    <div class="col-md-12">
        <div class="panel panel-bordered" style="padding-bottom:5px;">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Number</th>
                        </tr>
                    </thead>
                    @php $i = 1 @endphp
                    @foreach($uniqueProducts as $item)
                    @php
                        $product = \App\Models\Product::findOrFail($item['product_id']);
                    @endphp
                    <input name="product_id[]" type="hidden" value="{{$item['product_id']}}">
                    <tbody>
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->pdt_code}}</td>
                            <td><input name="numbers[]" type="number" value="" min="0" max="{{$item['total_products']}}"
                                class="form-control" placeholder="{{$item['total_products']}}"></td>
                        </tr>
                    </tbody>
                    @php $i++ @endphp
                    @endforeach
                    <tbody>
                        <tr>
                            <td ><button type="submit" class="btn btn-primary">Return</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>