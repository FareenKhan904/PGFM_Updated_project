@extends('layouts.doctor')

@section('title', 'Manage Library - PGIFM')

@section('doctor-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-book me-2"></i>Manage Library</h2>
        <a href="{{ route('library.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Item
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($items->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Author</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->title }}</strong>
                                        @if($item->description)
                                            <br><small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($item->type) }}</span>
                                    </td>
                                    <td>{{ $item->author ?? 'N/A' }}</td>
                                    <td>
                                        @if($item->file_name)
                                            <i class="fas fa-file text-primary"></i> {{ Str::limit($item->file_name, 20) }}
                                        @elseif($item->external_link)
                                            <i class="fas fa-external-link-alt text-success"></i> Link
                                        @else
                                            <span class="text-muted">No file</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('library.edit', $item) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('library.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No library items yet</h4>
                <p class="text-muted">Start by adding your first library item.</p>
                <a href="{{ route('library.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-2"></i>Add New Item
                </a>
            </div>
        </div>
    @endif
@endsection

