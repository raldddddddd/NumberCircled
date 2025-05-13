$(document).ready(function () {
    checkSuper();
    mainloadTables();
    $("#login_form").submit(function (e) {
        e.preventDefault();
        var email = $("#login_email").val();
        var password = $("#login_password").val();

        $.ajax({
            url: "/NumberCircled/app/controller/login_process.php",
            type: "POST",
            data: { login_email: email, login_password: password },
            dataType: "text",
            success: function (response) {
                switch (response.trim()) {
                    case "1":
                    case "2":
                        location.href = './admin/dashboard.php';
                        break;
                    case "3":
                        location.href = './main_page/main_page.html';
                        break;
                    case "No Account":
                    case "Invalid Password":
                        alert(response);
                        break;
                    default:
                        alert("Unexpected response: " + response);
                }
            },
            error: function (error) {
                alert("Error" + error);
            }
        });
    });

    $("#registration_form").submit(function (e) {
        e.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();
        var conf_password = $("#conf_password").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();

        if (password !== conf_password) {
            console.log("asdsadsd")
            alert('Passwords do not match!');
        } else {
            $.ajax({
                url: "/NumberCircled/app/controller/regis_process.php",
                type: "POST",
                data: { regis_email: email, regis_password: password, regis_conf_password: conf_password, regis_first_name: first_name, regis_last_name: last_name },
                dataType: "text",
                success: function (response) {
                    if (response.includes("success")) {
                        location.href = 'login.php';
                    } else {
                        alert(response);
                    }
                },
                error: function (error) {
                    alert("Error: " + error.statusText);
                }
            });
        }


    });


    $("#deleteReviewBtn").click(function(e){
        e.preventDefault();
        var rating = $('input[name="rating"]:checked').val();
        var review = $('#textReview').val().trim();

        $.ajax({
            url: "/NumberCircled/app/controller/review_process.php",
            method: "POST",
            data: {
                mode: '3',
                rating: $("input[name='rating']:checked").val(),
                comment: $("#textReview").val(),
                movie_id: $("#movie_id").val(),
                user_id: $("#user_id").val()
            },
            success: function(data){
                alert(data);
                location.href = '/NumberCircled/app/view/movie_review/movie_review_page.php';
            },
            error: function () {
                alert('Failed to delete movie review data.');
            }
        });
    
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
        $.ajax({
            url: "/NumberCircled/app/controller/review_process.php",
            method: "POST",
            data: {
                mode: $("#existing_review").val(),
                rating: $("input[name='rating']:checked").val(),
                comment: $("#textReview").val(),
                movie_id: $("#movie_id").val(),
                user_id: $("#user_id").val()
            },
            success: function(data){
                alert(data);
                location.href = '/NumberCircled/app/view/movie_review/movie_review_page.php';
            },
            error: function () {
                alert('Failed to update movie review data.');
            }
        });
    
        alert(`Thanks for your review!\n\nRating: ${rating} star(s)\nReview: ${review}`);
        $('#reviewModal').fadeOut();
        $('#reviewForm')[0].reset();
    });

    $(document).on('click', '#editSemanticsBtn', function (e) {
        e.preventDefault();
        $('#semanticModal').modal('show'); // or use Bootstrap.Modal version
    });


    $('#semanticForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();
        
        $.post('/NumberCircled/app/controller/add_semantic_word.php', formData, function (response) {
            alert(response);
            $('#semanticForm')[0].reset();
            $('#semanticModal').modal('hide');
        });
    });

    function checkSuper() {
        if ($.inArray($("#role_id").val(), ["2", "3"]) != -1) {
            $("#adminOpt").remove();
        }
    }
    
    function mainloadTables() {
        //Review
        $.ajax({
        url: "/NumberCircled/app/controller/fetch/review_fetch.php",
        method: "GET",
        data: {movie: $("#movie_id").val()},
        dataType: "json",
        success: function(data){
            if(window.location.pathname === '/NumberCircled/app/view/movie_review/movie_review_page.php'){
                var genres = "";
                $.each(data.movie['0'], function(key, value) {
                    if(key == "release_date"){
                        $("[name='release_date']").text(value.split("-")[0])
                    } else if(key == "image_url"){
                        $("[name='image_url']").css("background",`url(${value})no-repeat center`);
                        $(".modal-poster").css("background",`url(${value})no-repeat center`);
                        $(".hero-section").css("background",`linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)), url(${value})no-repeat center`);
                    } else {
                        $(`[name='${key}']`).text(value);
                    }
                });

                $.each(data.review_detail['0'], function(key, value) {
                    $(`[name='${key}']`).text(value);

                });

                for(var num in data.genre){
                    genres += `<span class='genre-pill'>${data.genre[num]['genre']}</span>`;
                }

                
                if($("#existing_review").val() == 1){
                    $("#reviewBtn").text("Update Your Review");
                    $('#deleteReviewBtn').removeAttr('hidden');
                }


                $(".genre-list").append(genres);
                $(".modal-title").text(data.movie['0']['name']);
                $(".modal-year").text(data.movie['0']['release_date']);
            
            }
        },
        error: function () {
            alert('Failed to fetch movie review data.');
        }
    });

    //User Review List
    $.ajax({
        url: "/NumberCircled/app/controller/fetch/reviewList_fetch.php",
        method: "GET",
        data: {movie: $("#movie_id").attr('value')},
        success: function(data){
            $(".review-loader").html(data);
        },
        error: function(){
            alert("Failed to load USER reviews");
        }
    });


        $.get("/NumberCircled/app/controller/fetch/main_fetch.php", function (data) {
            $(".featured-movies").html(data);
        });
      
        $('#userMenu').on('show.bs.collapse', function () {
              $(this).prev().find('.toggle-icon').removeClass('fa-chevron-down').addClass('fa-chevron-up');
              console.log("sad")
          });
          $('#userMenu').on('hide.bs.collapse', function () {
              $(this).prev().find('.toggle-icon').removeClass('fa-chevron-up').addClass('fa-chevron-down');
          });

          document.addEventListener('DOMContentLoaded', function () {
              var collapseElements = document.querySelectorAll('.collapse');
              collapseElements.forEach(function (element) {
                  var bsCollapse = new bootstrap.Collapse(element, {
                      toggle: false // Optional: start with it collapsed
                  });
              });
          });
    }
})
