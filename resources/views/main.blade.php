@extends('template.main_auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            @if (session('message'))
                            <div class="alert alert-{{ session('icon') }}">
                                {{ session('message') }}
                            </div>
                            @endif
                            <form class="user">
                                <input type="hidden" name="region" value="{{ json_encode($region) }}">
                                <div class="form-group">
                                    <select class="form-control" name="province">
                                        <option value="" hidden>Province</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="regency" style="display: none">
                                        <option value="" hidden>Regency</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="district" style="display: none">
                                        <option value="" hidden>District</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="village" style="display: none">
                                        <option value="" hidden>Village</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-control-user" placeholder="Email Address">
                                    <div class="ml-2 valid-feedback" id="email-feedback"></div>
                                </div>
                                <button type="button" title="Subscribe" class="btn btn-danger btn-user btn-block">Subscribe</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            let appUrl  = $('meta[name="domain"]').attr('content');
            let token   = $('meta[name="token"]').attr('content');
            let regions = JSON.parse($('input[name="region"]').val());

            regions.forEach(function (region, i) {
                if (i + 1 < regions.length)
                $(`select[name="${region}"]`).on('change', function () {
                    showLoading();
                    option($(this).val(), region, i);
                });
            });

            function option(id, region, iRegion) {
                $.ajax({
                    url: `${appUrl}/${iRegion}/${id}`,
                    type: 'get',
                    dataType: 'json',

                    success: function (data) {
                        regions.forEach(function (reg, iReg) {
                            let select = $(`select[name="${regions[iReg + 1]}"]`);
                            if (iRegion == iReg) {
                                select.show(500);
                                select.html(
                                    /* html */ `
                                    <option value="" hidden>${ucFirst(region)}</option>
                                    ${data.data.map(function (value) {
                                        return /* html */ `
                                        <option value="${value.id}">${value.name}</option>
                                        `;
                                    }).join('')}
                                    `
                                );
                            } else if (iRegion < iReg) {
                                select.hide(500);
                                select.html(/* html */ `<option value="" hidden>${ucFirst(region)}</option>`);
                            }
                        });
                        hideLoading();
                    },

                    error: function (xhr, status, error) {
                        var errorMessage = `${xhr.status}: ${xhr.statusText}`;
                        alert(`Error - ${errorMessage}`);
                        hideLoading();
                    },
                });
            }

            $('button[title="Subscribe"]').on('click', function () {
                showLoading();

                $.ajax({
                    url: `${appUrl}/subscribe`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: token,
                        email: $('input[name="email"]').val(),
                    },

                    success: function (data) {
                        ['email'].forEach(function (input) {
                            $(`input[name="${input}"]`).removeClass('is-invalid').addClass('is-valid');
                            $(`#${input}-feedback`).removeClass('invalid-feedback').addClass('valid-feedback').html(data.message);
                        });
                        hideLoading();
                    },

                    error: function (xhr, status, error) {
                        if (xhr.status === 422 ) {
                            var response = JSON.parse(xhr.responseText);
                            $.each(response.errors, function (key, val) {
                                $(`input[name="${key}"]`).removeClass('is-valid').addClass('is-invalid');
                                $(`#${key}-feedback`).removeClass('valid-feedback').addClass('invalid-feedback').html(val[0]);
                            });
                        }
                        // var errorMessage = `${xhr.status}: ${xhr.statusText}`;
                        // alert(`Error - ${errorMessage}`);
                        hideLoading();
                    },
                });
            });

            function ucFirst(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // * Loading
            function showLoading() {
                $('.loading').show();
            }

            function hideLoading() {
                $('.loading').hide();
            }
        });
    </script>
@endpush
