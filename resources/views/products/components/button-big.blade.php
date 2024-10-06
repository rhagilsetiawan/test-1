<div>
    <a id='ed' href="{{ route('products.edit', $model) }}" class="btn btn-warning btn-sm">Edit Product</a> |
    <button href="{{ route('products.destroy', $model) }}" class="btn btn-danger btn-sm" id="delete">Delete Product</button>
</div>
<x-button-action />