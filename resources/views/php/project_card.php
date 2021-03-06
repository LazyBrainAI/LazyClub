<?php include_once "project_event_description.php";?>
<div class="p_e_card">
    <div class="p_e_img">
        <h5 class="section_title"><?php if (is_null($project->name)) echo "Project name"; else {echo $project->name;} ?></h5>
        <ul>
            <?php $team=$teams[$project->name];
                foreach($team as $attending){?>
                    <li>
                        <img class="profile_img" src="<?php echo '/'.$attending->user->photo_link?>"/>
                    </li>

                <?php } ?>
        </ul>
    </div>
    <div class="p_e_info">
        <h5>About</h5>
        <p><?php if (is_null($project->description)) echo "About"; else {echo $project->description;} ?></p>
        <div class="read_more_btn">
            <a href="<?php echo '/project/' . $project->name ?>" > <h6>view project</h6></a>
            </div>
    </div>
</div>