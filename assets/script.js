$(document).ready(function() {
    loadEmployees();
    loadProjects();
    loadProjectList();
    console.log("HELLO");
    // Add or Update Employee
    $("#employeeForm").submit(function(e) {
        e.preventDefault();
        if($("#work_hrs").val() > 0 && $("#rate").val() > 0 || $("#project option:selected").text() == "No assigned project"){
            $.ajax({
                url: "save.php",
                type: "POST",
                data: $(this).serialize(),
                success: function(response){
                    alert(response);
                    $("#employeeForm")[0].reset();
                    $("#id").val("");
                    $("#employee_id").val("");
                    $("#editmode").val("");
                    $("#submit-btn").html("Add Employee");
                    loadEmployees();
                },
                error: function(xhr, status, error){
                    console.log("Error: " + error);
                }
            });
        } else {
            alert("Enter a positive working hours");
            $("#employeeForm")[0].reset();
            $("#id").val("");
            $("#employee_id").val("");
            $("#editmode").val("");
            $("#submit-btn").html("Add Employee");
            loadEmployees();
        }
        $("#work_hrs").prop('disabled', false);
        $("#project").prop("disabled", false);
        $("#rate").prop('disabled', false);
        $("#rate").attr('readonly', false);
        $("#position").prop('disabled', false);
        $("#fname").prop('disabled', false);
    });

    //Add or Update Project
    $("#projectForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "saveProject.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                alert(response);
                $("#projectForm")[0].reset();
                $("#id").val("");
                $("#submit-btn").html("Add Project");
                loadProjects();
            },
            error: function(xhr, status, error){
                console.log("Error: " + error);
            }
        });
    });

    // Load Employees
    function loadEmployees() {
        $.get("fetch.php", function(data) {
            $("#employeeTable").html(data);
        });
    }

    //Load Projects
    function loadProjects() {
        $.get("fetchProject.php", function(data) {
            $("#projectTable").html(data);
        });
    }

    //Load Projects List
    function loadProjectList(){
        $.ajax({
            url: "getProjectList.php",
            type: "GET",
            dataType: "json",
            success: function(data){
                $('#project').empty();
                for(var i = 0; i < data.length; i++){
                    $('#project').append('<option value="' + data[i].id + '">' + data[i].project_name + '</option>');
                }
            },
            error: function(xhr, status, error){
                console.log("Error: " + error);
            }
        });
    }

    // Edit Employee and Project
    $(document).on("click", ".editBtn", function() {
        $("#employeeForm")[0].reset();
        $("#id").val("");
        $("#employee_id").val("");
        $("#editmode").val("");
        
        if($(this).text() == "Edit Emp"){
            $("#work_hrs").prop('disabled', true);
            $("#rate").attr("readonly", false);
            $("#fname").prop("disabled", false);
            $("#position").prop("disabled", false);
            $("#project").prop("disabled", true);
            $("#submit-btn").html("Update Employee");
        } else {
            $("#rate").attr("readonly", true);
            $("#fname").prop("disabled", true);
            $("#position").prop("disabled", true);
            $("#work_hrs").prop('disabled', false);
            $("#project").prop("disabled", false);
            $("#submit-btn").html("Update Project");
        }
        

        $("#id").val($(this).data("id"));
        $("#employee_id").val($(this).data("employee_id"));
        $("#editmode").val($(this).data("editmode"));
        $("#fname").val($(this).data("fname"));
        $("#position").val($(this).data("position"));
        $("#rate").val($(this).data("rate"));
        $("#work_hrs").val($(this).data("work_hrs"));
        $("#salary").val($(this).data("salary"));
        $("#project").val($(this).data("project"));
       

    });


    // Edit Projects(Project Form)
    $(document).on("click", ".editBtn2", function() {
        $("#id").val($(this).data("id"));
        $("#project").val($(this).data("project"));
        $("#submit-btn").html("Update Project");
    });

    // Delete Employee
    $(document).on("click", ".deleteBtn", function() {
        if (confirm("Are you sure?")) {
            $.post("delete.php", { id: $(this).data("id"), mode: "emp"}, function(response) {
                alert(response);
                loadEmployees();
            });
        }
        $("#employeeForm")[0].reset();
        $("#id").val("");
        $("#employee_id").val("");
    });

    // Delete Employee Project
    $(document).on("click", ".PdeleteBtn", function() {
        if (confirm("Are you sure?")) {
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: { id: $(this).data("id"), mode: "proj" },
                success: function(response){
                    alert(response);
                    loadEmployees();
                },
                error: function(xhr, status, error){
                    console.log("Error: " + error);
                }
            });
        }
        $("#employeeForm")[0].reset();
        $("#id").val("");
        $("#employee_id").val("");
    });

    //Delete Project
    $(document).on("click", ".deleteBtn2", function() {
        if (confirm("Are you sure?")) {
            $.ajax({
                url: "deleteProject.php",
                type: "POST",
                data: { id: $(this).data("id"), mode: "proj" },
                success: function(response){
                    alert(response);
                    loadProjects();
                },
                error: function(xhr, status, error){
                    console.log("Error: " + error);
                }
            });
        }
        $("#projectForm")[0].reset();
        $("#id").val("");
    });


    //Salary Calculation
    $("#rate, #work_hrs").change(function(){
        $("#salary").val($("#work_hrs").val() * $("#rate").val());
    }); 

    //Checkbox
    $("#shemp").change(function(){
        if($(this).is(':checked')){
            $.get("fetch_2.php", function(data) {
                $("#employeeTable").html(data);
            });
        } else {
            loadEmployees();
        }
    });

    $("#login_form").submit(function(e){
        e.preventDefault();
        var email = $("#login_email").val();
        var password = $("#login_password").val();

        $.ajax({
            url: "login_process.php", 
            type: "POST",
            data: { login_email: email, login_password: password },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    location.href = 'employees.php'; 
                } else {
                    alert(response.message); 
                }
            },
            error: function() {
                location.href = 'employees.php'; 
            }
        });
    });

    $("#registration_form").submit(function(e) {
        e.preventDefault();
            $.post("regis_process.php", $(this).serialize(), function(response) {
                alert(response);
            });
        
    });

    $("#project").on('change', function() {
        if($("#project option:selected").text() == "No assigned project"){
            $("#work_hrs").prop("disabled", true);
            $("#rate").prop("disabled", true);
        } else {
            $("#work_hrs").prop("disabled", false);
            $("#rate").prop("disabled", false);
        }
    });
});