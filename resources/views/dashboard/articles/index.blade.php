@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row g-6 g-xl-9 mb-10 ">
        <!--begin::Col-->
        <div class="col-md-6 col-xl-6 ">
            <!--begin::Card-->
            <div class="card border-hover-primary h-100">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-9">
                    <!--begin::Card Title-->
                    <div class="card-title m-0">
                        <!--begin::Avatar-->
                        <div class=" w-35px h-35px bg-light m-auto d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 18 18"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.0073 11.6724C7.93315 11.6724 5.30565 12.1382 5.30565 13.999C5.30565 15.8599 7.91565 16.339 11.0073 16.339C14.0823 16.339 16.709 15.8774 16.709 14.0157C16.709 12.154 14.0998 11.6724 11.0073 11.6724Z"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.0071 9.01652C13.0254 9.01652 14.6621 7.38069 14.6621 5.36236C14.6621 3.34402 13.0254 1.70819 11.0071 1.70819C8.98961 1.70819 7.35294 3.34402 7.35294 5.36236C7.34544 7.37319 8.97044 9.00902 10.9813 9.01652H11.0071Z"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M5.26367 8.06802C3.92951 7.88052 2.90201 6.73552 2.89951 5.34969C2.89951 3.98385 3.89534 2.85052 5.20117 2.63635"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M3.50391 11.2769C2.21141 11.4694 1.30891 11.9227 1.30891 12.856C1.30891 13.4985 1.73391 13.9152 2.42057 14.176"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="fw-bold me-auto px-4 py-3">{{ __('Articles') }}</h4>
                        <!--end::Avatar-->
                    </div>
                    <!--end::Card Title-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-6 col-xl-6">
            <!--begin::Card-->
            <div class="card border-hover-primary h-100">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-9">
                    <!--begin::Card Title-->
                    <div class="card-title m-0">
                        <!--begin::Avatar-->
                        <div class=" w-35px h-35px bg-light m-auto d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 18 18"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.0073 11.6724C7.93315 11.6724 5.30565 12.1382 5.30565 13.999C5.30565 15.8599 7.91565 16.339 11.0073 16.339C14.0823 16.339 16.709 15.8774 16.709 14.0157C16.709 12.154 14.0998 11.6724 11.0073 11.6724Z"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.0071 9.01652C13.0254 9.01652 14.6621 7.38069 14.6621 5.36236C14.6621 3.34402 13.0254 1.70819 11.0071 1.70819C8.98961 1.70819 7.35294 3.34402 7.35294 5.36236C7.34544 7.37319 8.97044 9.00902 10.9813 9.01652H11.0071Z"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M5.26367 8.06802C3.92951 7.88052 2.90201 6.73552 2.89951 5.34969C2.89951 3.98385 3.89534 2.85052 5.20117 2.63635"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M3.50391 11.2769C2.21141 11.4694 1.30891 11.9227 1.30891 12.856C1.30891 13.4985 1.73391 13.9152 2.42057 14.176"
                                    stroke="#1C1D22" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="fw-bold me-auto px-4 py-3">{{ __('Articles') }}</h4>
                        <!--end::Avatar-->
                    </div>
                    <!--end::Card Title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="d-flex justify-content-center flex-wrap mb-5 mt-5">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end w-100" id="add_btn" data-bs-toggle="modal"
                            data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="tooltip"
                                data-bs-original-title="Coming Soon" data-kt-initialized="1">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor">
                                        </rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="currentColor"></rect>
                                    </svg>
                                </span>
                                {{ __('Add Article') }}
                            </button>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    </div>

    <!--begin::Basic info-->
    <div class="card mb-5 mb-x-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('Articles List') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Content-->
        <div class="card-body">
            <div class="d-flex flex-stack flex-wrap mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <input type="text" data-kt-docs-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="{{ __('Search for articles') }}">
                </div>
                <!--end::Search-->
            </div>

            <!--begin::Datatable-->
            <table id="kt_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_datatable .form-check-input" value="1" />
                            </div>
                        </th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th class="min-w-100px">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->


    {{-- begin::Add Country Modal --}}
    {{-- begin::Add Event Modal --}}
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.articles.store') }}" method="POST"
        enctype="multipart/form-data" data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <input type="hidden" name="_method" value="{{ isset($article) ? 'PUT' : 'POST' }}">

        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">
                            {{ isset($article) ? __('Edit Article') : __('Add New Article') }}</h5>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="name_ar_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name (Arabic)') }}</label>
                                <input type="text" name="name_ar" class="form-control" id="name_ar_inp"
                                    placeholder="{{ __('Arabic Title') }}"
                                    value="{{ old('name_ar', $article->name_ar ?? '') }}">
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="name_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name (English)') }}</label>
                                <input type="text" name="name_en" class="form-control" id="name_en_inp"
                                    placeholder="{{ __('English Title') }}"
                                    value="{{ old('name_en', $article->name_en ?? '') }}">
                            </div>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="description_ar_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Description (Arabic)') }}</label>
                            <textarea name="description_ar" class="form-control" id="description_ar_inp" rows="3"
                                placeholder="{{ __('Description in Arabic') }}">{{ old('description_ar', $article->description_ar ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="description_en_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Description (English)') }}</label>
                            <textarea name="description_en" class="form-control" id="description_en_inp" rows="3"
                                placeholder="{{ __('Description in English') }}">{{ old('description_en', $article->description_en ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="content_ar_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Content (Arabic)') }}</label>
                            <textarea name="content_ar" class="form-control" id="content_ar_inp" rows="5"
                                placeholder="{{ __('Content in Arabic') }}">{{ old('content_ar', $article->content_ar ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="content_en_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Content (English)') }}</label>
                            <textarea name="content_en" class="form-control" id="content_en_inp" rows="5"
                                placeholder="{{ __('Content in English') }}">{{ old('content_en', $article->content_en ?? '') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="image_inp" class="form-label fs-6 fw-bold">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="$article->image ?? null" :directory="null"
                                    placeholder="default.svg" type="editable" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="slide_image_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Slide Image') }}</label>
                                <x-dashboard.upload-image-inp name="slide_image" :image="$article->slide_image ?? null" :directory="null"
                                    placeholder="slide-default.svg" type="editable" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="internal_image_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Internal Image') }}</label>
                                <x-dashboard.upload-image-inp name="internal_image" :image="$article->internal_image ?? null" :directory="null"
                                    placeholder="internal-default.svg" type="editable" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="video_inp" class="form-label fs-6 fw-bold">{{ __('Video URL') }}</label>
                                <input type="url" name="video" class="form-control" id="video_inp"
                                    value="{{ old('video', $article->video ?? '') }}">
                            </div>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="status_inp" class="form-label fs-6 fw-bold">{{ __('Status') }}</label>
                            <select name="status" class="form-control" id="status_inp">
                                <option value="draft"
                                    {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>
                                    {{ __('Draft') }}</option>
                                <option value="published"
                                    {{ old('status', $article->status ?? '') == 'published' ? 'selected' : '' }}>
                                    {{ __('Published') }}</option>
                                <option value="archived"
                                    {{ old('status', $article->status ?? '') == 'archived' ? 'selected' : '' }}>
                                    {{ __('Archived') }}</option>
                            </select>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="category_id_inp" class="form-label fs-6 fw-bold">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control" id="category_id_inp">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="schedule_inp" class="form-label fs-6 fw-bold">{{ __('Schedule Date') }}</label>
                            <input type="date" name="schedule" class="form-control" id="schedule_inp"
                                value="{{ old('schedule', $article->schedule ?? '') }}">
                        </div>

                        <div class="fv-row mt-5 form-check">
                            <input type="hidden" name="is_slide_show" value="0">
                            <input type="checkbox" name="is_slide_show" class="form-check-input" id="is_slide_show"
                                value="1"
                                {{ old('is_slide_show', $article->is_slide_show ?? 0) == 1 ? 'checked' : '' }}>
                            <label for="is_slide_show">{{ __('Feature in Slideshow') }}</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Save') }}</span>
                            <span class="indicator-progress">{{ __('Please wait...') }} <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.articles.store') }}" method="POST"
        enctype="multipart/form-data" data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <input type="hidden" name="_method" value="{{ isset($article) ? 'PUT' : 'POST' }}">

        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">
                            {{ isset($article) ? __('Edit Article') : __('Add New Article') }}</h5>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="name_ar_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name (Arabic)') }}</label>
                                <input type="text" name="name_ar" class="form-control" id="name_ar_inp"
                                    placeholder="{{ __('Arabic Title') }}"
                                    value="{{ old('name_ar', $article->name_ar ?? '') }}">
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="name_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name (English)') }}</label>
                                <input type="text" name="name_en" class="form-control" id="name_en_inp"
                                    placeholder="{{ __('English Title') }}"
                                    value="{{ old('name_en', $article->name_en ?? '') }}">
                            </div>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="description_ar_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Description (Arabic)') }}</label>
                            <textarea name="description_ar" class="form-control" id="description_ar_inp" rows="3"
                                placeholder="{{ __('Description in Arabic') }}">{{ old('description_ar', $article->description_ar ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="description_en_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Description (English)') }}</label>
                            <textarea name="description_en" class="form-control" id="description_en_inp" rows="3"
                                placeholder="{{ __('Description in English') }}">{{ old('description_en', $article->description_en ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="content_ar_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Content (Arabic)') }}</label>
                            <textarea name="content_ar" class="form-control" id="content_ar_inp" rows="5"
                                placeholder="{{ __('Content in Arabic') }}">{{ old('content_ar', $article->content_ar ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="content_en_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Content (English)') }}</label>
                            <textarea name="content_en" class="form-control" id="content_en_inp" rows="5"
                                placeholder="{{ __('Content in English') }}">{{ old('content_en', $article->content_en ?? '') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="image_inp" class="form-label fs-6 fw-bold">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="$article->image ?? null" :directory="null"
                                    placeholder="default.svg" type="editable" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="slide_image_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Slide Image') }}</label>
                                <x-dashboard.upload-image-inp name="slide_image" :image="$article->slide_image ?? null" :directory="null"
                                    placeholder="slide-default.svg" type="editable" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="internal_image_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Internal Image') }}</label>
                                <x-dashboard.upload-image-inp name="internal_image" :image="$article->internal_image ?? null" :directory="null"
                                    placeholder="internal-default.svg" type="editable" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="video_inp" class="form-label fs-6 fw-bold">{{ __('Video URL') }}</label>
                                <input type="url" name="video" class="form-control" id="video_inp"
                                    value="{{ old('video', $article->video ?? '') }}">
                            </div>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="status_inp" class="form-label fs-6 fw-bold">{{ __('Status') }}</label>
                            <select name="status" class="form-control" id="status_inp">
                                <option value="draft"
                                    {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>
                                    {{ __('Draft') }}</option>
                                <option value="published"
                                    {{ old('status', $article->status ?? '') == 'published' ? 'selected' : '' }}>
                                    {{ __('Published') }}</option>
                                <option value="archived"
                                    {{ old('status', $article->status ?? '') == 'archived' ? 'selected' : '' }}>
                                    {{ __('Archived') }}</option>
                            </select>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="category_id_inp" class="form-label fs-6 fw-bold">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control" id="category_id_inp">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="schedule_inp" class="form-label fs-6 fw-bold">{{ __('Schedule Date') }}</label>
                            <input type="date" name="schedule" class="form-control" id="schedule_inp"
                                value="{{ old('schedule', $article->schedule ?? '') }}">
                        </div>

                        <div class="fv-row mt-5 form-check">
                            <input type="hidden" name="is_slide_show" value="0">
                            <input type="checkbox" name="is_slide_show" class="form-check-input" id="is_slide_show"
                                value="1"
                                {{ old('is_slide_show', $article->is_slide_show ?? 0) == 1 ? 'checked' : '' }}>
                            <label for="is_slide_show">{{ __('Feature in Slideshow') }}</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Save') }}</span>
                            <span class="indicator-progress">{{ __('Please wait...') }} <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/articles.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#add_btn").click(function(e) {
                e.preventDefault();

                $("#form_title").text(__('Add new event'));
                $("[name='_method']").remove();
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/events`);
                $('.image-input-wrapper').css('background-image', `url('/placeholder_images/default.svg')`);
            });


        });
    </script>
@endpush
