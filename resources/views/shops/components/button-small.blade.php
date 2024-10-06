
<div>
    <a id='ed' href="{{ route('shops.edit', $model) }}" class="btn btn-warning btn-sm">
        <i class="fa-solid fa-pen-to-square"></i>
    </a> |
    <button href="{{ route('shops.destroy', $model) }}" class="btn btn-danger btn-sm" id="delete">
        <i class="fa-solid fa-delete-left"></i>
    </button>
</div>
<x-button-action />