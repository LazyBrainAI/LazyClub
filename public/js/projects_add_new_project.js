$(document).ready(function () {
    $('#add_new_project_form').submit(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var projectsForm = $('#add_new_project_form');
        $.ajax({
            url: '/projects',
            type: 'POST',
            data: projectsForm.serialize(),
            success: function (data) {
                $('.project_saved').addClass('allgood').text('Project successfully created.').show().delay(2000).fadeOut(1000);
                document.getElementById('add_new_project_form').reset();
                var div = document.createElement('div');
                var id = data.id;
                div.setAttribute('class', 'col-sm-4 padding_left');
                div.setAttribute('id', id);
                div.innerHTML = `
        <div class="p_e_card" id="p_e_card_${data.id}">
            <div class="p_e_img" id="p_e_img_${data.id}">
                <button type="button" class="delete_project close" id="delete_project_${data.id}">&times;</button>
                <h5 class="section_title">${data.name}</h5>
                <ul>
                    <li>
                        <img class="profile_img" src=""/>
                    </li>
                    <li>
                        <img class="profile_img" src=""/>
                    </li>
                </ul>
            </div>
            <div class="p_e_info">
                <p>${data.description}</p>
                <div class="see_more_btn">
                    <a href="/project_${data.name}" style="text-decoration: none;"><h6 class="h7">view
                            project</h6></a>
                </div>
            </div>
        </div>
    </div>`;
                $('#no_projects_at_the_moment').hide();
                $(div).appendTo($('.row #all_projects'));
            },
            error: function (data) {
                console.log(data);
                $('.project_saved').addClass('notallgood').text('Project name already taken or start/end date is invalid.').show().delay(2000).fadeOut(1000);
                if(data.msg!=""){
                    $('.project_saved').addClass('notallgood').text('Team name is already taken.').show().delay(2000).fadeOut(1000);

                }
            }
        });
    });
});