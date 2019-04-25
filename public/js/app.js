var departmentId=0;
var departmentName =null;

$('.btn-group').find('.dropdown-menu').find('.edit').on('click',function(event){
    event.preventDefault();

    departmentName=event.target.parentNode.parentNode.childNodes[1];
    var department=departmentName.textContent;
    departmentId = event.target.parentNode.parentNode.dataset['departmentid'];
    $('#department-name').val(department);
    $('#editmodal').modal();
});
$('#modal-save').on('click',function(){
    $.ajax({
        method:"POST",
        url:urlEdit,
        data:{name:$('#department-name').val(),departmentId:departmentId,_token:token},
    })
    .done(function(msg) {
        $(departmentName).text(msg['new_name']);
        $('#editmodal').modal('hide');

    });

});
$('.btn-group').find('.dropdown-menu').find('.editemployee').on('click',function(event){
    event.preventDefault();

    $tr = $(this).closest('tr');
    var data=$tr.children('td').map(function(){
        return $(this).text();
    }).get();
    console.log(data);
    $('#employee_id').val(data[0]);
    $('#employee-name').val(data[1]);
    $('#employee-number').val(data[2]);
    $('#employee-email').val(data[3]);
    $('#editemployeemodal').modal();
});
$('#employee-save').on('click',function(){
    $.ajax({
        method:"POST",
        url:"/editemployee",
        data:{name:$('#employee-name').val(),mobile_number:$('#employee-number').val(),email:$('#employee-email').val(),employee_id:$('#employee_id').val(),_token:token},
    })
    .done(function() {
        
        $('#editemployeemodal').modal('hide');
        window.location.reload(true);

    });

});