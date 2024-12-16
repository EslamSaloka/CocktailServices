<a class="btn btn-sm btn-danger" onclick="deleteRow('{{$url}}')" data-bs-toggle="modal" data-bs-target="#deleteModal">
    @if (request()->is("*dashboard*"))
        <i class="fe fe-trash" style="color: white"></i>
    @else
        حذف
    @endif
</a>
