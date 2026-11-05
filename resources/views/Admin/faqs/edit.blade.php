@extends('Admin.layout')

@section('title', 'Edit FAQ')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bx bx-arrow-back me-1"></i> Back to FAQs
    </a>
    <h4 class="fw-bold mb-1"><span class="text-muted fw-light">Content / FAQs /</span> Edit Question & Answer</h4>
    <p class="text-muted mb-0">Update FAQ question, answer text, order, or visibility status.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0"><i class="bx bx-edit me-1 text-primary"></i> Edit FAQ</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Question -->
                    <div class="mb-3">
                        <label class="form-label" for="question">Question <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('question') is-invalid @enderror"
                            id="question"
                            name="question"
                            value="{{ old('question', $faq->question) }}"
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
                            required
                        >{{ old('answer', $faq->answer) }}</textarea>
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
                                value="{{ old('order', $faq->order) }}"
                            />
                            <div class="form-text">Lower numbers appear first.</div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="1" {{ old('status', $faq->status) ? 'selected' : '' }}>Active & Visible</option>
                                <option value="0" {{ !old('status', $faq->status) ? 'selected' : '' }}>Draft / Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update FAQ
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

