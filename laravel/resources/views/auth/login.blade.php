@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 mt-5rem mb-4">
                <div class="card">
                    <div class="card-body pdm-bg-black">
                        <div class="form-group row justify-content-center text-center wbc-font h1 my-md-4">
                            <label class="col-md-10 col-form-label">BI Login</label>
                        </div>
                        @if ($errors->first('siireuser_id'))
                            <p class="text-center error error-char h5 font-weight-bold">※{{ $errors->first('siireuser_id') }}
                            </p>
                        @endif
                        @if ($errors->first('siireuser_passwd'))
                            <p class="text-center error error-char h5 font-weight-bold">
                                ※{{ $errors->first('siireuser_passwd') }}</p>
                        @endif
                        <div class="input-group my-md-4 sp-margin-login">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light" id="basic-addon1"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="siireuser_id_besend" name="siireuser_id_besend"
                                class="form-control form-control-lg @error('siireuser_id_besend') is-invalid @enderror"
                                placeholder="ログインID">
                        </div>

                        <div class="input-group my-md-4 sp-margin-login">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light" id="basic-addon2"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="siireuser_passwd_bemd5" name="siireuser_passwd_bemd5"
                                class="form-control form-control-lg @error('siireuser_passwd_bemd5') is-invalid @enderror"
                                placeholder="パスワード">
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="siireuser_id" type="hidden" name="siireuser_id">
                            <input id="siireuser_passwd" type="hidden" name="siireuser_passwd">
                            <div class="form-group row my-md-5 py-md-3 justify-content-center sp-margin-login">
                                <button type="submit" id="login-btn" class="btn btn-light font-weight-bold col-md-4">
                                    ログイン
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 col-lg-3 col-sm-5 bg-white text-center justify-content-center d-flex flex-column p-2"
                style="border-radius: 8px;">
                <a class="text-dark text-decoration-none" target="_blank"
                    href="{{ url(config('url.portal_url') . '/?password_protected_pwd=we819wbc&redirect_to=' . urlencode(config('url.portal_url') . '?pdm=1'), null, true) }}">
                    <img class="mt-0 mr-auto ml-auto"
                        src="{{ asset(config('url.portal_url') . '/wp-content/uploads/2022/03/WBC_logo.png', true) }}"
                        alt="WBC logo" height="17" width="200" style="margin-bottom: 8px;">
                    <div>ポータルサイトは<span class="ml-1 bg-primary text-white rounded p-1">こちら</span></div>
                </a>
            </div>
        </div>
    </div>
@endsection
