<div class="modal fade" role="dialog" id="project_review_modal">
    <div class="modal-dialog">
        <form id="project_review_form" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_heading">Add new review</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="col-sm-12">
                    <label>Review description</label>
                    <textarea name="review_new_description" required autocomplete="off" ></textarea>
                </div>

                <div class="modal-footer" id="footer_review">
                    <div class="review_saved"></div>
                    <button type="submit" class="add_new_review" form="project_review_form">Add review</button>
                    <button type="button" class="add_new_review" data-dismiss="modal">Close</button>
                    <input type="hidden" name="action" value="review">

                    <div id="review_sent"></div>

                </div>

            </div>

        </form>
    </div>


</div>