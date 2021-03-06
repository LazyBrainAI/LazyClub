@extends ('layouts.app')

@section('title', 'Events')


@section('page_top_picture')
    @parent
    @include ('/php/page_top_picture')
@endsection


@section('small_menu')
    @parent
    @include ('/php/small_sidebar_menu')
@endsection


@section('main')
    @parent

    <div class="container-fluid sidebar_section">
        <div class="row">
            <div class="col-sm-3 col-md-2 d-none d-sm-block">
                @include ('/php/sidebar_menu')
            </div>

            <div class="col-sm-9 col-md-10 col-xs-12 main_content_section events_all_section">
                <div class="container container-left-margin">
                    <div class="row">
                        {{--Event header--}}
                        <div class="col-sm-4">
                            <h4 class="section_title" id="all_events_section_title">All events</h4>
                        </div>
                        {{--Add new event button--}}
                        @if($add_new_event=="hr")
                            <div class="col-sm-4 offset-sm-4 div_btn_event_project">
                                <button class="add_new_event" data-toggle="modal" data-target="#myModal">Add new
                                </button>
                            </div>

                        @endif

                    </div>
                </div>
                {{--Event section--}}
                <div class="container" id="events_all">
                    <div class="row all_events" id="all_events_div">
                        @if(!empty($events) && count($events)>0)
                            @foreach($events as $event)
                                @include('/php/event_card_all')
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="no_events" id="no_events_at_the_moment" style="width:150%; display: none">
                    There are no events at the moment.
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    @include('/php/modal')
    @include('/php/custom_alert_window')

@endsection
@section('include_js')
    <script src={{ URL::asset('js/show_no_events_div.js') }}></script>
    <script src={{ URL::asset('js/events_delete_event.js') }}></script>
    <script src={{ URL::asset('js/events_add_new_event.js') }}></script>
        
    <script src={{URL::asset('js/events_unattend_event.js')}}></script>
    <script src={{URL::asset('js/events_attend_event.js')}}></script>

@endsection