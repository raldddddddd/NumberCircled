$(document).ready(function() {
    var tableData = [];
    checkSuper();
    loadTables();
    retrieveTableData();
    $("#login_form").submit(function(e){
        e.preventDefault();
        var email = $("#login_email").val();
        var password = $("#login_password").val();

        $.ajax({
            url: "/admin_panel/app/controller/login_process.php", 
            type: "POST",
            data: { login_email: email, login_password: password },
            dataType: "text",
            success: function(response) {
                if (response == "goods") {
                    location.href = './app/view/admin/review_list.php'; 
                } else {
                    alert(response); 
                }
            },
            error: function(error){
                alert("Error" + error);
            }
        });
    });

    $("#registration_form").submit(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();
        var name = $("#name").val();
        var role = $("#role").val();

        $.ajax({
            url: "/admin_panel/app/controller/regis_process.php", 
            type: "POST",
            data: { regis_email: email, regis_password: password, regis_name: name, regis_role: role},
            dataType: "text",
            success: function(response) {
                if (response == "User saved successfully!") {
                    location.href = '../../index.php'; 
                } else {
                    alert(response); 
                }
            },
            error: function(error){
                alert("Error" + error);
            }
        });
    });

    $("#userForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/admin_panel/app/controller/addUser_process.php", 
            type: "POST",
            data: $(this).serialize(),
            dataType: "text",
            success: function(response) {
                if (response == "Arigato Jamal") {
                    alert("User goods");
                    $("id").val("");
                    loadTables();
                } else {
                    alert(response); 
                }
            },
            error: function(error){
                alert("Error" + error);
            }
        });
        $("#userForm")[0].reset();
    });

    $(document).on("click", ".editBtn", function() {
        $.each( $(this).data(),function(name, value) {
            $("#"+name).val(value);
         });     
    });

    $(document).on("click", ".deleteBtn", function() {
        $.post("../../controller/delete.php", {id: $(this).data("id")}, function(data){
            alert(data);
            loadTables();
        })   
    });

    function checkSuper(){
        if($.inArray($("#role_id").val(), ["2", "3"]) != -1){
            $("#adminOpt").remove();
        }
    }

    function loadTables(){
        $.get("../../controller/fetch/fetch.php", {page: $("#currentPage").val()}, function(data) {
            $("#tableLoad").html(data);
        });
    }

    function retrieveTableData(){
        $("table thead tr th").each(function(){
            tableData.push($(this).attr("abbr"));
        });
    }
});