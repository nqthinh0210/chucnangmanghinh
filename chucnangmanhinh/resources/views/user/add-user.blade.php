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

<?php
    $message = session()->get('message');
        if($message){
            echo $message;
            session()->put('message', null);
        }
?>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm người dùng
            </header>
            <div class="panel-body">
                <div class=" form">
                    <form class="cmxform form-horizontal" action="{{URL::to('/save-user')}}" method="POST">
                      {{ csrf_field() }}
                        <div class="form-group ">
                            <label for="cname" class="control-label col-lg-3">Họ và tên</label>
                            <div class="col-lg-6">
                                <input class=" form-control" name="user_name" type="text">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-3">E-Mail</label>
                            <div class="col-lg-6">
                                <input class="form-control" type="email" name="user_email">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-3">Password</label>
                            <div class="col-lg-6">
                                <input class="form-control" type="password" name="user_password">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="curl" class="control-label col-lg-3">Nhập lại Password</label>
                            <div class="col-lg-6">
                                <input class="form-control" type="password" name="user_re_password">
                            </div>
                        </div>
                        <div class="form-group ">
                          <label for="curl" class="control-label col-lg-3">Content</label>
                          <div class="col-lg-6">
                              <input class="form-control" type="text" name="user_content">
                          </div>
                      </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Selects</label>
                          <div class="col-lg-6">
                              <select name="user_status" class="form-control m-bot15">
                                  <option value="0">Ẩn</option>
                                  <option value="1">Hiện</option>
                              </select>
                          </div>
                      </div>
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-6">
                                <button class="btn btn-primary" name="user_add" type="submit">Save</button>
                                <input type="reset" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>

@endsection