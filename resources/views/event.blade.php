
@extends ('layouts.app')

@section('title', 'Event')


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
                <div class="container  container-left-margin">
                    <div class="row">
                        <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                            <h5 class="section_title" id="event">{{$event->name}}</h5>
                        </div>
                    </div>
                </div>
                <div class="container details_section" >
                    <div class="row justify-content-between no-gutters">
                        <div class="col-md-8 order-md-1 order-2">
                            <textarea name="event_description" maxlength="450" cols="80"  id="event_description" disabled="disabled" placeholder="Write something about event. Don't be lazy."><?php if(!is_null($event->description)){ echo $event->description;} ?></textarea>
                            <div class="read_more_btn">
                                <h6>read more</h6>
                            </div>

                        </div>
                        <div class=" col-md-3 order-md-2 order-1 details_div">
                            <h6>Event details:</h6>
                            <br>
                            <h6 class="h7" id="event_date">Date/ <input name="event_date"  type="date" disabled="disabled" required value={{$event->date}}> </h6>
                            <h6 class="h7" id="event_time">Time/ <input name="event_time"  type="time" disabled="disabled" required value= {{\Carbon\Carbon::parse($event->time)->format('H:i')}}> </h6>
                            <h6 class="h7" id="=event_loc">Location/ <input name="event_location" type="text" value="{{$location_name}}"></h6>
                            <h6 class="h7" id="=event_lang">Language/ <input name="event_language" type="text" value="{{$language_name}}"></h6>


                        </div>

                    </div>
                </div>


                <div class="container container-left-margin">
                    <div class="row">
                        <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                            <h5 class="section_title">Reviews</h5>
                        </div>
                    </div>
                </div>
                <div class="container review_section">
                    <div class="row align-items-center">
                        <div class="col-md-4 col-sm-6">
                            {{--@include('/php/review_card')--}}
                        </div>
                    </div>
                </div>


                <div class="container  container-left-margin">
                    <div class="row">
                        <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                            <h5 class="section_title">Attendees</h5>
                        </div>
                    </div>
                </div>
                <?php $user = \Illuminate\Support\Facades\Auth::user();?>
                <div class="container attendees_section">
                    <div class="row align-items-center">
                        <div class="col-md-5 organizer" id="{{$user->id}}">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-xs-6 ">
                                        <img class="profile_img" src={{ URL::asset('img/teo.jpeg') }} />
                                    </div>
                                    <div class="col-xs-6  personal_info">
                                        <h5>{{$organizer_name}} {{$organizer_surname}}</h5>
                                        <h6>{{$organizer_position}}</h6>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7  attendees">
                            <button onclick="plusDivs(-1)"><i class="fas fa-angle-left fa-2x"></i></button>
                            <button onclick="plusDivs(+1)"><i class="fas fa-angle-right fa-2x"></i></button>
                    <!--    <div class="container mySlides"> -->
                                <div class="row">
                                   @if($attendees->isEmpty())
                                       <div style="width:100%; text-align: center;" id="no_attendees_msg"><p>No attendees yet.</p></div>
                                   @else
                                        @foreach($attendees as $attendee)
                                            <div class="col-6 col-sm-4 event_attendee">
                                                <div  style="margin-bottom:20px">
                                                    <img class="attendees_img" src={{ URL::asset('img/teo.jpeg') }} />
                                                    <div class="attendee_info">
                                                        <h6>{{$attendee->user->name}} {{$attendee->user->surname}}</h6>
                                                        <h6 class="h7">{{$attendee->user->position}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif



                                </div>
                         <!--   </div> -->

                        </div>
                    </div>

                </div>
                <div class="container event_btns" style="margin-left:25px" id="{{$user->id}}" >
                    <div class="row">
                        <div class="col-sm-5 col-md-3 col-xl-2">
                            <div class="add_btn going_btn" style="margin-bottom: 10px">
                                <h6>Going</h6>
                            </div>
                        </div>

                        <div class="col-sm-5 col-md-3 col-xl-2">
                            <div class=" add_btn">
                                <h6>Ask organizer</h6>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="msg"></div>






            </div>



        </div>
    </div>

@endsection













