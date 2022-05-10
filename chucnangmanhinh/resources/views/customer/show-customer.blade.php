@extends('index')
@section('content')

<?php
    $flag = 0
?>
<div class="row">
  <div class="table-agile-info">
    <?php
      $message = session()->get('message');
      if($message){
        echo $message;
        session()->put('message', null);
      }
    ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách người dùng
      </div>
      <div class="edit col-sm-4">
        <form action="{{URL::to('/timkiem-customer')}}" method="POST">
          {{ csrf_field() }}
        <div class="edit search_box pull-right">
          <input type="text" name="keyword_customer" placeholder="Search"/>
          <input type="submit" name="submit_search" value="Tìm kiếm" class="btn btn-default btn-sm"/>
        </div>
        </form>
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-4">
      </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Hành động</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
              @foreach ($all_customer as $key => $data_customer)
          <?php
              $flag++;
          ?>
            <tr>
              <td>
                  @for($i = 1; $i <= $flag; $i++)
                      <?php
                          echo $flag;
                          break;
                      ?>      
                  @endfor
              </td>
              <td>{{$data_customer->customer_name}}</td>
              <td>{{$data_customer->customer_email}}</td>
              <td>{{$data_customer->customer_phone}}</td>
              <td>{{$data_customer->customer_address}}</td>

              <td>
                <a href="{{URL::to('/take-customer/'.$data_customer->customer_id)}}">
                  <span class="edit-symbol fa fa-edit text-success text-active"></span>
                </a>
                <a href="{{URL::to('/delete-customer/'.$data_customer->customer_id)}}" 
                  onclick="return confirm('Bạn có chắc muốn xóa người dùng này ?');">
                    <span class="edit-symbol fa fa-solid fa-trash"></span>
                </a>
                <?php
                    if($data_customer->customer_status==0){
                ?>  
                    <a onclick="return confirm('Bạn có chắc muốn mở khóa người dùng này ?');" 
                      href="{{URL::to('/active-customer/'.$data_customer->customer_id)}}">
                      <span style="color: red" class="edit-symbol fa fa-solid fa-eye-slash"></span>
                    </a>
                <?php  
                    }else {
                ?>
                    <a href="{{URL::to('/unactive-customer/'.$data_customer->customer_id)}}">
                      <span class="edit-symbol fa fa-solid fa-eye"></span>
                    </a>
                <?php
                    }                               
                ?>
              </td>
            </tr>
          </tbody>
          @endforeach
        </table>
        <span style="float: right">{{$all_customer->render("pagination::bootstrap-4")}}</span>
      </div>
    </div>
  </div>
</div>
@endsection