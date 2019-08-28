$(function () {
    $('.delete-user').click(function () {
        var userId = $(this).attr('user-id');
        $(this).parent().parent().parent().remove();
        $.ajax({
            url: '/admin/user/delete',
            type: 'POST',
            data: {id: userId},
            success: function (res) {

            },
            error: function (err) {

            }
        })
    });

    $('.delete-task').click(function () {
        var id = $(this).attr('task-id');
        $(this).parent().parent().parent().remove();
        $.ajax({
            url: '/admin/assign/delete',
            type: 'POST',
            data: {id: id},
            success: function (res) {

            },
            error: function (err) {

            }
        })
    });


    $('.delete-user-task').click(function () {
        var projectName = this.parentNode.parentNode.parentNode.cells[0].textContent;
        var userName = this.parentNode.parentNode.parentNode.cells[4].textContent;
        if (confirm(`Xóa ` + userName.trim() + ` khỏi project ` + projectName.trim() + `?`)) {
            var userId = $(this).attr('user-id');
            $(this).closest('button').remove();
            $.ajax({
                url: '/admin/task/deleteUserTask',
                type: 'POST',
                data: {id: userId},
                success: function (res) {

                },
                error: function (err) {

                }
            })
        }
    });

    $('#Mybtn').click(function () {
        $('#MyForm').toggle(500);
    });

    $('.delete-project').click(function () {
        var name = this.parentNode.parentNode.parentNode.cells[1].textContent;
        if (confirm(`Xóa project ` + name + `?`)) {
            var projectId = $(this).attr('project-id');
            $(this).parent().parent().parent().remove();
            $.ajax({
                url: '/admin/project/delete',
                type: 'POST',
                data: {id: projectId},
                success: function (res) {

                },
                error: function (err) {

                }
            })
        }
    })

    $('#project_id').on('change', function (e) {
        var project_id = e.target.value;
        $.post('/admin/project/ajax-task?project_id=' + project_id, function (data) {
            $('#task_id').empty();
            $.each(data, function (index, tasks) {
                $('#task_id').append('<option value="' + tasks.id + '">' + tasks.content + '</option>')
            })
        })
    });

    $('.delete-department').click(function () {
        var name = this.parentNode.parentNode.parentNode.cells[1].textContent;
        if (confirm(`Xóa phòng ban ` + name + `?`)) {
            var departmentId = $(this).attr('department-id');
            $(this).parent().parent().parent().remove();
            $.ajax({
                url: '/admin/department/delete',
                type: 'POST',
                data: {id: departmentId},
                success: function (res) {

                },
                error: function (err) {

                }
            })
        }
    });

    $('.delete-customer').click(function () {
        var name = this.parentNode.parentNode.parentNode.cells[1].textContent;
        if (confirm(`Xác nhận xóa khách hàng ` + name + `?`)) {
            var customerId = $(this).attr('customer-id');
            $(this).parent().parent().parent().remove();
            $.ajax({
                url: '/admin/customer/delete',
                type: 'POST',
                data: {id: customerId},
                success: function (res) {

                },
                error: function (err) {

                }
            })
        }
    });

});
