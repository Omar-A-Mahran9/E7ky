@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-x-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('Category list') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="card-body">

            <!--begin::Wrapper-->
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative">
                    <span class="svg-icon svg-icon-1 position-absolute ms-3">
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
                        class="form-control form-control-solid ps-10 w-250px" placeholder="{{ __('Search for category') }}">
                </div>
                <!--end::Search-->

                <!--begin::Toolbar-->
                <div id="add_btn" data-bs-toggle="modal" data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-original-title="{{ __('Coming Soon') }}" data-kt-initialized="1">
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                    fill="currentColor"></rect>
                            </svg>
                        </span>
                        {{ __('Add Category') }}
                    </button>
                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                <div class="d-flex align-items-center d-none" data-kt-docs-table-toolbar="selected">
                    <div class="fw-bold me-3">
                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('Selected item') }}
                    </div>
                    <button type="button" class="btn btn-danger"
                        data-kt-docs-table-select="delete_selected">{{ __('Delete') }}</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Wrapper-->
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

    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.articles_categories.store') }}" method="post"
        enctype="multipart/form-data" data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">{{ __('Add new category') }}</h5>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="d-flex flex-row justify-content-center gap-20">
                            <!-- Image -->
                            <div class="d-flex flex-column justify-content-center">
                                <label for="image_inp" class="form-label required text-center fs-6 fw-bold mb-3">
                                    {{ __('Image') }}
                                </label>
                                <x-dashboard.upload-image-inp name="image" :image="null" :directory="null"
                                    placeholder="default.png" type="editable" />
                            </div>

                            <!-- Mobile Image -->
                            <div class="d-flex flex-column justify-content-center">
                                <label for="img_for_mob_inp" class="form-label text-center fs-6 fw-bold mb-3">
                                    {{ __('Mobile Image') }}
                                </label>
                                <x-dashboard.upload-mob-inp name="img_for_mob" :image="null" :directory="null"
                                    placeholder="default.png" type="editable" />
                            </div>
                        </div>

                        <div class="row">
                            <!-- Arabic Name -->
                            <div class="col-md-6 fv-row">
                                <label for="name_ar_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name In Arabic') }}</label>
                                <input type="text" name="name_ar"
                                    class="form-control form-control-lg form-control-solid" id="name_ar_inp"
                                    placeholder="{{ __('Name In Arabic') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>
                            </div>

                            <!-- English Name -->
                            <div class="col-md-6 fv-row">
                                <label for="name_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name In English') }}</label>
                                <input type="text" name="name_en"
                                    class="form-control form-control-lg form-control-solid" id="name_en_inp"
                                    placeholder="{{ __('Name In English') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Arabic Description -->
                            <div class="col-md-6 fv-row">
                                <label for="description_ar_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Description in Arabic') }}</label>
                                <textarea name="description_ar" class="form-control" id="description_ar_inp" rows="3"
                                    placeholder="{{ __('Description In Arabic') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                            </div>

                            <!-- English Description -->
                            <div class="col-md-6 fv-row">
                                <label for="description_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Description in English') }}</label>
                                <textarea name="description_en" class="form-control" id="description_en_inp" rows="3"
                                    placeholder="{{ __('Description In English') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <!-- Meta Title -->
                            <div class="col-md-6 fv-row">
                                <label for="meta_title_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Meta Title') }}</label>
                                <input type="text" name="meta_title"
                                    class="form-control form-control-lg form-control-solid" id="meta_title_inp"
                                    placeholder="{{ __('Meta Title') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="meta_title"></div>
                            </div>

                            <!-- Meta Description -->
                            <div class="col-md-6 fv-row">
                                <label for="meta_description_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Meta Description') }}</label>
                                <textarea name="meta_description" class="form-control" id="meta_description_inp" rows="3"
                                    placeholder="{{ __('Meta Description') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="meta_description"></div>
                            </div>
                        </div> --}}

                        <div class="row">
                            {{-- <!-- Meta Keywords -->
                            <div class="col-md-6 fv-row">
                                <label for="meta_keywords_inp"
                                    class="form-label fs-6 fw-bold">{{ __('Meta Keywords') }}</label>
                                <input type="text" name="meta_keywords"
                                    class="form-control form-control-lg form-control-solid" id="meta_keywords_inp"
                                    placeholder="{{ __('Meta Keywords') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="meta_keywords"></div>
                            </div> --}}

                            <!-- Status -->
                            <div class="col-md-12 fv-row">
                                <label for="status_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Status') }}</label>
                                <select name="status" id="status_inp"
                                    class="form-control form-control-lg form-control-solid">
                                    <option value="0">{{ __('Inactive') }}</option>
                                    <option value="1">{{ __('Active') }}</option>
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="status"></div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <!-- Sort Order -->
                            <div class="col-md-6 fv-row">
                                <label for="sort_inp" class="form-label fs-6 fw-bold">{{ __('Sort Order') }}</label>
                                <input type="number" name="sort"
                                    class="form-control form-control-lg form-control-solid" id="sort_inp"
                                    placeholder="{{ __('Sort Order') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="sort"></div>
                            </div>

                            <!-- HTML Content -->
                            <div class="col-md-6 fv-row">
                                <label for="html_inp" class="form-label fs-6 fw-bold">{{ __('HTML Content') }}</label>
                                <textarea name="html" class="form-control" id="html_inp" rows="3"
                                    placeholder="{{ __('HTML Content') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="html"></div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Save') }}</span>
                            <span class="indicator-progress">
                                {{ __('Please wait...') }} <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
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
    <script src="{{ asset('assets/dashboard/js/datatables/articles_categories.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#add_btn").click(function(e) {
                e.preventDefault();

                $("#form_title").text('{{ __('Add new category') }}');
                $("[name='_method']").remove();
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/articles_categories`);
                $('.image-input-wrapper').css('background-image', `url('/placeholder_images/default.png')`);
            });
        });
    </script>
@endpush
