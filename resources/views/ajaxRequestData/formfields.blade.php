<div class="ajax-data">
@foreach($products as $key => $product)
    <div class="form-group col-md-6">
        <label class="control-label" for="name">{{($key + 1).'. '.$product->name}}</label>
        <input type="hidden" class="form-control" name="product_id[]" value={{$product->id}}>
        <input type="number" class="form-control" name="number[]"
            placeholder="In stock {{$product->total}}"
            min="0" max="{{$product->total - $product->alertQty}}">
       
    </div>
@endforeach

</div>