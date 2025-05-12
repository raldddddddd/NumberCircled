$(document).ready(function(){
    $('#addReviewBtn').click(function () {
        $('#reviewModal').css({
          'position': 'fixed',
          'top': '50%',
          'left': '50%',
          'transform': 'translate(-50%, -50%)'
        }).fadeIn();
        if($("#existing_review").val() == 1){
          $.post("/NumberCircled/app/controller/fetch/existReview_fetch.php", {
            movie_id: $("#movie_id").val(),
            user_id: $("#user_id").val()
            }, function(data){
              var data = JSON.parse(data);
            $("#textReview").text(data[0]['comment']);
            $(`input[name='rating'][value=${Math.floor(data[0]['rating'])}]`).trigger("click");
          });
        }
    });

    
    $('#modalCloseBtn').click(function(){
        $('#reviewModal').fadeOut();
        $('#reviewForm')[0].reset();
    });
});