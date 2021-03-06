
@extends ('layouts.app')

@section('title', 'Profile')
@section('id', 'body_profile')


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
         <div class="col-sm-3 col-md-2 col-5 d-sm-block">
           @include ('/php/sidebar_menu')
         </div>
         <div class="col-sm-9 col-md-10  col-xs-12 main_content_section">

                 <form id="profile_form"  accept-charset="UTF-8">


                 @csrf

                 <div class="container  container-left-margin">
                 <div class="row">
                     <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                         <h5 class="section_title">Profile</h5>
                     </div>
                 </div>
             </div>


             <div class="container details_section" >
                <div class="row justify-content-between no-gutters">
                    <div class="col-md-8 order-md-1 order-2">
                        <div class="container user_info_section">
                            <div class="row align-items-center">
                                <div class="col-xs-6 profile_img_div">
                                    <img class="profile_img" src={{ URL::asset($user->photo_link) }}  />
                                    @if($no_photo_upload!=true)
                                        <button type="button" data-toggle="modal" data-target="#image_upload_modal"><i class="fas fa-camera fa-3x"></i></button>

                                    @endif
                                </div>

                                <div class="col-xs-6  personal_info" id="{{$user->username}}">
                                    <input class="resizeable_field" name="user_name" id="name" type="text" disabled="disabled" placeholder="Name" value="<?php if(!is_null($user->name)) {echo $user->name;}  ?>" required >

                                    <input  name="surname" id="surname" type="text" disabled="disabled" placeholder="Surname" value="<?php if(!is_null($user->surname)) {echo $user->surname;}  ?>"  required style="margin-left: 1%;">
                                    <input name="user_sector" id="sector" class="hr_input" type="text" disabled="disabled" placeholder="Sector" value="<?php if(!is_null($user->sector)) { echo $user->sector;} ?>" >
                                    <input name="user_position" id="position" class="hr_input" type="text" disabled="disabled" required placeholder="Position" value="<?php if(!is_null($user->position)) {echo $user->position;} ?>" >
                                    <input name="user_email" id="email" type="email" disabled="disabled" placeholder="Email" value="<?php if(!is_null($user->email)) { echo $user->email;} ?>" required>
                                    <input name="phone_num" id="phone_num" type="text" disabled="disabled" placeholder="Phone number" value="<?php if(is_null($user->phone_num)) {echo "Phone number";} else{ echo $user->phone_num;} ?>" >
                                    <h6><a class="social_form_btn" id="linkedin" href="<?php if($linked!=null) echo $linked; else echo "#";?>"><input autocomplete="off" name="linkedin" id="ln_input" placeholder="LinkedIn |" disabled="disabled"></a>
                                        <a class="social_form_btn" id="twitter" href="<?php if($twitter!=null) echo $twitter; else echo "#";?>"><input autocomplete="off" name="twitter" id="twitter_input"  placeholder="Twitter |" disabled="disabled"></a>
                                        <a class="social_form_btn" id="fb" href="<?php if($fb!=null) echo $fb; else echo "#";?>"><input autocomplete="off" name="facebook" id="fb_input" placeholder="Facebook" disabled="disabled"></a>
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-3 order-md-2 order-1 details_div">
                        <h6>Profile details:</h6>
                        <br>
                        <h6 class="h7" id="join_date">Join date / {{$user->join_date}}</h6>
                        <h6 class="h7" id="status">Status / <select type="text" disabled="disabled" class="hr_input" name="user_status">
                                                                <option>{{$user->status}}</option>
                                                                @if($user->status=="active")
                                                                    <option>not active</option>
                                                                @else
                                                                    <option>active</option>
                                                                @endif
                                                            </select></h6>

                    {{--    <h6 class="h7" id="strength">Strength / {{$user->strength}}</h6> --}}

                    </div>

                </div>
            </div>




             <div class="container  container-left-margin">
                 <div class="row">
                     <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                         <h5 class="section_title">Bio</h5>
                     </div>
                 </div>
             </div>
             <div class="container description_section read_more_btn_parent">
                 <div class="row">
                     <div class="col-md-12">
                         <textarea name="bio" cols="80" required rows=6 class="description_count" maxlength="191" id="bio_description" disabled="disabled" placeholder="Write something about yourself. Don't be lazy." style="position: relative; width: 50%"><?php if(!is_null($user->bio)){ echo $user->bio;} ?></textarea>
                         <p style="position: absolute; bottom: -15%; right: 50%; display: none;" id="char_count_p"><span id="char_count">
                                 @if(!is_null($user->bio))
                                     {{strlen($user->bio)}}
                                  @else
                                    0
                                   @endif

                             </span>/191</p>
                         <div class="read_more_btn">
                            <h6>read more</h6>
                         </div>
                     </div>
                 </div>
             </div>


             <div class="container  container-left-margin">
                 <div class="row">
                     <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                         <h5 class="section_title">Education</h5>
                     </div>
                 </div>
             </div>
             <div class="container add_section">
                 <div class="row" id="education_section">
                     @if($education_count==0)
                         @include('/php/education')
                         @include('/php/education')
                         @else
                            @foreach($educations as $education)
                                @include('/php/education')
                                @endforeach
                     @endif
                 </div>
                 <div class="add_btn" id="add_education">
                     <h6>Add education</h6>
                 </div>
             </div>


             <div class="container  container-left-margin">
                 <div class="row">
                     <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                         <h5 class="section_title">Experience</h5>
                     </div>
                 </div>
             </div>
             <div class="container add_section">
                 <div class="row read_more_btn_parent" id="experience_section">
                     @if($experience_count==0)
                         @include('/php/experience')
                     @else
                         @foreach($experiences as $experience)
                             @include('/php/experience')
                         @endforeach
                     @endif

                 </div>
                 <div class="add_btn" id="add_experience">
                     <h6>Add experience</h6>
                 </div>
             </div>




             <div class="container container-left-margin">
                 <div class="row">
                     <div class="col-5 col-sm-4 col-md-3 col-lg-2">
                         <h5 class="section_title">Projects</h5>
                     </div>
                 </div>
             </div>

             <div class="projects_section">
                 <div class="container">
                     <div class="row">
                         @if($projects==null)
                             <div><p>No ongoing projects.</p></div>
                         @else
                             @foreach($projects as $project)
                             <div class="col-md-5">
                                @include ('/php/project_card')
                             </div>
                                 @endforeach
                             @endif
                     </div>
                 </div>
             </div>


             <div class="container container-left-margin">
                 <div class="row">
                     <div class="col-5 col-sm-4 col-md-3  col-lg-2">
                         <h5 class="section_title">Documents</h5>
                     </div>
                 </div>
             </div>
             <div class="container documents_section">
                 <div class="row align-items-center">
                     @if(!$documents->isEmpty())
                         @foreach($documents as $document)
                             <div class="col-md-3 col-sm-6">
                                 @include('/php/document')
                             </div>
                         @endforeach
                     @else

                         <p>No documents at the moment!</p>

                     @endif

                 </div>
             </div>






             <button class="save_btn"  id="save_profile" type="submit">
                 <h6>Save changes</h6>
             </button>
             <button class="cancel_btn" id="cancel_profile" type="reset">
                 <h6>Cancel</h6>
             </button>
             <div id="msg"></div>

             </form> <!--  end of form   -->



         </div>

     </div>
 </div>

 @include('/php/image_upload_modal')




@endsection

@section('include_js')
    <script src={{ URL::asset('js/resizeable_fields.js')}}></script>
    <script src={{ URL::asset('js/char_counter.js')}}></script>
    <script src={{ URL::asset('js/hide_input_field.js')}}></script>
        
    <script src={{URL::asset('js/edit_profile.js')}}></script>
    <script src={{URL::asset('js/add_delete_education.js')}}></script>
    <script src={{URL::asset('js/add_delete_experience.js')}}></script>
    <script src={{URL::asset('js/upload_image.js')}}></script>

@endsection







