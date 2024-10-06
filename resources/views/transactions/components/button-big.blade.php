<div>
    <a id='ed' href="{{ route('transactions.edit', $model) }}" class="btn btn-warning btn-sm">Edit Transaction</a> |
    <button href="{{ route('transactions.destroy', $model) }}" class="btn btn-danger btn-sm" id="delete">Delete Transaction</button>
</div>
<x-button-action />