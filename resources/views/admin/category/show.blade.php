<table class="table table-hover">

    <tr>
        <th>Category Name</th>
        <td>{{ $model->category_name }}</td>
    </tr>
    <tr>
        <th>Category Name (नेपाली)</th>
        <td>{{ $model->category_name_np }}</td>
    </tr>
    <tr>
        <th>Category Slug</th>
        <td>{{ $model->slug }}</td>
    </tr>
    <tr>
        <th>Parent Category</th>
        <td>
            @if($model->parent_id == 0)
                N/A
            @else
                {{ $model->subCategory->category_name_np }}
            @endif
        </td>
    </tr>

</table>
