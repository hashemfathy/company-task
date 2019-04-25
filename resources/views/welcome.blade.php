@extends('layout.master')

@section('title')
  Admin Panel
@endsection

@section('content')
<!-- ----------------------------------Start alert fault-------------------------------- -->
  @if(count($errors)>0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
        <p>{{ $error}} </p>
      @endforeach
    </div>
  @endif
<!-- ----------------------------------End alert fault-------------------------------- -->

<!-- ----------------------------------Start Add department form-------------------------------- -->
<form action="{{route('create')}}"method="post">
  <div class="form-group">
    <label ><h2>Add department</h2></label>
    <input name="name" id="name" class="form-control" placeholder="type name of department!"/>
  </div>
  <button type="submit"class="btn btn-primary">Add</button>
  <div class="dropdown-divider"></div>
  {{csrf_field()}}
</form>
<!-- ----------------------------------End Add department form-------------------------------- -->
<!-- ----------------------------------Start departments show-------------------------------- -->
@foreach($departments as $department)
<div class="btn-group w-100" data-departmentid="{{ $department->id }}">
  <a href="{{route('get.employees',[$department->id])}}"type="button"class="btn btn-warning  w-100 p-2">{{$department->name}}</a>
  <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item edit" href="#">Edit</a>
    <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{route('department.delete',['department_id'=> $department->id ])}}">delete</a>
  </div>
</div>
<div class="dropdown-divider"></div>
@endforeach
<!-- ----------------------------------End departments show-------------------------------- -->
<!-- --------------------------------Start Edit department modal ------------------------- -->
<div class="modal" tabindex="-1" role="dialog" id='editmodal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editform" method="POST">
        <div class="form-group">
          <input name="departmentname" id="department-name" class="form-control" placeholder="edit department name!"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"id="modal-save">Save changes</button>
        </div>
        @csrf
      </form>
    </div>
  </div>
</div>
<!-- --------------------------------End Edit department modal ------------------------- -->

<script>
  var token = '{{Session::token()}}';
  var urlEdit = '{{ route ('edit')}}';
</script>
@endsection
