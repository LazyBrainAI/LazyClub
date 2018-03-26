<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\User;
use App\Institution;
use App\Title;
use App\Education;
use App\Experience;
use App\Position;
use App\Company;
use App\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //


    public function getProfileDetails($id)
    {

        $user = User::all()->find($id);

        // user's social network links
        $socials = $user->social_network;
        $fb="#";
        $linked="#";
        $twitter="#";
        foreach ($socials as $social){
            if ($social->sn_name == 'facebook') {
                $fb = $social->URL;
            }
            if ($social->sn_name == 'twitter') {
                $twitter = $social->URL;
            }

            if($social->sn_name == 'linkedin'){
                $linked = $social->URL;

            }

        }

        //user's projects

            if($user->teams->isEmpty()){
                $projects=null;
            }
            else{
                foreach ($user->teams as $team){
                    $projects=$team->projects;
                }
            }
            //$projects=$team->projects;




        //user's company
        $experiences=$user->experiences;
        $experience_count=$experiences->count();

         //user's education
        $educations=$user->educations;
        $education_count=$educations->count();



         return view('profile', compact('user', 'fb' , 'twitter', 'linked', 'projects', 'experiences', 'experience_count','educations', 'education_count'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request, $id){
        $user = User::findOrFail($id);

        $user->name=$request['user_name'];
        $user->position=$request['user_position'];
        $user->sector=$request['user_sector'];
        $user->email=$request['user_email'];
        $user->phone_num=$request['phone_num'];
        $user->bio=$request['bio'];
        $user->update();


        // data about education and experience
        $ed_ids=explode(",", $request->ed_ids);
        $exp_ids=explode(",", $request->exp_ids);

        $insts_id=array();
        $titles_id=array();
        $companies_id=array();
        $positions_id=array();

        $count = count($ed_ids);
        $count_exp=count($exp_ids);


        // ------------------ education data --------------

         for($i=0; $i<$count; $i++){
                $institution="institution_" . $ed_ids[$i];
                $address="institution_address_" . $ed_ids[$i];
                $title="title_".$ed_ids[$i];

                $institution_name=Input::get($institution);
                $institution_address=Input::get($address);
                $institutions=Institution::where('name', $institution_name)->get();
                $title_name=Input::get($title);
                $titles=Title::where('name', $title_name)->get();


                    if($institutions->isEmpty()){
                        //create institution
                       $inst = new Institution;
                       $inst->name=$institution_name;
                       $inst->address=$institution_address;
                       $inst->save();
                       $insts_id[]=$inst->id;
                       $msg="created";

                    }
                       if($titles->isEmpty()){
                      //create title if doesn't exist
                      $title = new Title;
                      $title->name=$title_name;
                      $title->save();
                      $titles_id[]=$title->id;

                    }
                      else { //title and institution exist
                          foreach($institutions as $institution){
                              $insts_id[]= $institution->id;
                          }
                            foreach($titles as $title){
                              $titles_id[]= $title->id;
                          }

                      }

                }

              //iterate through educations ids and update/create new eudcation record

           for($j=0; $j<$count; $j++){
                $educations=Education::where('id', $ed_ids[$j])->get();
                $from="from_period_education_" . $ed_ids[$j];
                $start_date=Input::get($from);
               $to="to_period_education_" . $ed_ids[$j];
               $end_date=Input::get($to);
                 if($educations->isEmpty()){
                    Education::create(['start_date' => $start_date, 'end_date'=> $end_date, 'user_id'=>$user->id, 'institution_id'=>$insts_id[$j], 'title_id'=>$titles_id[$j]]);
                 }
                 else {
                     Education::where('id', $ed_ids[$j])->update(['start_date' => $start_date, 'end_date'=> $end_date, 'user_id'=>$user->id, 'institution_id'=>$insts_id[$j], 'title_id'=>$titles_id[$j]]);

                 }
              }


        // ------------ experience data ----------------

        for($i=0; $i<$count_exp; $i++){
            $company="company_name_" . $exp_ids[$i];
            $position="company_position_".$exp_ids[$i];

            $company_name=Input::get($company);
            $companies=Company::where('company_name', $company_name)->get();
            $position_name=Input::get($position);
            $positions=Position::where('name', $position_name)->get();


            if($companies->isEmpty()){
                //create company if it doesn't exist
                $comp = new Company;
                $comp->company_name=$company_name;
                $comp->save();
                $companies_id[]=$comp->id;
            }
            if($positions->isEmpty()){
                //create position if doesn't exist
                $position = new Position;
                $position->name=$position_name;
                $position->save();
                $positions_id[]=$position->id;

            }
            else { //title and institution exist
                foreach($positions as $position){
                    $positions_id[]= $position->id;
                }
                foreach($companies as $company){
                    $companies_id[]= $company->id;
                }

            }

        }

        // insert or update experience record

        for($j=0; $j<$count_exp; $j++){

            $experiences=Experience::where('id', $exp_ids[$j])->get();
            $from="from_period_experience_" . $exp_ids[$j];
            $start_date=Input::get($from);
            $to="to_period_experience_" . $exp_ids[$j];
            $end_date=Input::get($to);
            $description_name="description_".$exp_ids[$j];
            $description=Input::get($description_name);

            if($experiences->isEmpty()){
                Experience::create(['start_date' => $start_date, 'end_date'=> $end_date, 'description'=>$description, 'user_id'=>$user->id, 'company_id'=>$companies_id[$j], 'position_id'=>$positions_id[$j]]);
            }
            else {
                Experience::where('id', $exp_ids[$j])->update(['start_date' => $start_date, 'end_date'=> $end_date, 'description'=>$description,'user_id'=>$user->id, 'company_id'=>$companies_id[$j], 'position_id'=>$positions_id[$j]]);

            }
        }



       // return response()->json(['name'=>$msg]);



    }



    public function deleteExperienceandEducation(Request $request, $id){
        $user=User::findOrFail($id);

        if($request['experience_id']!=null){ //delete experience
            $experience_id=$request['experience_id'];
            $user->experiences()->where('id',$experience_id)->delete();
        }
        else{
            $education_id=$request['education_id'];
            $user->educations()->where('id', $education_id)->delete();
        }
    }

}
