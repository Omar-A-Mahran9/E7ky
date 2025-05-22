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


    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.articles.store') }}" method="POST"
        enctype="multipart/form-data" data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">{{ __('Add new article') }}</h5>
                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </button>

                        {{-- <div class="form-check form-switch ms-4">
                            <input class="form-check-input" type="checkbox" id="status_inp" name="status"
                                value="active">
                            <label class="form-check-label" for="status_inp">
                                {{ __('Active') }}
                            </label>
                        </div> --}}
                    </div>


                    <div class="modal-body">
                        <div class=" d-flex flex-row justify-content-center gap-20 mb-5">


                            <div class="d-flex flex-column justify-content-center">
                                <label for="image_inp"
                                    class="form-label required text-center fs-6 fw-bold mb-3">{{ __('Image') }}</label>
                                <x-dashboard.upload-image-inp name="image" :image="null" :directory="null"
                                    placeholder="default.png" type="editable"></x-dashboard.upload-image-inp>
                            </div>

                            <div class="d-flex flex-column justify-content-center">
                                <label for="cover_picture_inp"
                                    class="form-label required text-center fs-6 fw-bold mb-3">{{ __('Cover') }}</label>
                                <x-dashboard.upload-image-inp name="internal_image" :image="null" :directory="null"
                                    placeholder="default.png" type="editable"></x-dashboard.upload-image-inp>
                            </div>

                            <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}" />
                        </div>


                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-4">
                                <label for="category_id_inp" class="form-label ">{{ __('Category') }}</label>
                                <select name="category_id" id="category_id_inp" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="{{ __('Select category') }}"
                                    data-dir="{{ getDirection() }}" data-allow-clear="true">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="category_id"></div>

                            </div>

                            <!-- Campaign -->
                            <div class="col-md-4">
                                <label for="campaign_id_inp" class="form-label">{{ __('Campaign') }}</label>
                                <select name="campaign_id[]" id="campaign_id_inp" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="{{ __('Select campaign') }}"
                                    data-dir="{{ getDirection() }}" data-allow-clear="true" multiple>
                                    @foreach ($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="campaign_id"></div>

                            </div>
                            <div class="col-md-4">
                                <label for="tag_id_inp" class="form-label">{{ __('Tags') }}</label>
                                <select name="tag_id[]" id="tag_id_inp" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="{{ __('Select tags') }}"
                                    data-dir="{{ getDirection() }}" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="tag_id"></div>

                            </div>

                        </div>
                        <div class="row mt-10">
                            <!-- Names -->
                            <div class="col-md-6">
                                <label for="name_ar_inp" class="form-label required">{{ __('Name In Arabic') }}</label>
                                <input type="text" name="name_ar" id="name_ar_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('Name In Arabic') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>

                            </div>
                            <div class="col-md-6">
                                <label for="name_en_inp" class="form-label required">{{ __('Name In English') }}</label>
                                <input type="text" name="name_en" id="name_en_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('Name In English') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>

                            </div>
                        </div>

                        <div class="row mt-10">
                            <!-- Descriptions -->
                            <div class="col-md-6">
                                <label for="description_ar_inp"
                                    class="form-label required">{{ __('Description in Arabic') }}</label>
                                <textarea name="description_ar" id="description_ar_inp" rows="3" class="form-control"
                                    placeholder="{{ __('Description In Arabic') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>

                            </div>
                            <div class="col-md-6">
                                <label for="description_en_inp"
                                    class="form-label required">{{ __('Description in English') }}</label>
                                <textarea name="description_en" id="description_en_inp" rows="3" class="form-control"
                                    placeholder="{{ __('Description In English') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>

                            </div>
                        </div>

                        <div class="row mt-10">
                            <!-- Content -->
                            <div class="col-md-12">
                                <label for="content_ar_inp" class="form-label">{{ __('Content in Arabic') }}</label>
                                <textarea name="content_ar" id="content_ar_inp" rows="5" class="form-control  tinymce-editor tinymce"
                                    placeholder="{{ __('Content in Arabic') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="content_ar"></div>

                            </div>
                            <div class="col-md-12 mt-10">
                                <label for="content_en_inp" class="form-label">{{ __('Content in English') }}</label>
                                <textarea name="content_en" id="content_en_inp" rows="5" class="form-control  tinymce-editor tinymce"
                                    placeholder="{{ __('Content in English') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="content_en"></div>

                            </div>


                        </div>

                        <div>
                            <select class="form-select" name="status" required>
                                <option value="published">{{ __('Published') }}</option>
                                <option value="draft">{{ __('Draft') }}</option>
                                <option value="archived">{{ __('Archived') }}</option>
                            </select>

                        </div>



                        {{-- <!-- Tags (multiple) -->


                            <!-- Meta fields -->
                            <div class="col-md-4">
                                <label for="meta_title_inp" class="form-label">{{ __('Meta Title') }}</label>
                                <input type="text" name="meta_title" id="meta_title_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('Meta Title') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="meta_description_inp" class="form-label">{{ __('Meta Description') }}</label>
                                <textarea name="meta_description" id="meta_description_inp" rows="2" class="form-control"
                                    placeholder="{{ __('Meta Description') }}"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="meta_keywords_inp" class="form-label">{{ __('Meta Keywords') }}</label>
                                <input type="text" name="meta_keywords" id="meta_keywords_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('Meta Keywords') }}">
                            </div>

                            <!-- HTML Tags -->
                            <div class="col-12">
                                <label for="html_tags_inp" class="form-label">{{ __('HTML Content') }}</label>
                                <textarea name="html_tags" id="html_tags_inp" rows="3" class="form-control"
                                    placeholder="{{ __('HTML Content') }}"></textarea>
                            </div>

                            <!-- Flags & integers -->
                            <div class="col-md-3">
                                <label for="img_or_vid_inp"
                                    class="form-label">{{ __('Image or Video (img_or_vid)') }}</label>
                                <input type="number" name="img_or_vid" id="img_or_vid_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('img_or_vid') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="is_slide_show_inp"
                                    class="form-label required">{{ __('Is Slide Show') }}</label>
                                <select name="is_slide_show" id="is_slide_show_inp"
                                    class="form-select form-select-lg form-select-solid">
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="is_latest_inp" class="form-label">{{ __('Is Latest') }}</label>
                                <select name="is_latest" id="is_latest_inp"
                                    class="form-select form-select-lg form-select-solid">
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="views_inp" class="form-label">{{ __('Views') }}</label>
                                <input type="number" name="views" id="views_inp"
                                    class="form-control form-control-lg form-control-solid" value="0" min="0"
                                    placeholder="{{ __('Views') }}">
                            </div>

                            <!-- Schedule -->
                            <div class="col-md-6">
                                <label for="schedule_inp" class="form-label">{{ __('Schedule Date') }}</label>
                                <input type="date" name="schedule" id="schedule_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('Schedule Date') }}">
                            </div>

                            <!-- Slug -->
                            <div class="col-md-6">
                                <label for="slug_inp" class="form-label required">{{ __('Slug') }}</label>
                                <input type="text" name="slug" id="slug_inp"
                                    class="form-control form-control-lg form-control-solid"
                                    placeholder="{{ __('Slug') }}">
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
    <script src="{{ asset('assets/dashboard/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        $(document).ready(() => {
            initTinyMc();
        })
    </script>
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
                $("#crud_form").attr('action', `/dashboard/articles`);
                $('.image-input-wrapper').css('background-image', `url('/placeholder_images/default.png')`);
            });


        });
    </script>



    <script>
        let language = locale == 'en' ? 'ltr' : 'rtl';

        tinymce.init({
            selector: "#content_ar_inp",
            height: 480,
            menubar: false,
            toolbar: [
                'undo redo | cut copy paste | styleselect fontselect fontsizeselect',
                'bold italic underline strikethrough subscript superscript | forecolor backcolor',
                'alignleft aligncenter alignright alignjustify | outdent indent | ltr rtl',
                'bullist numlist | blockquote hr removeformat',
                'link image media table charmap emoticons anchor',
                'searchreplace code fullscreen preview print'
            ]

            directionality: language === 'rtl' ? 'rtl' : 'ltr',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons paste help directionality'
            ],
        });

        tinymce.init({
            selector: "#content_en_inp",
            height: 480,
            menubar: false,
            toolbar: [
                'undo redo | cut copy paste | styleselect fontselect fontsizeselect',
                'bold italic underline strikethrough subscript superscript | forecolor backcolor',
                'alignleft aligncenter alignright alignjustify | outdent indent | ltr rtl',
                'bullist numlist | blockquote hr removeformat',
                'link image media table charmap emoticons anchor',
                'searchreplace code fullscreen preview print'
            ]

            directionality: language === 'rtl' ? 'rtl' : 'ltr',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons paste help directionality'
            ],
        });
    </script>
@endpush
