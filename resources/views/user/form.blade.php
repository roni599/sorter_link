@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto px-4 py-4 sm:py-4 lg:px-8 sm:px-6 lg:px-8">
        <h1>Category: {{ $category->name }}</h1>
        <p>{{ $category->description }}</p>

        @if ($category->formTemplates->isEmpty())
            <div class="alert alert-warning" role="alert">
                No form templates available for this category.
            </div>
        @else
            <form action="{{ route('user.form.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="form-templates-container" class="mt-4">
                    <h3>Form Templates</h3>
                    @foreach ($category->formTemplates as $template)
                        <h4>{{ $template->title }}</h4>
                        <p>{{ $template->description }}</p>

                        @if ($template->formFields->isEmpty())
                            <div class="alert alert-info" role="alert">
                                No form fields available for this template.
                            </div>
                        @else
                            <div id="form-fields-container" class="mt-2">
                                <h5>Form Fields</h5>
                                @foreach ($template->formFields as $field)
                                    <div class="mb-3">
                                        <label>{{ $field->field_label }}
                                            @if ($field->is_required)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>

                                        @if ($field->field_type == 'text')
                                            <input type="text" class="form-control" name="{{ $template->id }}_{{ $field->field_label }}"
                                                placeholder="{{ $field->field_label }}"
                                                required="{{ $field->is_required }}">
                                        @elseif($field->field_type == 'textarea')
                                            <textarea class="form-control" name="{{ $template->id }}_{{ $field->field_label }}" placeholder="{{ $field->field_label }}"
                                                required="{{ $field->is_required }}"></textarea>
                                        @elseif($field->field_type == 'checkbox')
                                            @foreach (json_decode($field->field_options) as $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="{{ $template->id }}_{{ $field->field_label }}[]" value="{{ $option }}">
                                                    <label class="form-check-label">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        @elseif($field->field_type == 'radio')
                                            @foreach (json_decode($field->field_options) as $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $template->id }}_{{ $field->field_label }}" value="{{ $option }}"
                                                        required="{{ $field->is_required }}">
                                                    <label class="form-check-label">{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        @elseif($field->field_type == 'file')
                                            <input type="file" class="form-control" name="{{ $template->id }}_{{ $field->field_label }}"
                                                required="{{ $field->is_required }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        @endif
    </div>
@endsection
