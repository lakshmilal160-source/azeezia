@extends('Admin.layout')

@section('title', 'FAQs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content /</span> Frequently Asked Questions</h4>
        <p class="text-muted mb-0">Manage customer questions, answers, display order, and visibility status.</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
        <i class="bx bx-plus me-1"></i> Add FAQ
    </a>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.faqs.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search question or answer..."
                        value="{{ request('search') }}"
                    />
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active Only</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive Only</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- FAQs Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 80px;">Order</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th style="width: 120px;">Status</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($faqs as $faq)
                    <tr>
                        <td>
                            <span class="badge bg-label-secondary font-monospace">#{{ $faq->order }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark text-wrap" style="max-width: 340px; line-height: 1.4;">
                                {{ $faq->question }}
                            </div>
                        </td>
                        <td>
                            <div class="text-muted small text-wrap" style="max-width: 420px; line-height: 1.5;">
                                {{ Str::limit($faq->answer, 140) }}
                            </div>
                        </td>
                        <td>
                            @if($faq->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-icon btn-outline-secondary" title="Edit FAQ">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Delete FAQ">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bx bx-help-circle fs-1 text-muted d-block mb-2"></i>
                            <h6 class="mb-1">No FAQs Found</h6>
                            <p class="text-muted small mb-3">Add frequently asked questions to help visitors learn about your venues, stays, and farm.</p>
                            <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-primary">
                                <i class="bx bx-plus me-1"></i> Add First FAQ
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($faqs->hasPages())
        <div class="card-footer border-top d-flex justify-content-end py-2">
            {{ $faqs->links() }}
        </div>
    @endif
</div>
@endsection

