<?php

namespace App\Http\Controllers;

use App\Event_Attending;
use App\Language;
use App\User;
use Illuminate\Http\Request;
use App\Event;
use App\Location;
use App\Role;
use App\Education;
use App\Review;
use Illuminate\Validation\Rule;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\Auth;




class EventController extends Controller
{
    //


    public function getColumnName($row_id, $table_name){
        $id=$row_id;
        $names=$table_name::where('id', $id)->get();
        $col_name=null;
        foreach($names as $name){
            $col_name=$name;
        }
        return $col_name->name;
    }

    public function isUserAttending($event){
        $user_loggedin = Auth::user()->id;

        $attendee_role=Role::where('project/event', 'event')->where('title', 'attendee')->get()->first();
        $going=Event_Attending::where('user_id', $user_loggedin)->where('event_id', $event->id)->where('role_id', $attendee_role->id)->get()->first();

        if($going==null){
            $going="not_going"; //set going button
        }
        else{
            $going="going"; //set ungoing button
        }
        return $going;
    }

    public function getOrganizerInfo($event){

        $organizer_role=Role::where('project/event', 'event')->where('title', 'organizer')->get()->first();
        $organizer_role_id=$organizer_role->id;

        $event_id=$event->id;

        $event_attending=Event_Attending::where('event_id', $event_id)->where('role_id', $organizer_role_id)->get()->first();

        $organizer_id=$event_attending->user_id;

        $organizer=User::where('id', $organizer_id)->get()->first();

        return $organizer;

    }


    public function getAllAttendees($event_id){
        $attendee_role=Role::where('project/event', 'event')->where('title', 'attendee')->get()->first();
        $attendee_role_id=$attendee_role->id;

        $attendees=Event_Attending::where('event_id', $event_id)->where('role_id', $attendee_role_id)->get();

        return $attendees;
    }

    public function numberOfAttendees($event_id){

        $attendees=$this->getAllAttendees($event_id);
        return $attendees->count();

    }


    public function showDetails($name){

        // event info

        $event=Event::where('name', $name)->get()->first();
        $event_id=$event->id;

        //check for current user attendance

        $going=$this->isUserAttending($event);

        // reviews
        $reviews=$event->reviews;


        //location and language

        $location_name=$this->getColumnName($event->loc_id, Location::class);
        $language_name=$this->getColumnName($event->lang_id, Language::class);


        //organizer info

        $organizer=$this->getOrganizerInfo($event);

        $organizer_name=$organizer->name;
        $organizer_surname=$organizer->surname;
        $organizer_position=$organizer->position;
        $organizer_email=$organizer->email;

        // get all attendees
        $attendees=$this->getAllAttendees($event_id);
        $num_attendees=$attendees->count();

        //
        $page_name="event";

        // page-top button
        $button="";


        //setting slider

        //$this->setSlider($num_attendees);

        return view('event', compact('reviews','num_attendees','button','event', 'location_name', 'language_name', 'organizer_name', 'organizer_surname', 'organizer_position','organizer_email', 'attendees', 'going', 'page_name'));
    }




    public function goingEvent(Request $request, $name)
    {

        //event ifo
        $event= Event::where('name', $name)->get()->first();
        $event_id = $event->id;

        //user info
        $user_id = $request['id_going'];
        $user = User::findOrFail($user_id);
        $user_clicked_name = $user->name;
        $user_clicked_surname = $user->surname;
        $user_clicked_position = $user->position;
        $user_photo=$user->photo_link;


        // event attending
        $role = Role::where('title', 'attendee')->where('project/event', 'event')->get()->first();

        $event_attendings = Event_Attending::where('user_id', $user_id)->where('event_id', $event_id)->get();

        if ($event_attendings->isEmpty()) {
            Event_Attending::create([ 'event_id' => $event_id, 'role_id' => $role->id, 'user_id' => $user->id]);
            return response()->json(['name'=>$user_clicked_name, 'surname'=>$user_clicked_surname, 'position'=>$user_clicked_position, 'photo'=>$user_photo]);

        }
        else {
            return response()->json(['msg'=>already_checked]);
        }

    }



    public function ungoingEvent(Request $request, $name){

        $role = Role::where('title', 'attendee')->where('project/event','event')->get()->first();
        $event_id=Event::where('name', $name)->get()->first();
        $event_attendings=Event_Attending::where('user_id', $request['id'])->where('event_id',$event_id->id)->where('role_id', $role->id)->get()->first();
        $event_attendings->delete();

        $num_attendees=$this->numberOfAttendees($event_id);

        return response()->json(['num_attendees'=>$num_attendees]);


    }


    public function editEvent(Request $request, $name){

        $event=Event::where('name', $name)->get()->first();


        $description=$request['event_description'];
        $date=$request['event_date'];
        $time=$request['event_time'];
        $lang=$request['event_language'];
        $loc=$request['event_location'];
        $lang_id=Language::where('name', $lang)->get()->first()->id;
        $loc_id=Location::where('name', $loc)->get()->first()->id;

        Event::where('id', $event->id)->update(['description'=>$description, 'time'=>$time, 'date'=>$date, 'lang_id'=>$lang_id, 'loc_id'=>$loc_id]);

        return response()->json(['name'=>"great"]);
    }

// this
    public function saveReview(Request $request){
        $review = new Review();
        $review->description = $request['description'];
        $review->user_id = Auth::id();
        $review->created_at = Carbon::now();
        $review->updated_at = Carbon::now();
        $review->date_posted = Carbon::now();
        $event = Event::where('name', $request['project_event_select'])->get()->toArray();
        $project = Project::where('name', $request['project_event_select'])->get()->toArray();
        if(count($event)>0 && count($project)==0){
            $review->event_id = $event[0]['id'];
            $review->save();
        }
        else if(count($project)>0 && count($event)==0){
            $review->project_id = $project[0]['id'];
            $review->save();
        }
        else
            return false;




    }



}
