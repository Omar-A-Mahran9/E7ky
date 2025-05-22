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
                <h3 class="fw-bold m-0">{{ __('Sessions list') }}</h3>
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
                        class="form-control form-control-solid ps-10 w-250px" placeholder="{{ __('Search for sessions') }}">
                </div>
                <!--end::Search-->

                <!--begin::Toolbar-->
                <div id="add_btn" data-bs-toggle="modal" data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">
                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-original-title="Coming Soon" data-kt-initialized="1">
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                    fill="currentColor"></rect>
                            </svg>
                        </span>
                        {{ __('Add Session') }}
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
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.sessions.store') }}" method="post"
        data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <div class="modal fade modal-lg" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">{{ __('Add new session') }}</h5>
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
                                    placeholder="default.png" type="editable">
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

                        <div class="row">


                            <div class="col-md-6 fv-row">
                                <label for="description_ar_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Description ar') }}</label>
                                <textarea name="description_ar" class="form-control" id="description_ar_inp" rows="3"
                                    placeholder="{{ __('Description In Arabic') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label for="description_en_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Description en') }}</label>
                                <textarea name="description_en" class="form-control" id="description_en_inp" rows="3"
                                    placeholder="{{ __('Description In English') }}"></textarea>
                                <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
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
                                <label for="events_inp"
                                    class="form-label required fs-6 fw-bold mb-3">{{ __('Events') }}</label>
                                <select class="form-select form-select-solid" data-dir="{{ getDirection() }}"
                                    name="event_id" id="events_inp" data-control="select2"
                                    data-placeholder="{{ __('Select events') }}" data-allow-clear="true">
                                    <option value="" selected> </option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}"> {{ $event->name }} </option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="event_id"></div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label for="day_inp"
                                    class="form-label required fs-6 fw-bold mb-3">{{ __('Days') }}</label>
                                <select class="form-select form-select-solid" data-dir="{{ getDirection() }}"
                                    name="day_id" id="day_inp" data-control="select2"
                                    data-placeholder="{{ __('Select day') }}" data-allow-clear="true">
                                    <option value="" selected> </option>

                                    @foreach ($days as $day)
                                        <option value="{{ $day->id }}"> {{ $day->name }} </option>
                                    @endforeach
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="day_id"></div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-6 fv-row">
                                <label class="form-label required fs-6 fw-bold">{{ __('Capacity') }}</label>
                                <input type="number" name="capacity" class="form-control" min="1">
                                <div class="fv-plugins-message-container invalid-feedback" id="capacity"></div>

                            </div>




                            <div class="col-md-6 fv-row">
                                <label for="location_inp"
                                    class="form-label required fs-6 fw-bold">{{ __('Location') }}</label>
                                <input type="text" id="location_inp" name="location" class="form-control"
                                    placeholder="{{ __('Enter session location') }}">
                                <div class="fv-plugins-message-container invalid-feedback" id="location"></div>
                            </div>
                        </div>

                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="customer_ids_inp"
                                class="form-label required fs-6 fw-bold mb-3">{{ __('Customer') }}</label>
                            <select class="form-select form-select-solid" multiple="multiple"
                                data-dir="{{ getDirection() }}" name="customer_ids[]" id="customer_ids_inp"
                                data-control="select2" data-placeholder="{{ __('Select customer') }}"
                                data-allow-clear="true">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->first_name . ' ' . $customer->last_name }} </option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="customer_ids"></div>
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
    <script src="{{ asset('assets/dashboard/js/datatables/sessions.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#add_btn").click(function(e) {
                e.preventDefault();

                $("#form_title").text(__('Add new session'));
                $("[name='_method']").remove();
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/sessions`);
                $('.image-input-wrapper').css('background-image', `url('/placeholder_images/default.png')`);
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
        $(document).ready(function() {
            $('#events_inp').on('change', function() {
                var eventId = $(this).val();
                var daySelect = $('#day_inp');

                // Clear previous options
                daySelect.empty().append('<option value="">{{ __('Select day') }}</option>');

                if (eventId) {
                    $.ajax({
                        url: '/dashboard/get-days/' + eventId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(key, day) {
                                    daySelect.append('<option value="' + day.id + '">' +
                                        day.name + '</option>');
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
