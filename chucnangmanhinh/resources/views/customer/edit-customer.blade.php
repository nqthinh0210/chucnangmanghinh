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
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Sửa Thông tin Khách hàng
        </header>
<?php
            $message = session()->get('message');
            if($message){
                echo $message;
                session()->put('message', null);
            }
        ?>
@foreach($take as $key => $data_edit)
<form action="{{URL::to('/update-customer/'.$data_edit->customer_id)}}" method="POST">
  {{ csrf_field() }}
<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email Customer</label>
    <input type="email" class="form-control" name="customer_email" value="{{$data_edit->customer_email}}">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name Customer</label>
    <input type="text" class="form-control" name="customer_name" value="{{$data_edit->customer_name}}">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Phone Customer</label>
    <input type="number" class="form-control" name="customer_phone" value="{{$data_edit->customer_phone}}">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Address Customer</label>
    <input type="text" class="form-control" name="customer_address" value="{{$data_edit->customer_address}}">
  </div>
  <input class="btn btn-primary" name="customer_add" type="submit" value="cập nhật">
  <input type="reset" class="btn btn-defaul" value="Cancel">
</form>
@endforeach
@endsection