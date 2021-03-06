$(document).ready(function(){

    //assigning ids to education cards when there is still no info inputed by user

    var i = 1;

    $('.education').each(function () {
        if ($(this).attr('id')==' ') {
            $(this).attr('id', 'education_' + i);
        }
        i++;
    });


    $('.education input').each(function () {
        $(this).attr('name', $(this).attr('name') + "_" + $(this).parent().attr('id').split('_')[1]);

    });



    // adding education on button click

    $('#add_education').off('click').click(function (e) {
        e.stopImmediatePropagation();

        var i=0;
        $('.education').each(function () {
            var elem_id=$(this).attr('id').split('_')[1];
            if(elem_id>i){
                i=elem_id;
                console.log(elem_id);
            }

        });

        i++;
        console.log(i);


        var id = "education_" + i;

        var el=document.createElement('div');
        el.setAttribute('class','col-sm-6 click_to_add education');
        el.setAttribute('id', id);

        el.innerHTML=`
                        <input name="institution_${i}" id="institution" type="text" placeholder="Institution"  required> 
                        <input name="from_period_education_${i}" class="from_period_education" type="text" placeholder="From" required>
                        <input name="to_period_education_${i}" class="to_period_education" type="text" placeholder="To"  required>
                        <input name="title_${i}" id="title" type="text" placeholder="Title" required>
                        <a class="delete_icon delete_btn" style="display:block"><i class="far fa-trash-alt"></i></a>
                       `

        $(el).appendTo($('#education_section'));


    });


    //delete education
    $('#education_section').off('click').on('click', '.delete_icon', function (e) {

        e.stopImmediatePropagation();

        // deleting from DB with AJAX
        var parent = $(this).parent();
        var education_id = parent.attr('id').split("_")[1];
        var id = $('.personal_info').attr('id');


        $.ajax({
            type: 'DELETE',
            url: '/profile/' + id,
            data: {education_id: education_id},
            success: function () {

                parent.remove();
             /*   var j = 1;
                $('.education').each(function () {  //after removin one/more assign new id values
                    $(this).attr('id', 'education_' + j);
                    j++;
                }); */

            },
            error: function (data) {

            }


        });


    });




});