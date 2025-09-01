@extends('backend.layouts.master')
@section('title','E-SHOP || Attribute Values')
@section('main-content')

<div class="card">
    <h5 class="card-header">Attribute Values List</h5>
    <div class="card-body">
        <a href="{{ route('attribute-values.create') }}" class="btn btn-primary mb-3">Add Attribute Value</a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Attribute</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attributeValues as $index => $val)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $val->attribute->name ?? '-' }}</td>
                    <td>{{ $val->value }}</td>
                    <td>
                        <a href="{{ route('attribute-values.edit', $val->id) }}" class="btn btn-sm btn-info">Edit</a>

                        <form action="{{ route('attribute-values.destroy', $val->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this value?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No attribute values found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <!-- <span style="float:right">{{$attributeValues->links()}}</span> -->
         <div class="mt-3">
            {{ $attributeValues->links('pagination::bootstrap-5') }}
          </div>
    </div>
</div>

@endsection