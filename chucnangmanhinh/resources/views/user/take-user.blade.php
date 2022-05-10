@extends('index')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@foreach($data as $key => $data_edit)
<form action="{{URL::to('/edit-user/'.$data_edit->user_id)}}" method="POST">
  {{ csrf_field() }}
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email User</label>
    <input type="email" class="form-control" name="user_email" value="{{$data_edit->user_email}}">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name User</label>
    <input type="text" class="form-control" name="user_name" value="{{$data_edit->user_name}}">
  </div>
  <input class="btn btn-primary" name="update_user" type="submit" value="cập nhật">
  <input type="reset" class="btn btn-defaul" value="Cancel">
</form>
@endforeach
@endsection