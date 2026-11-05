@extends('Admin.layout')

@section('title', 'Add FAQ')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to FAQs
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content / FAQs /</span> Add Question & Answer</h4>
    <p class="text-muted mb-0">Add a new frequently asked question with detailed answer, sort order, and status.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-help-circle me-1 text-primary"></i> FAQ Details</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf

                    <!-- Question -->
                    <div class="mb-3">
                        <label class="form-label" for="question">Question <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('question') is-invalid @enderror"
                            id="question"
                            name="question"
                            value="{{ old('question') }}"
                            placeholder="e.g. What is the maximum seating capacity of the grand convention hall?"
                            required
                        />
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Answer -->
                    <div class="mb-3">
                        <label class="form-label" for="answer">Answer <span class="text-danger">*</span></label>
                        <textarea
                            class="form-control @error('answer') is-invalid @enderror"
                            id="answer"
                            name="answer"
                            rows="6"
                            placeholder="Write a clear and comprehensive answer for your guests..."
                            required
                        >{{ old('answer') }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Order -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="order">Display Order</label>
                            <input
                                type="number"
                                min="0"
                                class="form-control @error('order') is-invalid @enderror"
                                id="order"
                                name="order"
                                value="{{ old('order', 0) }}"
                            />
                            <div class="form-text">Lower numbers appear first (e.g. 0, 1, 2).</div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active & Visible</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft / Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Save FAQ
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

