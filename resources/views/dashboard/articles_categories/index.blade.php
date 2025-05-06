@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="row g-6 g-xl-9 mb-10">
        <!--begin::Col-->
        <div class="col-md-6 col-xl-6">
            <div class="card border-hover-primary h-100">
                <div class="card-header border-0 pt-9">
                    <div class="card-title m-0">
                        <div class="w-35px h-35px bg-light m-auto d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M4 4H20V6H4V4Z" fill="currentColor" />
                                <path d="M4 9H20V11H4V9Z" fill="currentColor" />
                                <path d="M4 14H14V16H4V14Z" fill="currentColor" />
                            </svg>
                        </div>
                        <h4 class="fw-bold me-auto px-4 py-3">{{ __('Article Categories') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Col-->
        <div class="col-md-6 col-xl-6">
            <div class="card border-hover-primary h-100">
                <div class="card-header border-0 pt-9">
                    <div class="card-title m-0">
                        <div class="w-35px h-35px bg-light m-auto d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24"
                                fill="none">
                                <path d="M4 4H20V6H4V4Z" fill="currentColor" />
                                <path d="M4 9H20V11H4V9Z" fill="currentColor" />
                                <path d="M4 14H14V16H4V14Z" fill="currentColor" />
                            </svg>
                        </div>
                        <h4 class="fw-bold me-auto px-4 py-3">{{ __('Article Categories') }}</h4>
                    </div>
                </div>
                <div class="card-body p-9">
                    <div class="d-flex justify-content-center flex-wrap mb-5 mt-5">
                        <div class="d-flex justify-content-end w-100" data-bs-toggle="modal" data-bs-target="#crud_modal">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="tooltip"
                                title="{{ __('Add Article Category') }}">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                {{ __('Add Category') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Category List-->
    <div class="card mb-5 mb-x-10">
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_category_profile_details" aria-expanded="true" aria-controls="kt_category_profile_details">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('Categories List') }}</h3>
            </div>
        </div>

        <div class="card-body">
            <div class="d-flex flex-stack flex-wrap mb-5">
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <input type="text" data-kt-docs-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="{{ __('Search for categories') }}">
                </div>
            </div>

            <table id="kt_categories_table" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_categories_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th class="min-w-100px">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    <!-- Categories will be populated here -->
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Category List-->

    <form id="category_form" class="ajax-form"
        action="{{ isset($category) ? route('dashboard.categories.update', $category->id) : route('dashboard.articles_categories.store') }}"
        method="POST" enctype="multipart/form-data" data-success-callback="onAjaxSuccess"
        data-error-callback="onAjaxError">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif

        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">
                            {{ isset($category) ? __('Edit Category') : __('Add New Category') }}</h5>
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
                                    value="{{ old('name_ar', $category->name_ar ?? '') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>

                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="name_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name (English)') }}</label>
                                <input type="text" name="name_en" class="form-control" id="name_en_inp"
                                    placeholder="{{ __('English Title') }}"
                                    value="{{ old('name_en', $category->name_en ?? '') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>

                            </div>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="meta_title_inp" class="form-label fs-6 fw-bold">{{ __('Meta Title') }}</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title_inp"
                                placeholder="{{ __('Meta Title') }}"
                                value="{{ old('meta_title', $category->meta_title ?? '') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_title"></div>

                        </div>

                        <div class="fv-row mb-4">
                            <label for="meta_description_inp"
                                class="form-label fs-6 fw-bold">{{ __('Meta Description') }}</label>
                            <textarea name="meta_description" class="form-control" id="meta_description_inp" rows="3"
                                placeholder="{{ __('Meta Description') }}">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_description"></div>

                        </div>

                        <div class="fv-row mb-4">
                            <label for="meta_keywords_inp"
                                class="form-label fs-6 fw-bold">{{ __('Meta Keywords') }}</label>
                            <input type="text" name="meta_keywords" class="form-control" id="meta_keywords_inp"
                                placeholder="{{ __('Meta Keywords') }}"
                                value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_keywords"></div>

                        </div>

                        <div class="fv-row mb-4">
                            <label for="html_inp" class="form-label fs-6 fw-bold">{{ __('HTML Content') }}</label>
                            <textarea name="html" class="form-control" id="html_inp" rows="3"
                                placeholder="{{ __('HTML Content') }}">{{ old('html', $category->html ?? '') }}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback" id="html"></div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="image_inp" class="form-label fs-6 fw-bold">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="$category->image ?? null" :directory="null"
                                    placeholder="default.svg" type="editable" />
                                <div class="fv-plugins-message-container invalid-feedback" id="image"></div>

                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="img_for_mob_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Mobile Image') }}</label>
                                <x-dashboard.upload-image-inp name="img_for_mob" :image="$category->img_for_mob ?? null" :directory="null"
                                    placeholder="default-mobile.svg" type="editable" />
                                <div class="fv-plugins-message-container invalid-feedback" id="img_for_mob"></div>

                            </div>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="status_inp" class="form-label fs-6 fw-bold">{{ __('Status') }}</label>
                            <select name="status" class="form-control" id="status_inp">
                                <option value="1"
                                    {{ old('status', $category->status ?? '') == '1' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0"
                                    {{ old('status', $category->status ?? '') == '0' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>

                            <div class="fv-plugins-message-container invalid-feedback" id="status"></div>

                        </div>

                        <div class="fv-row mb-3">
                            <label for="sort_inp" class="form-label fs-6 fw-bold">{{ __('Sort Order') }}</label>
                            <input type="number" name="sort" class="form-control" id="sort_inp"
                                value="{{ old('sort', $category->sort ?? '') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="sort"></div>

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
    <form id="category_form" class="ajax-form"
        action="{{ isset($category) ? route('dashboard.articles_categories.update', $category->id) : route('dashboard.articles_categories.store') }}"
        method="POST" enctype="multipart/form-data" data-success-callback="onAjaxSuccess"
        data-error-callback="onAjaxError">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif

        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">
                            {{ isset($category) ? __('Edit Category') : __('Add New Category') }}</h5>
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
                                    value="{{ old('name_ar', $category->name_ar ?? '') }}">
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="name_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name (English)') }}</label>
                                <input type="text" name="name_en" class="form-control" id="name_en_inp"
                                    placeholder="{{ __('English Title') }}"
                                    value="{{ old('name_en', $category->name_en ?? '') }}">
                            </div>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="meta_title_inp" class="form-label fs-6 fw-bold">{{ __('Meta Title') }}</label>
                            <input type="text" name="meta_title" class="form-control" id="meta_title_inp"
                                placeholder="{{ __('Meta Title') }}"
                                value="{{ old('meta_title', $category->meta_title ?? '') }}">
                        </div>

                        <div class="fv-row mb-4">
                            <label for="meta_description_inp"
                                class="form-label fs-6 fw-bold">{{ __('Meta Description') }}</label>
                            <textarea name="meta_description" class="form-control" id="meta_description_inp" rows="3"
                                placeholder="{{ __('Meta Description') }}">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="meta_keywords_inp"
                                class="form-label fs-6 fw-bold">{{ __('Meta Keywords') }}</label>
                            <input type="text" name="meta_keywords" class="form-control" id="meta_keywords_inp"
                                placeholder="{{ __('Meta Keywords') }}"
                                value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
                        </div>

                        <div class="fv-row mb-4">
                            <label for="html_inp" class="form-label fs-6 fw-bold">{{ __('HTML Content') }}</label>
                            <textarea name="html" class="form-control" id="html_inp" rows="3"
                                placeholder="{{ __('HTML Content') }}">{{ old('html', $category->html ?? '') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="image_inp" class="form-label fs-6 fw-bold">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="$category->image ?? null" :directory="null"
                                    placeholder="default.svg" type="editable" />
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="img_for_mob_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Mobile Image') }}</label>
                                <x-dashboard.upload-image-inp name="img_for_mob" :image="$category->img_for_mob ?? null" :directory="null"
                                    placeholder="default-mobile.svg" type="editable" />
                            </div>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="status_inp" class="form-label fs-6 fw-bold">{{ __('Status') }}</label>
                            <select name="status" class="form-control" id="status_inp">
                                <option value="1"
                                    {{ old('status', $category->status ?? '') == '1' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0"
                                    {{ old('status', $category->status ?? '') == '0' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="sort_inp" class="form-label fs-6 fw-bold">{{ __('Sort Order') }}</label>
                            <input type="number" name="sort" class="form-control" id="sort_inp"
                                value="{{ old('sort', $category->sort ?? '') }}">
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
    <script src="{{ asset('assets/dashboard/js/datatables/categories.js') }}"></script>
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
