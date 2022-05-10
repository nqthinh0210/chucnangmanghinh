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
          <form action="{{URL::to('/timkiem')}}" method="POST">
            {{ csrf_field() }}
          <div class="edit search_box pull-right">
            <input type="text" name="keyword_search" placeholder="Search"/>
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
                <th>Trạng thái</th>
                <th>Hành động</th>
                <th style="width:30px;"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($all_user as $key => $data_user)
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
                <td>{{$data_user->user_name}}</td>
                <td>{{$data_user->user_email}}</td>
                    <?php
                        if($data_user->user_status==0){
                    ?>
                        <td style="color: red">{{$data_user->user_content}}</td>
                    <?php  
                        }else {
                    ?>
                        <td style="color: green">{{$data_user->user_content}}</td>
                    <?php
                        }                               
                    ?>
                <td>
                  <a href="{{URL::to('/take-user/'.$data_user->user_id)}}">
                    <span class="edit-symbol fa fa-edit text-success text-active"></span>
                  </a>
                  <a href="{{URL::to('/delete-user/'.$data_user->user_id)}}" 
                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này ?');">
                      <span class="edit-symbol fa fa-solid fa-trash"></span>
                  </a>
                  <?php
                      if($data_user->user_status==0){
                  ?>  
                      <a onclick="return confirm('Bạn có chắc muốn mở khóa người dùng này ?');" 
                        href="{{URL::to('/active-user/'.$data_user->user_id)}}">
                        <span style="color: red" class="edit-symbol fa fa-solid fa-eye-slash"></span>
                      </a>
                  <?php  
                      }else {
                  ?>
                      <a href="{{URL::to('/unactive-user/'.$data_user->user_id)}}">
                        <span style="color: green" class="edit-symbol fa fa-solid fa-eye"></span>
                      </a>
                  <?php
                      }                               
                  ?>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
          <span style="float: right">{{$all_user->render("pagination::bootstrap-4")}}</span>
        </div>
      </div>
  </div>
</div>

@endsection