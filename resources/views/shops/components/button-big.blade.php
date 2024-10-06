<div>
    <a id='ed' href="{{ route('shops.edit', $model) }}" class="btn btn-warning btn-sm">Edit Shop</a> |
    <button href="{{ route('shops.destroy', $model) }}" class="btn btn-danger btn-sm" id="delete">Delete Shop</button>
</div>
<x-button-action />