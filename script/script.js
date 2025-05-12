$(document).ready(function () {
    var tableData = [];
    checkSuper();
    // loadTables();
    mainloadTables();
    //loadMovieReview();

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

    $("#userForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/NumberCircled/app/controller/addUser_process.php",
            type: "POST",
            data: $(this).serialize(),
            dataType: "text",
            success: function (response) {
                if (response == "Arigato Jamal") {
                    alert("User goods");
                    $("id").val("");
                    loadTables();
                } else {
                    alert(response);
                }
            },
            error: function (error) {
                alert("Error" + error);
            }
        });
        $("#userForm")[0].reset();
    });

    $("#saveReviewBtn").click(function(){
        alert($("input[name='rating']:checked").val());
        alert($("#movie_id").val());
        alert($("#user_id").val());
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
                rating: $("input[name='rating']:checked").val(),
                movie_id: $("#movie_id").val(),
                user_id: $("#user_id").val()
            },
            success: function(data){
                alert("wow");
            },
            error: function () {
                alert('Failed to update movie review data.');
            }
        });
    
        alert(`Thanks for your review!\n\nRating: ${rating} star(s)\nReview: ${review}`);
        $('#reviewModal').fadeOut();
        $('#reviewForm')[0].reset();
    });

    $(document).on("click", ".editBtn", function () {
        $.each($(this).data(), function (name, value) {
            $("#" + name).val(value);
        });
    });

    $(document).on("click", ".deleteBtn", function () {
        $.post("../../controller/delete.php", { id: $(this).data("id") }, function (data) {
            alert(data);
            loadTables();
        })
    });

    // function loadTables() {
    //     if ($.fn.DataTable.isDataTable('#myTable')) {
    //         $('#table').DataTable().clear().destroy();
    //     }

    //     $.get("/NumberCircled/app/controller/fetch/fetch.php", { page: $("#currentPage").val() }, function (data) {
    //         $('#tableLoad').html(data);
    //         $('#table').DataTable();
    //     });
    // } 

    function mainloadTables() {
        $.get("/NumberCircled/app/controller/fetch/main_fetch.php", function (data) {
            $(".featured-movies").html(data);
        });
    }

    function checkSuper() {
        if ($.inArray($("#role_id").val(), ["2", "3"]) != -1) {
            $("#adminOpt").remove();
        }
    }

    
    //Review
    $.ajax({
        url: "/NumberCircled/app/controller/fetch/review_fetch.php",
        method: "GET",
        data: {movie: $("#movie_id").attr('value')},
        dataType: "json",
        success: function(data){
            console.log(data);
            $.each(data.movie['0'], function(key, value) {
                if(key == "release_date"){
                    $("[name='release_date']").text(value.split("-")[0])
                } else if(key == "image_url"){
                    $("[name='image_url']").css("background",`linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)), url(${value})no-repeat center`);
                } else {
                    $(`[name='${key}']`).text(value);
                }
            });

            $.each(data.review_detail['0'], function(key, value) {
                $(`[name='${key}']`).text(value);

            });

            var genres = "";
            for(var num in data.genre){
                genres += `<span class='genre-pill'>${data.genre[num]['genre']}</span>`;
            }
            $(".genre-list").append(genres);


        },
        error: function () {
            alert('Failed to fetch movie review data.');
        }
    });
    

    // admin dashboard
    $.ajax({
        url: '/NumberCircled/app/controller/dashboard-data.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#totalUsers').text(data.totalUsers);
            $('#totalReviews').text(data.totalReviews);

            const sentimentChart = new Chart(document.getElementById('sentimentChart'), {
                type: 'pie',
                data: {
                    labels: Object.keys(data.sentimentDistribution),
                    datasets: [{
                        data: Object.values(data.sentimentDistribution),
                        backgroundColor: ['#4CAF50', '#F44336', '#FFC107']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            $('#positive-words-list').empty();
            data.positiveWords.forEach(word => {
                $('#positive-words-list').append(`<span class="badge bg-success">${word.word} ${word.frequency}</span>`);
            });

            $('#negative-words-list').empty();
            data.negativeWords.forEach(word => {
                $('#negative-words-list').append(`<span class="badge bg-danger">${word.word} ${word.frequency}</span>`);
            });

            // Destroy if already initialized
            if ($.fn.DataTable.isDataTable('#trending-movies')) {
                $('#trending-movies').DataTable().clear().destroy();
            }
            if ($.fn.DataTable.isDataTable('#recentActivitiesTable')) {
                $('#recentActivitiesTable').DataTable().clear().destroy();
            }

            $('#trending-movies tbody').empty();
            data.trendingMovies.forEach(movie => {
                $('#trending-movies tbody').append(`
                    <tr>
                        <td>${movie.name}</td>
                        <td>${movie.recent_reviews}</td>
                        <td>${movie.avg_rating}</td>
                        <td>${movie.latest_sentiment}</td>
                    </tr>
                `);
            });

            $('#recentActivitiesTable tbody').empty();
            data.recentActivities.forEach(activity => {
                $('#recentActivitiesTable tbody').append(`
                    <tr>
                        <td>${activity.activity}</td>
                        <td>${activity.date}</td>
                    </tr>
                `);
            });

            $('#trending-movies').DataTable({
                order: [
                    [1, 'desc']
                ]
            });

            $('#recentActivitiesTable').DataTable({
                order: [
                    [1, 'desc']
                ]
            });
        },
        error: function () {
            alert('Failed to fetch dashboard data.');
        }
    });
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
