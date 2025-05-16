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
                        <h4 class="fw-bold me-auto px-4 py-3">{{ __('Events') }}</h4>

                        <!--end::Avatar-->
                    </div>
                    <!--end::Car Title-->
                    <!--begin::Card toolbar-->
                    {{-- <div class="card-toolbar">
                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">In Progress</span>
                    </div> --}}
                    <!--end::Card toolbar-->
                </div>
                <!--end:: Card header-->

            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
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
                        <h4 class="fw-bold me-auto px-4 py-3">{{ __('Events') }}</h4>

                        <!--end::Avatar-->
                    </div>
                    <!--end::Car Title-->
                    <!--begin::Card toolbar-->
                    {{-- <div class="card-toolbar">
                    <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">In Progress</span>
                </div> --}}
                    <!--end::Card toolbar-->
                </div>
                <!--end:: Card header-->
                <!--begin:: Card body-->
                <div class="card-body p-9">
                    <!--begin::Name-->

                    <div class="d-flex justify-content-center flex-wrap mb-5 mt-5">

                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end w-100" id="add_btn" data-bs-toggle="modal"
                            data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="tooltip"
                                data-bs-original-title="Coming Soon" data-kt-initialized="1">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
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
                                <!--end::Svg Icon-->{{ __('Add Event') }}
                            </button>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Info-->



                </div>
                <!--end:: Card body-->
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
                <h3 class="fw-bold m-0">{{ __('Events list') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="card-body">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-wrap mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
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
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-docs-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('Search for events') }}">
                </div>
                <!--end::Search-->

                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('Selected item') }}
                    </div>
                    <button type="button" class="btn btn-danger"
                        data-kt-docs-table-select="delete_selected">{{ __('delete') }}</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Datatable-->
            <table id="kt_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_datatable .form-check-input" value="1" />
                            </div>
                        </th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th class=" min-w-100px">{{ __('Actions') }}</th>
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
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.events.store') }}" method="post"
        data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">{{ __('Add new event') }}</h5>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="d-flex flex-row justify-content-center gap-20">

                            <div class="d-flex flex-column justify-content-center">
                                <label for="image_inp" class="form-label required text-center fs-6 fw-bold mb-3">
                                    {{ __('Image') }}
                                </label>
                                <x-dashboard.upload-image-inp name="image" :image="null" :directory="null"
                                    placeholder="default.svg" type="editable">
                                </x-dashboard.upload-image-inp>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label for="name_ar_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name ar') }}</label>
                                <input type="text" name="name_ar"
                                    class="form-control form-control-lg form-control-solid" id="name_ar_inp"
                                    placeholder="{{ __('Name In Arabic') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>
                            </div>

                            <div class="col-md-6 fv-row">

                                <label for="name_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Name en') }}</label>
                                <input type="text" name="name_en"
                                    class="form-control form-control-lg form-control-solid" id="name_en_inp"
                                    placeholder="{{ __('Name In English') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>
                            </div>
                        </div>

                        <div class="fv-row mb-4">
                            <label for="description_ar_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Description ar') }}</label>
                            <textarea name="description_ar" class="form-control" id="description_ar_inp" rows="3"
                                placeholder="{{ __('Description In Arabic') }}"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                        </div>

                        <div class="fv-row mb-3">
                            <label for="description_en_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Description en') }}</label>
                            <textarea name="description_en" class="form-control" id="description_en_inp" rows="3"
                                placeholder="{{ __('Description In English') }}"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                        </div>




                        <div class="row">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-bold">{{ __('Start Date') }}</label>
                                <input type="date" name="start_day" class="form-control" required>
                                <div class="fv-plugins-message-container invalid-feedback" id="start_day"></div>

                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex justify-content-between align-items-center  gap-5">
                                    <div><label class="fs-6 fw-bold">{{ __('End Date') }}</label></div>
                                    <div class="fv-row mt-3 form-check">
                                        <input type="checkbox" name="is_multi_day" class="form-check-input"
                                            id="is_multi_day" value="0">
                                        <label class="form-check-label"
                                            for="is_multi_day">{{ __('Multi-Day Event') }}</label>
                                    </div>
                                </div>
                                <input type="date" name="end_day" class="form-control" id="end_day" disabled>
                                <div class="fv-plugins-message-container invalid-feedback" id="end_day"></div>

                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-bold">{{ __('Start Time') }}</label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-bold">{{ __('End Time') }}</label>
                                <input type="time" name="end_time" class="form-control">
                                <div class="fv-plugins-message-container invalid-feedback" id="end_time"></div>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-bold">{{ __('Registration Start') }}</label>
                                <input type="time" name="registration_start_time" class="form-control">
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-bold">{{ __('Registration End') }}</label>
                                <input type="time" name="registration_end_time" class="form-control">
                                <div class="fv-plugins-message-container invalid-feedback" id="registration_end_time">
                                </div>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 fv-row">
                                <label for='capacity_inp' class="fs-6 fw-bold">{{ __('Capacity') }}</label>
                                <input id='capacity_inp' type="number" name="capacity" class="form-control"
                                    min="1">
                                <p class="invalid-feedback" id="capacity"></p>

                            </div>
                            <div class="col-md-6 fv-row">
                                <label for='price_inp' class="fs-6 fw-bold">{{ __('Price') }}</label>
                                <input id='price_inp' type="number" name="price" class="form-control"
                                    min="0">
                                <p class="invalid-feedback" id="price"></p>

                            </div>
                        </div>

                        <div class="fv-row mt-3">
                            <label for='event_link_inp' class="fs-6 fw-bold">{{ __('Event Link') }}</label>
                            <input id='event_link_inp' type="url" name="event_link" class="form-control">
                            <p class="invalid-feedback" id="event_link"></p>

                        </div>

                        <div class="fv-row mt-3">
                            <label class="fs-6 fw-bold" for='streaming_link_inp'>{{ __('Streaming Link') }}</label>
                            <input type="url" id='streaming_link_inp' name="streaming_link" class="form-control">
                            <p class="invalid-feedback" id="streaming_link"></p>

                        </div>
                        <div class="fv-row mt-5">

                            <div class="d-flex flex-column justify-content-center ">
                                <label for="event_map_inp" class="form-label required text-center fs-6 fw-bold mb-3">
                                    {{ __('Event Map') }}
                                </label>
                                <x-dashboard.upload-map-inp name="event_map" :image="null" :directory="null"
                                    placeholder="map-placeholder.svg" type="editable">
                                </x-dashboard.upload-map-inp>
                            </div>
                        </div>

                        <div class="fv-row mt-3">
                            <label class="fs-6 fw-bold">{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="scheduled">{{ __('Scheduled') }}</option>
                                <option value="ongoing">{{ __('Ongoing') }}</option>
                                <option value="completed">{{ __('Completed') }}</option>
                                <option value="canceled">{{ __('Canceled') }}</option>
                            </select>
                        </div>
                        <div class="fv-row mb-3">
                            <label for="location_inp"
                                class="form-label required fs-6 fw-bold">{{ __('Location') }}</label>
                            <input type="text" id="location_inp" name="location" class="form-control"
                                placeholder="{{ __('Enter event location') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="location"></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="fs-6 fw-bold">{{ __('Pickup your location') }}</label>
                                <div class="text-center">
                                    <div id="googleMap"
                                        style="width: 100%;min-height:300px;border:1px solid #009EF7; border-radius: 10px;">
                                    </div>
                                    <input type="hidden" id="lat_inp" name="lat">
                                    <input type="hidden" id="lng_inp" name="lon">
                                    <p class="invalid-feedback" id="lat"></p>
                                </div>
                            </div>
                        </div>



                        <div class="fv-row mt-5 form-check">
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" class="form-check-input" id="featured"
                                value="1">
                            <label for="featured">{{ __('show in banner') }}</label>
                        </div>

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
    <script src="{{ asset('assets/dashboard/js/datatables/events.js') }}"></script>
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

    <script>
        let lat = 30.0444; // Cairo, Egypt
        let lng = 31.2357; // Cairo, Egypt
        const isEditPage = false;
        const isShowPage = false;
    </script>
    <script src="{{ asset('assets/dashboard/js/map_create.js') }}"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu4T0sSqqn87uvqXHcUbbWpxt4NVyBW6w
                                                                                                                                                                                                                                                                                                                                                                                                                                                        &loading=async&libraries=places,drawing&callback=myMap&language=ar&region=EG">
    </script>
    <script>
        document.getElementById('is_multi_day').addEventListener('change', function() {
            let endDateInput = document.getElementById('end_day');
            if (this.checked) {
                this.value = "1"; // Set value to 1 when checked
                endDateInput.removeAttribute('disabled');
            } else {
                this.value = "0"; // Set value to 0 when unchecked
                endDateInput.setAttribute('disabled', 'disabled');
                endDateInput.value = ""; // Clear the end date when disabled
            }
        });
    </script>
@endpush
