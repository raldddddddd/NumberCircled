$(document).ready(function(){
    $('#addReviewBtn').click(function () {
        $('#reviewModal').css({
          'position': 'fixed',
          'top': '50%',
          'left': '50%',
          'transform': 'translate(-50%, -50%)'
        }).fadeIn();
      });

    
    $('#modalCloseBtn').click(function(){
        $('#reviewModal').fadeOut();
        $('#reviewForm')[0].reset();
    });

    $('#saveReviewBtn').click(function(e){
    e.preventDefault();
      var rating = $('input[name="rating"]:checked').val();
      var review = $('#textReview').val().trim();

      if (!rating || review === '') {
        alert('Please select a rating and write a review.');
        return;
      }

      alert(`Thanks for your review!\n\nRating: ${rating} star(s)\nReview: ${review}`);
      $('#reviewModal').fadeOut();
      $('#reviewForm')[0].reset();
    });

  });