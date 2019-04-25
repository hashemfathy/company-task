@extends('layout.master')
@section('title')
    Admin panel
@endsection
@section('content')
<!-- ----------------------------------Start heading -------------------------------- -->
<h1 class="pull-center"style="margin-bottom:50px;">{{$department->name}} list</h1>
<!-- ----------------------------------  End heading  -------------------------------- -->

<!-- ----------------------------------Start alert fault-------------------------------- -->
@if(count($errors)>0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
        <p>{{ $error}} </p>
      @endforeach
    </div>
  @endif
<!-- ----------------------------------End alert fault-------------------------------- -->
<!-- ----------------------------------Start Add employee form-------------------------------- -->
<form action="{{route('create.employee',[$department->id])}}"method="post" >
    <div class="form-group float-left">
        <label ><h4>name</h4></label>
        <input name="name" id="name" class="form-control" placeholder="name of employee!"/>
    </div>
    <div class="form-group float-left" >
        <label ><h4>Mobile number</h4></label>
        <input name="mobile_number" id="mobile" class="form-control w-60 p-2" placeholder="mobile number of employee!"/>
    </div>
    <div class="form-group">
        <label ><h4>Email</h4></label>
        <input name="email" id="email" class="form-control w-25 p-2" placeholder="email of employee!"/>
    </div>
    <button type="submit"class="btn btn-primary">Add</button>
    <div class="dropdown-divider"></div>
    {{csrf_field()}}
</form>
<!-- ----------------------------------End Add employee form-------------------------------- -->
<!-------------------------------------Start Employees list------------------------------------>
<div class="table-responsive-sm w-100 p-3"id="employees_table">
    <table class="table w-90">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">mobile number</th>
                <th scope="col">email</th>
            </tr>
        </thead>
        @foreach($employees as $employee)
        <tr><td>{{$employee->id}}</td><td>{{$employee->name}}</td><td>{{$employee->mobile_number}}</td><td>{{$employee->email}}</td>
            <td>
                <div class="btn-group" data-employeeid="{{ $employee->id }}">
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item editemployee" href="#">Edit</a>
                        <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{route('employee.delete',['employee_id'=> $employee->id ])}}">delete</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    
    {{$employees->links()}}
    </table>
</div>
<!-------------------------------------End Employees list------------------------------------>
<!-- ------------------------------start Edit Employee modal ----------------------------- -->
<div class="modal" tabindex="-1" role="dialog" id='editemployeemodal'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modal-form">
                @csrf
                <input type="hidden" id="employee_id">
                <div class="form-group">
                    <label for="formGroupExampleInput">name</label>
                    <input type="text" class="form-control"name="nameemployee" id="employee-name" placeholder="name">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">mobile number</label>
                    <input type="text" class="form-control"name="numberemployee" id="employee-number" placeholder="mobile number">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">email</label>
                    <input type="text" class="form-control" name="emailemployee" id="employee-email" placeholder="employee-email">
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"id="employee-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------End Edit Employee modal ----------------------------- -->
<script>
    var token = '{{Session::token()}}';
</script>
@endsection