<div class="col-md-12 click_to_add experience" id="<?php
    if($experience_count!=0) {
        echo "experience_" . $experience->id;
    }
    else
        echo " "; ?>">

    <div class="experience_div">
        <input name="company_position" id="position" placeholder="Position" autocomplete="off" required
               value="<?php if($experience_count!=0) {
                   if(!is_null($experience->position->name))
                       echo $experience->position->name;} ?>" disabled="disabled" > <!--Position-->

        <input name="company_name" id="company"  disabled="disabled" placeholder="Company" autocomplete="off" required value="<?php if($experience_count!=0) {
            if(!is_null($experience->company->name))
                echo $experience->company->name;} ?>" >

        <input name="from_period_experience" class="from_period_experience" type="text" placeholder="From" autocomplete="off" required value="<?php if($experience_count!=0) {
            if(!is_null($experience->start_date))
                echo $experience->start_date;} ?>"  disabled="disabled">

        <input name="to_period_experience" class="to_period_experience" type="text" placeholder="To" autocomplete="off"
               value="<?php if($experience_count!=0) {
                   if (!is_null($experience->end_date)) {
                       if ( time()<strtotime($experience->end_date) ) {
                           echo "present";
                       } else {
                           echo $experience->end_date;
                       }
                   }
               }

               ?>" disabled="disabled" id="to_period_experience_<?php if($experience_count!=0) {
                                                                                echo $experience->id;
                                                                         }
                                                                            else
                                                                                echo ""; ?>" >

        <div style="display: none;" class="checkbox_div">
            <input type="checkbox" disabled="disabled"  name="current_work" id="current_work_<?php if($experience_count!=0) {
                echo $experience->id;
            }
            else
                echo ""; ?>" class="current_work_chbox" style="vertical-align: middle; display: inline-block; margin-right: 2%;">
            <label for="current_work">Current work</label>
        </div>

        <textarea name="description" rows="1" cols="80" maxlength="450" id="position_description" class="expand"  placeholder="Experience description" disabled="disabled" required="required"><?php if($experience_count!=0) {
                if(!is_null($experience->description))
                    echo $experience->description;} ?></textarea>

        <a class="delete_icon delete_btn"><i class="far fa-trash-alt"></i></a>

    </div>

   <!-- <div class="read_more_btn">
        <h6>read more</h6>
    </div> -->


</div>


