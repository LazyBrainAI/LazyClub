<?php include_once 'project_event_description.php'?>
<div class="col-sm-6 col-md-5 order-2 order-sm-1 padding_left">
    <div class="p_e_card">
        <div class="p_e_img">
            <h5 class="section_title"><?php echo $project['name']; ?></h5>

            <ul>
                <?php
                $team=$teams[$project->name];

                foreach($team as $attending){?>
                        <li>
                            <img class="profile_img" src="<?php echo $attending->user->photo_link?>"/>
                        </li>

                <?php } ?>
            </ul>
        </div>

        <div class="p_e_info">
            <p><?php echo length_of_description($project['description']); ?> </p>
            <div class="see_more_btn">
                <a href="<?php echo '/project/' . $project['name'] ?>" ><h6 class="h7">view
                        project</h6></a>
            </div>
        </div>
    </div>
</div>
