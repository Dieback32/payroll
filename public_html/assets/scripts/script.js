$(document).ready(function(){
// Alert JS
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3000);
    $('.alert').css({"bottom":"50px","left":"20px","position":"absolute","z-index":"100","width":"300px"});
//Check password
    $("#confirm-pass").keyup(function(){
        if( $('#set-pass').val() != $('#confirm-pass').val() ){
            $("#set-pass").css("border-color", "red");
            $("#confirm-pass").css("border-color", "red");
            $("#error-pass").show();
            $("#error-pass").html("*Password and Confirm Password field doest not match.");
            event.preventDefault();
        }else{
            $("#set-pass").css("border-color", "#ced4da");
            $("#confirm-pass").css("border-color", "#ced4da");
            $("#error-pass").hide();
        }
    });
//Set Monthly Salary Employee

    $(document).on('click','.set-salary',function () {
        var id = $(this).attr("id");
        console.log("ResponseText: " + id);

        $.ajax({
            url:"/dashboard/getEmployeeInfo",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#id-employee').val(id);
                $('#employee-salary').val(data.salary);
            }
        });
    });

//Set Leave Credits
    $(document).on('click','.set-leaves',function () {
        var id = $(this).attr("id");
        console.log("ResponseText: " + id);
        $.ajax({
            url:"/dashboard/getEmployeeInfo",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#idEmployee').val(id);
                $('#employee-leave').val(data.leaves);
            }
        });
    });
//Set Sick Credits
    $(document).on('click','.set-sick',function () {
        var id = $(this).attr("id");
        console.log("ResponseText: " + id);
        $.ajax({
            url:"/dashboard/getEmployeeInfo",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#employeeId').val(id);
                $('#employee-sick').val(data.sick);
            }
        });
    });

    //Set Internet Allowance
    $(document).on('click','.set-allowance',function () {
        var id = $(this).attr("id");
        $.ajax({
            url:"/dashboard/getEmployeeInfo",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + id);
                $('#employee_Id').val(id);
                $('#internet-allowance').val(data.allowance);
            }
        });
    });


//Add Designation
    $("#add-designation").click(function (e) {
        $("#items-des").append('<input id="designation-field" style="margin-top: 10px" type="text" name="designation[]" class="form-control">');
        e.preventDefault();
    });
    $(document).on("click","#remove-icon-des",function (e) {
        e.preventDefault();
        $("#designation-field").remove();
    });
    $("#add-field-des").click(function (e) {
        $(".items-des-edit").append('<input id="edit-designation-field" style="margin-top: 10px" type="text" name="designation[]" class="form-control">');
        e.preventDefault();
    });
    $(document).on("click","#remove-icon-des-edit",function (e) {
        e.preventDefault();
        $("#edit-designation-field").remove();
    });

//Edit Employee Info
    $(document).on('click','.editEmployee',function () {
        var id = $(this).attr("id");
        console.log("ResponseText: " + id);

        $.ajax({
            url:"/dashboard/getEmployeeInfo",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#id-Employee').val(data.id);
                $('#employeeID').html(data.employee_id);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#mobile').val(data.mobile);
                $('#email').val(data.email);
                $('#skype').val(data.skype);
                $('#startdate').val(data.startdate);
                $('#paypal-accnt').val(data.paypal);
                $('#em-designation').html(data.designation);
            }
        });
    });

//Delete Employee
    $(document).on('click','.deleteEmployee',function () {
        var id = $(this).attr("id");
        console.log("ResponseText: " + id);
        $.ajax({
            url:"/dashboard/getEmployeeInfo",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#emID').val(id);
            }
        });
    });

//Edit Department
    $(document).on('click','.editDepartment',function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/dashboard/getDepartmentData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#dep_id').val(data.dep_id);
                $('#department').val(data.department);
            }
        });
    });
//Delete Department
    $(document).on('click','.deleteDepartment',function () {
        var id = $(this).attr("data-id");
        $('#delete-dep').val(id);
    });

//Edit Department
    $(document).on('click','.editDesignation',function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/dashboard/getDesignationData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#des-id').val(data.des_id);
                $('#designation').val(data.designation);
            }
        });
    });
//Delete Designation
    $(document).on('click','.deleteDesignation',function () {
        var id = $(this).attr("data-id");
        $('#designationID').val(id);
    });
//Request Approval for Overtime
    $(document).on('click','.requestApproval',function () {
        var id = $(this).attr("id");
        $('#request-ot-id').val(id);
    });

//Designation options
    $('#selected-department').change(function () {
        var department = $(this).val();
        $.ajax({
            url:"/dashboard/getDesignation",
            method:"POST",
            data:{department:department},
            success:function (data) {
                console.log("ResponseText: " + department);
                $('#show-designation').html(data);
            }
        });
    });
//Request Approval for Leaves
    $(document).on('click','.requestLeave',function () {
        var id = $(this).attr("id");
        $('#employeeid').val(id);
    });
//Request Approval for Sick Leaves
    $(document).on('click','.requestSick',function () {
        var id = $(this).attr("id");
        $('#em_ID').val(id);
    });
//Remove holiday
    $(document).on('click','.removeHoliday',function () {
        var id = $(this).attr("id");
        $('#holidayID').val(id);
    });
//Validation for Holiday
    $('#set-holiday').on('submit',function () {
        if( $('#selected-holiday').val() <= $('#present-date').val()){
            $("#selected-holiday").css("border-color", "red");
            $("#check-error").html("* You can not select on past days");
            event.preventDefault();
        }
    });

//Edit Process List
    $(document).on('click','.editProcess',function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/dashboard/getProcessList",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#process-id').val(id);
                $('#description-pro').val(data.description);
                $('#status-pro').html(data.status);;
            }
        });
    });
//Delete Process List
    $(document).on('click','.deleteProcess',function () {
        var id = $(this).attr("data-id");
        $('#processID').val(id);
    });



//Payroll Page
    $('#employee_ID').on('change',function () {
        var date_from = $('#payroll_date_from').val();
        var date_to = $('#payroll_date_to').val();
        var employee_id = $(this).val();
        console.log(date_from);
        console.log(date_to);
        console.log(employee_id);
        if (employee_id == "" || date_to == "" || date_from == ""){
            console.log("Null");
            event.preventDefault();
        }else{
            $.ajax({
                url:"/dashboard/payroll",
                method:"POST",
                data:{date_from:date_from,date_to:date_to,employee_id:employee_id},
                success:function (data) {
                    $('#show-employee').html(data);
                    $("#employee_ID").css("border-color", "#ced4da");
                    $("#error-em-id").hide();
                    console.log("success");
                    event.preventDefault();
                },error:function () {
                    console.log("error");
                }
            });

            $.ajax({
                url:"/dashboard/payslipData",
                method:"POST",
                data:{date_from:date_from,date_to:date_to,employee_id:employee_id},
                dataType:"json",
                success:function (data) {
                    $('#employees_ID').val(data.id);
                    $('#create-date-from').val(data.date_from);
                    $('#create-date-to').val(data.date_to);
                    $('#create-holiday').val(data.holiday);
                    $('#create-leaves').val(data.leaves);
                    $('#create-sick').val(data.sick);
                    $('#create-worked-days').val(data.worked_days);
                    $('#create-overtime').val(data.overtime);
                    $('#create-undertime').val(data.undertime);
                    $('#create-gross').val(data.gross);
                    $('#create-total').val(data.total);
                    $('#create-deduction').val(data.deduction);
                    $('#create-net').val(data.net);
                }
            });
        }
    });


    $('#create-em-payslip').on('submit',function () {
        if ($('#employees_ID').val() == null){
            $('#error-payslip').html('*Please select the Employee ID');
            event.preventDefault();
        }else{
            $('#error-payslip').hide();
        }
    });
//Payslip
    $(document).on('click','.updatePayslipUnpaid',function () {
        var id = $(this).attr("data-id");
        $('#payslip-unpaid-id').val(id);
    });
    $(document).on('click','.updatePayslipPaid',function () {
        var id = $(this).attr("data-id");
        $('#payslip-paid-id').val(id);
    });
    $(document).on('click','.payslip-page',function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/dashboard/getPayslipData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#payslip-employeeID').html(data.employee_id);
                $('#payslip-from').html(data.date_from);
                $('#payslip-to').html(data.date_to);
                $('#payslip-name').html(data.name);
                $('#payslip-department').html(data.department);
                $('#payslip-designation').html(data.designation);
                $('#payslip-worked-days').html(data.worked_days);
                $('#payslip-paypal').html(data.paypal);
                $('#payslip-date-joined').html(data.joined);
                $('#payslip-holiday').html(data.holiday);
                $('#payslip-holiday-pay').html(data.holiday_pay);
                $('#payslip-monthly-rate').html(data.salary);
                $('#payslip-undertime').html(data.undertime);
                $('#payslip-overtime').html(data.overtime);
                $('#payslip-paid-leaves').html(data.paid_leaves);
                $('#payslip-paid-sick').html(data.paid_sick);
                $('#payslip-gross').html(data.gross);
                $('#payslip-total').html(data.total);
                $('#payslip-deduction').html(data.deduction);
                $('#payslip-net').html(data.net);
                if (data.status == 1){
                    $('.paid-logo-container').show();
                }else{
                    $('.paid-logo-container').hide();
                }
            }
        });
    });
    // Employee Payslip
    $(document).on('click','.emp-payslip-page',function () {
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/dashboard/getPayslipData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#payslip-employeeID').html(data.employee_id);
                $('#payslip-from').html(data.date_from);
                $('#payslip-to').html(data.date_to);
                $('#payslip-name').html(data.name);
                $('#payslip-department').html(data.department);
                $('#payslip-designation').html(data.designation);
                $('#payslip-worked-days').html(data.worked_days);
                $('#payslip-paypal').html(data.paypal);
                $('#payslip-date-joined').html(data.joined);
                $('#payslip-holiday').html(data.holiday);
                $('#payslip-holiday-pay').html(data.holiday_pay);
                $('#payslip-monthly-rate').html(data.salary);
                $('#payslip-undertime').html(data.undertime);
                $('#payslip-overtime').html(data.overtime);
                $('#payslip-paid-leaves').html(data.paid_leaves);
                $('#payslip-paid-sick').html(data.paid_sick);
                $('#payslip-gross').html(data.gross);
                $('#payslip-total').html(data.total);
                $('#payslip-deduction').html(data.deduction);
                $('#payslip-net').html(data.net);
                if (data.status == 1){
                    $('.paid-logo-container-emp').show();
                }else{
                    $('.paid-logo-container-emp').hide();
                }
            }
        });
    });

//Record Page
    $('#em_id').change(function () {
        var date_from =  $('#date-from').val();
        var date_to = $('#date-to').val();
        var employee_id =  $(this).val();
        if (date_from > date_to){
            $("#date-from").css("border-color", "red");
            $("#date-to").css("border-color", "red");
            $("#from-error").html("*Date From must be less than to Date To.");
            event.preventDefault();
        }else{
            $.ajax({
                url:"/dashboard/employeeRecords",
                method:"POST",
                data:{date_from:date_from,date_to:date_to,employee_id:employee_id},
                success:function (data) {
                    $('#show-records').html(data);
                    $("#date-from").css("border-color", "#ced4da");
                    $("#date-to").css("border-color", "#ced4da");
                    $("#from-error").hide();
                }
            });
        }

    });
    $('#em_id').change(function () {
        var employee_id =  $(this).val();
        $.ajax({
            url:"/dashboard/employeeNameOutput",
            method:"POST",
            data:{employee_id:employee_id},
            success:function (data) {
                $('#show-employee-name').html(data);
            }
        });
    });
});