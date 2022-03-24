@extends('layouts.index')
@section('style')
    <style>
        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04aa6d;
        }

        #submitBtn {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="
                  page__heading
                  d-flex
                  flex-column flex-md-row
                  align-items-center
                  justify-content-center justify-content-lg-between
                  text-center text-lg-left">
                <h1 class="m-lg-0">Flight Plans</h1>
            </div>
        </div>
        <div class="container-fluid page__container">
            <h4 class="card-header__title mb-3">Add a Flight Plan</h4>
            <div>
                <form method="POST" action="{{ route('flight-plan.update', $flight_plan->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card card-form">
                        <!-- Additional Profile Details -->
                        <div class="row no-gutters">
                            <div class="col-lg-12 card-form__body card-body">
                                <div class="tab">
                                    @includeIf('dashboard.flight_plan.edit-steps.step1')
                                </div>
                                <div class="tab">
                                    @includeIf('dashboard.flight_plan.edit-steps.step2')
                                </div>
                                <div class="tab">
                                    @includeIf('dashboard.flight_plan.edit-steps.step3')
                                </div>
                                {{--                                <div class="tab">--}}
                                {{--                                    @includeIf('dashboard.flight_plan.steps.step4')--}}
                                {{--                                </div>--}}
                                <button class="btn btn-primary" id="prevBtn" type="button" onclick="nextPrev(-1)">Back
                                </button>
                                <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)"
                                        style="margin-left: 20px">Next
                                </button>
                                <button class="btn btn-primary" type="submit" id="submitBtn"
                                        style="margin-left: 20px">Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == x.length - 1) {
                document.getElementById("nextBtn").style.display = "none";
                document.getElementById("submitBtn").style.display = 'inline-block';
            } else {
                document.getElementById("nextBtn").style.display = "inline";
                document.getElementById("submitBtn").style.display = 'none';
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n);
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            console.log('tz');

            // Exit the function if any field in the current tab is invalid:
            // if (n == 1) return false;
            console.log('asd');
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i,
                x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>
    <script>
        $('input[name=purpose]').change(function () {
            $('#final_purpose').val($(this).val());
        });
        @if(old('purpose') != null)
        $('#final_purpose').val('{{ old('purpose') }}');
        @endif
        $('textarea[name=description]').change(function () {
            $('#final_description').val($(this).val());
        });
        @if(old('description') != null)
        $('#final_description').val('{{ old('description') }}');
        @endif
        $('select[name=timezone]').change(function () {
            $('#final_timezone').val($(this).val());
        });
        @if(old('timezone') != null)
        $('#final_timezone').val('{{ old('timezone') }}');
        @endif
        $('input[name=vlos_cylinder_radius]').change(function () {
            let vlos_cylinder_radius_unit = $('input[name=vlos_cylinder_radius_unit]:checked').val();
            $('#final_vlos_cylinder').val($(this).val() + ' ' + vlos_cylinder_radius_unit);
        });
        @if(old('vlos_cylinder_radius') != null)
        let vlos_cylinder_radius_unit = $('input[name=vlos_cylinder_radius_unit]:checked').val();
        $('#final_vlos_cylinder').val('{{ old('vlos_cylinder_radius') }}' + ' ' + vlos_cylinder_radius_unit);
        @endif
        $('input[name=vlos_cylinder_radius_unit]').change(function () {
            let vlos_cylinder_radius = $('input[name=vlos_cylinder_radius]').val();
            $('#final_vlos_cylinder').val(vlos_cylinder_radius + ' ' + $(this).val());
        });
        {{--        @if(old('vlos_cylinder_radius_unit') != null)--}}
        {{--        let vlos_cylinder_radius = $('input[name=vlos_cylinder_radius]').val();--}}
        {{--        $('#final_vlos_cylinder').val(vlos_cylinder_radius + ' ' + '{{ old('vlos_cylinder_radius_unit') }}');--}}
        {{--        @endif--}}
        $('input[name=start_date_time]').change(function () {
            $('#final_start_date_time').val($(this).val());
        });
        @if(old('start_date_time') != null)
        $('#final_start_date_time').val('{{ old('timezone') }}');
        @endif
        $('input[name=max_height]').change(function () {
            let max_height_unit = $('input[name=max_height_unit]:checked').val();
            $('#final_max_height').val($(this).val() + ' ' + max_height_unit);
        });
        $('input[name=max_height_unit]').change(function () {
            let max_height = $('input[name=max_height]').val();
            $('#final_max_height').val(max_height + ' ' + $(this).val());
        });
        @if(old('max_height') != null)
        let max_height = $('input[name=max_height]').val();
        $('#final_max_height').val(max_height + ' {{ old('max_height_unit') }}');
        @endif
        $('input[name=end_date_time]').change(function () {
            $('#final_end_date_time').val($(this).val());
        });
        @if(old('end_date_time') != null)
        $('#final_end_date_time').val('{{ old('end_date_time') }}');
        @endif

        $("#uas_operator_id").change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ route('flight-plan-uas-pilot') }}?id=" + id,
                method: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        $('#' + key).val(value);
                        $('#final_' + key).val(value);
                    });
                    $.each(data['user'], function (key, value) {
                        $('#' + key).val(value);
                        $('#final_' + key).val(value);
                    });
                }
            });
        });
        $("#aircraft_id").change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ route('aircraft') }}?id=" + id,
                method: 'GET',
                success: function (data) {
                    $.each(data, function (key, value) {
                        if (key == 'additional_information')
                            '';
                        else {
                            $('#' + key).val(value);
                            $('#final_' + key).val(value);
                        }
                    });
                    $('#aircraft_additional_information').val(data['additional_information']);
                    $('#final_aircraft_additional_information').val(data['additional_information']);
                }
            });
        });

        $("#start_date_time").flatpickr().setDate('2022-01-01');

    </script>
@endsection
