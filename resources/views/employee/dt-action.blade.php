<div class="btn-group btn-group-sm text-cemter" role="group">
    <a href="{{ route('employee.show', $model->employee_id) }}" class="btn btn-primary">
        <span class="text-center">
            <i class="ti ti-eye"></i>
        </span>
    </a>
    <a href="{{ route('employee.edit', $model->employee_id) }}" class="btn btn-warning">
        <span class="text-center">
            <i class="ti ti-pencil"></i>
        </span>
    </a>
    <button type="button" class="btn btn-danger" onclick="deleteData('{{ $model->employee_id }}')">
        <i class="ti ti-trash"></i>
    </button>
</div>
