<form method="post" id="comment_form" onsubmit="return validateCommentForm();">
<div id="comment_box_wrapper">
<h3>Leave a comment </h3> 
<hr>

<input type="text" placeholder="What is in your brain ?" id="comment_input_box" onfocus="show_comment_credentials(this)" 
name="article_comment">

    <div id="comment_credentials">
    <input type="text" placeholder="Name" name="commentator_full_name" id="commentator_full_name">
    <span><?php // echo $commentator_nameErr; ?></span>
    <input type="text" placeholder="Email address" name="commentator_email_address" id="commentator_email_address">
    <input type="submit" value="comment">
    </div>

</div>
</form>
<div><?php echo "I am the comments section"; ?>

</div>

<script>   

    // unset the Red border color (if any)
    const comment_box_node_list = document.querySelectorAll('#comment_box_wrapper input');
    const comment_box_array = [...comment_box_node_list];
    comment_box_array.forEach(comment_box_element => {
        comment_box_element.onclick = function() {
            comment_box_element.style.borderColor = 'black';
        }
    })


    // when the comment-box is clicked the input for commentator details will render
    function show_comment_credentials(x){
        document.getElementById("comment_credentials").style.display = "block";

    }



// set the comment input boxes that should be fixed
    function setRedColor(elementId) {
        document.getElementById(elementId).style.borderColor = 'red';
    }



    function validateCommentForm(){
        let validateComment = true; 
        let validateFullName = true;
        let validateEmailAddress = true;

        // validation for comment-box
        let comment_input_box = document.getElementById("comment_input_box");
        if(comment_input_box.value == ''){
            setRedColor('comment_input_box');
            validateComment = false;
        }


        // validation for commentator-name 
        let commentator_full_name_box = document.getElementById("commentator_full_name");
        if(commentator_full_name.value == ''){
            setRedColor('commentator_full_name');
            commentator_full_name_box.placeholder = "You have an awesome full name !";
            commentator_full_name_box.classList.add('paint_placeholder_red');
            validateFullName = false;

        }

        //  validation for commentator-name 
        let commentator_email_address_box = document.getElementById("commentator_email_address");
        if(commentator_email_address_box.value == ''){
            setRedColor('commentator_email_address');
            commentator_email_address_box.placeholder = "ought to enter Email";
            commentator_email_address_box.classList.add('paint_placeholder_red');
            validateEmailAddress = false;
        }
        
        if (validateComment && validateFullName && validateEmailAddress) {
            // Now I got to execute the insert query 

                    var form_data = $('#comment_form').serialize();
                    $.ajax({
                    url:"add_comment.php",
                    method:"POST",
                    data:form_data,
                    dataType:"JSON",
                    success:function(data){
                        load_comment();
                    }

        })} else {
            return false;

        }
    }

        
    function load_comment(){
        
    }
        
    
    </script>
