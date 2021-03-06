@extends ('layouts.app')

@section('title', 'Account')


@section('include_css')
    @parent
    <link rel="stylesheet" href= {{ URL::asset('css/main.css') }}>

@endsection


@section('page_top_picture')
    @parent
    @include('/php/page_top_picture')
@endsection



@section('main')
    @parent
    <div class="container-fluid sidebar_section">
        <div class="row">
            <div class="col-sm-3 col-md-2 d-none d-sm-block">
                @include('/php/sidebar_menu')
            </div>
            <div class="col-sm-9 col-md-10  col-xs-12 main_content_section">

                <div class="container container-left-margin">
                    <div class="row">
                        <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                            <h5 class="section_title">Account</h5>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Old password</label>
                            </div>
                            <div class="col-md-4">
                                <input type="password" required autocomplete="off">
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>New password</label>
                            </div>
                            <div class="col-md-4">
                                <input type="password" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Repeat new password</label>
                            </div>
                            <div class="col-md-4">
                                <input type="password" required autocomplete="off">
                            </div>
                        </div>
                    </div>


                    <button class="save_btn" id="save_password" type="submit">
                        <h6>Save changes</h6>
                    </button>
                    <button class="cancel_btn" id="cancel_password" type="reset">
                        <h6>Cancel</h6>
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
