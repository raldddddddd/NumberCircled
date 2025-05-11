$(document).ready(function () {
    var tableData = [];
    checkSuper();
    // loadTables();
    mainloadTables()
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

    function checkSuper() {
        if ($.inArray($("#role_id").val(), ["2", "3"]) != -1) {
            $("#adminOpt").remove();
        }
    }

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

    function retrieveTableData() {
        $("table thead tr th").each(function () {
            tableData.push($(this).attr("abbr"));
        });
    }
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
