<?php
include "connect.php";

// Check user login or not
if(!isset($_SESSION['emp_id'])){
   header('Location: login_admin.php');
}

$emp_id = $_SESSION['emp_id'];
$emp_firstname = $_SESSION['emp_firstname'];
$Position_name = $_SESSION['Position_name'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="img/login2.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ข้อมูลการจอง</title>

  <style>
    * {
      font-family: 'supermarket';
    }

    body {
      background-image: url('img/background.jpg');
      background-repeat: no-repeat;
      background-position: center center;
      background-attachment: fixed;
      background-size: 100% 100%, auto;
    }

    #show_employee {
      display: none;
    }

    #show_index {
      display: block;
    }

    #show_divistion {
      display: none;
    }

    #show_manual {
      display: none;
    }

    #show_history {
      display: none;
    }
    
    th.thcenter {
      text-align: center;
    }

    #modal {
      background: rgba(0, 0, 0, 0.7);
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      z-index: 100;
      display: none;
    }

    .bgLeft {
      background: rgba(0, 0, 0, 0.5);
    }

    .glow-on-hover {
      width: 300px;
      height: 50px;
      border: none;
      outline: none;
      color: #fff;
      background: #111;
      cursor: pointer;
      position: relative;
      z-index: 0;
      border-radius: 50px;
    }

    .glow-on-hover:before {
      content: '';
      background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
      position: absolute;
      top: -2px;
      left: -2px;
      background-size: 400%;
      z-index: -1;
      filter: blur(5px);
      width: calc(100% + 4px);
      height: calc(100% + 4px);
      animation: glowing 20s linear infinite;
      opacity: 0;
      transition: opacity .3s ease-in-out;
      border-radius: 10px;
    }

    .glow-on-hover:active {
      color: #000
    }

    .glow-on-hover:active:after {
      background: transparent;
    }

    .glow-on-hover:hover:before {
      opacity: 1;
    }

    .glow-on-hover:after {
      z-index: -1;
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background: #111;
      left: 0;
      top: 0;
      border-radius: 10px;
    }

    @keyframes glowing {
      0% {
        background-position: 0 0;
      }

      50% {
        background-position: 400% 0;
      }

      100% {
        background-position: 0 0;
      }
    }
  </style>
  <title>Admin</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mx-auto" style="width:100%">
          <div class="container-fluid">
            <div class="col-md-6">
              <a class="navbar-brand" href="index_admin.php"><img src="img/icon.png" width="5%">
              สำนักงานเทศบาลเมืองปัตตานี
              </a>
            </div>
           
                      
                        
                  
            <div class="col-md-6" style="text-align:right;">
            <label style="color:#FFFFFF83">ชื่อผู้ใช้ : <?php echo $emp_firstname ?> &nbsp</label>
            <label style="color:#FFFFFF83">สถานะ : <?php echo $Position_name ?> &nbsp</label>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div class="container mx-auto" style="width:100%">
      <div class="row">
        <div class="col-2 bgLeft" style="height:150vh"><br>
        <button class="btn btn-secondary btn-sm" style="width:100%; margin-bottom:3%;"
        onclick="show_index()">หน้าแรก</button>
        <div class="dropdown">
          <button class="btn btn-secondary btn-sm dropdown-toggle" style="width:100%; margin-bottom:3%;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
           การจัดการเอกสาร
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" >นำเข้าเอกสาร</a></li>
            <li><a class="dropdown-item" href="#">ส่งออกเอกสาร</a></li>
            <li><a class="dropdown-item" href="form.php">เอกสารนำเข้า</a></li>
          </ul>
        </div>
        <div class="dropdown">
          <button class="btn btn-secondary btn-sm dropdown-toggle" style="width:100%; margin-bottom:3%;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
           การจัดการข้อมูล
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item"onclick="show_divistion()" >การจัดการกอง</a></li>
            <li><a class="dropdown-item" onclick="show_employee()">การจัดการสมาชิก</a></li>
            <li><a class="dropdown-item" onclick="show_history()">สถิติการรับ-ส่งเอกสาร</a></li>
          </ul>
        </div>
          <button class="btn btn-secondary btn-sm" style="width:100%; margin-bottom:3%;"
            onclick="show_manual()">คู่มือ</button>
           <button class="btn btn-danger btn-sm" style="width:100%; margin-bottom:3%;">
            <a class="nav-link" href="logout.php?option=1" style = "color:black">ออกจากระบบ</a></button> 
            
          <!-- Button trigger modal -->

          <!-- modal edit Divistion -->
          <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลกอง</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="emp_id">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="divistion_name" id="divistion_name"
                          placeholder="ชื่อสนาม">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                      <input type="number" class="form-control" name="divistion_number" id="divistion_number"
                          placeholder="เบอร์โทรศัพท์มือถือกอง">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="clear_modal4">ปิด</button>
                  <button type="button" class="btn btn-success" id="save_edit_divistion" >ยืนยัน</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Add Divistion -->
          <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="exampleModalLabel">เพิ่มกอง</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="divistion_name" id="divistion_name2"
                          placeholder="ชื่อกอง">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                      <input type="number" class="form-control" name="divistion_number" id="divistion_number2"
                          placeholder="เบอร์โทรศัพท์มือถือกอง">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="clear_modal5">ปิด</button>
                  <button type="button" class="btn btn-success" id="butsave_divistion" >ยืนยัน</button>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-10" style="background-color:white">
          <div id="show_index"><br>
            <center>
              <h2>ประชาสัมพันธ์</h2>
              <div class="mb-3">
              <input id="board_name" type='file'  accept="image/png, image/jpeg">
            <input type="hidden" id="b64">
            <img id="img" height="120">
                        
                      </div>
              <button type="button" class="btn btn-success" id="botsave_file" >อัพโหลด</button>
            </center>
           
            <div class="table-responsive-sm">
              <table class="table table-bordered table-sm" style="border:1px; width:100%">
                <thead>
                  <tr style="background-color:#212529; color:white;">
                    <th class="thcenter">รูป</th>
                    <th class="thcenter">การจัดการ</th>
                    
                  </tr>
                </thead>
                <tbody id="pacha" style="border:1px; width:100%">
                  
                  <?php                 
                    $sql_query = "SELECT board_name , board_id
                    FROM board
                    ORDER BY `board_id` ASC";

                    $result = mysqli_query($conn,$sql_query);
                    $num_row = mysqli_num_rows($result);

                    while($row = $result->fetch_assoc()) {
                  ?>	
                      <tr >
                          
                          <?php
                      echo "<td>"."<img src='".$row['board_name']."' width='10%'>"."</td>"?>
                      <td style="width:10%;">
                      <button onclick="OnEdit3(<?=$row['board_id'];?>)" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4">แก้ไข</button>
			                <button onclick="OnDelete3(<?=$row['board_id'];?>)" type="button" class="btn btn-sm btn-danger">ลบ</button>
		                	</td>
                      </tr>
                      
                          </tr>
                      
                    <?php	
                    }                            
                    ?>
                </tbody>
                <tbody id="myTable5" style="border:1px; width:100%">

                </tbody>
              </table>
            </div>
          </div>
          
          <div id="show_history"><br>
            <center>
              <h2>สถิติการส่งเอกสาร</h2>
            </center>

            <div style="float:right">
            วัน/เดือน/ปี : <input id="myInput4" type="date"><br><br>
            </div>

            <div class="table-responsive-sm">
              <table class="table table-bordered table-sm" style="border:1px; width:100%">
                <thead>
                  <tr style="background-color:#212529; color:white;">
                    <th class="thcenter">วันที่ดำเนินการ</th>
                    <th class="thcenter">ชื่อเอกสาร</th>
                    <th class="thcenter">ประเภทเอกสาร</th>
                    <th class="thcenter">ชั้นความเร็วเอกสาร</th>
                    <th class="thcenter">ชั้นความลับเอกสาร</th>
                  </tr>
                </thead>
                <tbody id="myTable4" style="border:1px; width:100%">

                </tbody>
              </table>
            </div>
          </div>

          <div id="show_manual"><br>
            <center>
              <h2>คู่มือ</h2> 
            </center>

            <div class="table-responsive-sm">
              <img src="img/11.jpg" alt="">
            </div>
          </div>

          <div id="show_divistion"><br>
            <center>
              <h2>ข้อมูลกอง</h2>
            </center>

            <div style="float:right">
            ค้นหา : <input id="myInput2" type="text"><br><br>
            </div>

            <div class="table-responsive-sm">
              <table class="table table-bordered table-sm" style="border:1px; width:100%">
                <thead>
                  <tr style="background-color:#212529; color:white;">
                    <th class="thcenter">ชื่อกอง</th>
                    <th class="thcenter">เบอร์โทรศัพท์กอง</th>
                    <th class="thcenter">แก้ไข/ลบ</th>
                  </tr>
                </thead>
                <tbody id="myTable2" style="border:1px; width:100%">

                </tbody>
              </table>
              <button class="glow-on-hover" style="width:10%; height:35px;" type="button" data-bs-toggle="modal"
                data-bs-target="#exampleModal5">เพิ่มกอง</button>
            </div>
          </div>
  
          <div id="show_employee"><br>
            <center>
              <h2>ข้อมูลสมาชิก</h2>
            </center>

            <div style="float:right">
            ค้นหา : <input id="myInput" type="text"><br><br>
            </div>

            <div class="table-responsive-sm">
              <table class="table table-bordered table-sm" style="border:1px; width:100%">
                <thead>
                  <tr style="background-color:#212529; color:white;">
                  
                    <th class="thcenter">ชื่อจริง</th>
                    <th class="thcenter">นามสกุล</th>
                    <th class="thcenter">เลขบัตรประชาชน</th>
                    <th class="thcenter">เพศ</th>
                    <th class="thcenter">สถานะ</th>
                    <th class="thcenter">กอง</th>
                    <th class="thcenter">อีเมลล์</th>
                    <th class="thcenter">เบอร์โทรศัพท์</th>
                    <th class="thcenter">แก้ไข/ลบ</th>                
                  </tr>
                </thead>
                <tbody id="myTable" style="border:1px; width:100%">
                </tbody>
              </table>
                <button class="glow-on-hover" style="width:10%; height:35px;" type="button" data-bs-toggle="modal"
                  data-bs-target="#exampleModal2">เพิ่มสมาชิก</button>
                  <div class="mb-3">
            </div>
          </div>                 
            <!-- Modal Edit Member-->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลสมาชิกของ</h5>
                  <input type="text"class="form-control" id="show_username" style="width:50%; margin-left:10px" readonly></input>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="emp_id">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="emp_firstname" id="emp_firstname"
                          placeholder="ชื่อจริง">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="emp_lastname" id="emp_lastname"
                          placeholder="นามสกุล">
                      </div>
                    </div>
                  <div class="col-md-6">
                      <div class="mb-3">
                        <input type="password" class="form-control" name="emp_password" id="emp_password"
                          placeholder="รหัสผ่าน">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="number" class="form-control" name="emp_cardid" id="emp_cardid"
                          placeholder="เลขบัตรประชาชน 13 หลัก">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                      <?php
                          $sql = "SELECT * from gender";

                          $result = mysqli_query($conn,$sql);
                        ?>
                        <select name="gender_id" id="gender_id" class="form-select">
                          <option value="เพศ">เพศ</option>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                              <option value="<?php echo $row["gender_id"]?>"><?php echo $row["gender_name"]?></option>              
                            <?php
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                      <?php
                          $sql = "SELECT * from position";

                          $result = mysqli_query($conn,$sql);
                        ?>
                        <select name="Position_id" id="Position_id" class="form-select">
                          <option value="ตำแหน่ง">ตำแหน่งงาน</option>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                              <option value="<?php echo $row["Position_id"]?>"><?php echo $row["Position_name"]?></option>              
                            <?php
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                      <?php
                          $sql = "SELECT * from divistion";

                          $result = mysqli_query($conn,$sql);
                        ?>
                        <select name="divistion_id" id="divistion_id" class="form-select">
                          <option value="กอง">กอง</option>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                              <option value="<?php echo $row["divistion_id"]?>"><?php echo $row["divistion_name"]?></option>              
                            <?php
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-7">
                      <div class="mb-3">
                        <input type="email" class="form-control" name="emp_email" id="emp_email"
                          placeholder="ที่อยู่อีเมล">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="mb-3">
                      <input type="text" class="form-control" name="emp_tel" id="emp_tel" placeholder="เบอร์โทรศัพท์" onKeyUp="if(isNaN(this.value)){ Swal.fire({ icon: 'error', title: 'กรุณากรอกตัวเลข', }); this.value='';}"  required />
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="clear_modal">ปิด</button>
                  <button type="button" class="btn btn-success" id="save_edit">บันทึก</button>
                  </div>
              </div>
            </div>
          </div>     
        </div>
      </div>
    </div>
  </div>
          <!-- modal register -->
          <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title" id="exampleModalLabel">เพิ่มสมาชิก</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="emp_firstname" id="emp_firstname2"
                          placeholder="ชื่อจริง">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="emp_lastname" id="emp_lastname2"
                          placeholder="นามสกุล">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="password" class="form-control" name="emp_password" id="emp_password2"
                          placeholder="รหัสผ่าน">
                      </div>
                    </div>
                  <div class="col-md-6">
                      <div class="mb-3">
                        <input type="number" class="form-control" name="emp_cardid" id="emp_cardid2"
                          placeholder="เลขบัตรประชาชน 13 หลัก">
                      </div>
                    </div>
                  
                    <div class="col-md-6">
                      <div class="mb-3">
                      <?php
                          $sql = "SELECT * from gender";

                          $result = mysqli_query($conn,$sql);
                        ?>
                        <select name="gender_id" id="gender_id2" class="form-select">
                          <option value="เพศ">เพศ</option>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                              <option value="<?php echo $row["gender_id"]?>"><?php echo $row["gender_name"]?></option>              
                            <?php
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                  
                  <div class="col-md-6">
                      <div class="mb-3">
                      <?php
                          $sql = "SELECT * from position";

                          $result = mysqli_query($conn,$sql);
                        ?>
                        <select name="Position_id" id="Position_id2" class="form-select">
                          <option value="ตำแหน่ง">ตำแหน่งงาน</option>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                              <option value="<?php echo $row["Position_id"]?>"><?php echo $row["Position_name"]?></option>              
                            <?php
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                      <?php
                          $sql = "SELECT * from divistion";

                          $result = mysqli_query($conn,$sql);
                        ?>
                        <select name="divistion_id" id="divistion_id2" class="form-select">
                          <option value="กอง">กอง</option>
                        <?php
                          while($row = mysqli_fetch_assoc($result)){
                        ?>
                              <option value="<?php echo $row["divistion_id"]?>"><?php echo $row["divistion_name"]?></option>              
                            <?php
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="email" class="form-control" name="emp_email" id="emp_email2"
                          placeholder="ที่อยู่อีเมล">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="mb-3">
                      <input type="text" class="form-control" name="emp_tel" id="emp_tel2" placeholder="เบอร์โทรศัพท์" onKeyUp="if(isNaN(this.value)){ Swal.fire({ icon: 'error', title: 'กรุณากรอกตัวเลข', }); this.value='';}"  required />
                      </div>
                    </div>
                  </div>
                  
                  
                  
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="clear_modal2">ปิด</button>
                  <button type="button" class="btn btn-success" id="butsave">ยืนยัน</button>
                </div>
              </div>
            </div>
          </div>     
        </div>
      </div>
    </div>
  </div>
    <input type="hidden" id="emp_id" value="<?php echo $emp_id ?>">
  <script>

    function validateEmail(m_email) {
      const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(m_email);
    }

    
    
    show_index();
    function show_index() {

$("#show_index").show();
$("#show_history").hide();
$("#show_manual").hide();
$("#show_divistion").hide();
$("#show_employee").hide();

$("#myInput5").on('change', function () {

});
}
    function show_manual() {

      $("#show_index").hide();
      $("#show_history").hide();
      $("#show_manual").show();
      $("#show_divistion").hide();
      $("#show_employee").hide();
}

    function show_history() {

      $("#show_history").show();
      $("#show_manual").hide();
      $("#show_index").hide();
      $("#show_divistion").hide();
      $("#show_employee").hide();

      $("#myInput4").on('change', function () {

      var search_date = $("#myInput4").val();

        $.ajax({
          url: ".php",
          type: "POST",
          cache: false,
          data: {
            search_date: search_date
          },
          success: function (data) {
            $('#myTable4').html(data);
          }
        });
      });
    }

    

    function show_divistion() {

      $("#show_divistion").show();
      $("#show_index").hide();
      $("#show_employee").hide();
      $("#show_manual").hide();
      $("#show_history").hide();

      $.ajax({
        url: "view_divistion.php",
        type: "POST",
        cache: false,
        success: function (data) {
          // alert(data);
          $('#myTable2').html(data);
        }
      });
    }

    function show_employee() {

      $("#show_employee").show();
      $("#show_index").hide();
      $("#show_divistion").hide();
      $("#show_manual").hide();
      $("#show_history").hide();

      $.ajax({
        url: "view_employee.php",
        type: "POST",
        cache: false,
        success: function (data) {
          // alert(data);
          $('#myTable').html(data);
        }
      });
    }

    function OnDelete(id) {
      //  alert(id);
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-2',
          cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'คุณต้องการลบข้อมูลสมาชิกนี้หรือไม่ ?',
        icon: 'question',
        // background: 'yellow',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "delete_employee.php",
            type: 'post',
            data: {
              emp_id: id
            },
            success: function (dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                swalWithBootstrapButtons.fire(
                  'ลบข้อมูลสำเร็จ',
                  '',
                  'success'
                )
                show_employee();
              }
              else{
                Swal.fire({
                  icon: 'error',
                  title: 'ไม่สามารถลบสมาชิกได้'
                })
              }
            }
          });
        }
      });
    }

    function OnEdit(id) {
      $.ajax({
        url: "select_employee.php",
        type: 'post',
        data: {
          emp_id: id
        },
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {

            $("#emp_id").val(dataResult.emp_id);
            $("#emp_firstname").val(dataResult.emp_firstname);
            $("#emp_lastname").val(dataResult.emp_lastname);
            $("#emp_password").val(dataResult.emp_password);
            $("#emp_cardid").val(dataResult.emp_cardid);
            $("#gender_id").val(dataResult.gender_id);
            $("#Position_id").val(dataResult.Position_id);
            $("#divistion_id").val(dataResult.divistion_id);
            $("#emp_tel").val(dataResult.emp_tel);
            $("#emp_email").val(dataResult.emp_email);
            $("#show_username").val(dataResult.emp_firstname);
          }
        }
      });
    }

    function OnDelete2(id) {
      //  alert(id);
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-2',
          cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'คุณต้องการลบข้อมูลกองนี้หรือไม่ ?',
        icon: 'question',
        // background: 'yellow',
        showCancelButton: true,
        cancelButtonText: 'ยกเลิก',
        confirmButtonText: 'ยืนยัน',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({

            url: "delete_divistion.php",
            type: 'post',
            data: {
              divistion_id: id
            },
            success: function (dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                swalWithBootstrapButtons.fire(
                  'ลบข้อมูลสำเร็จ',
                  '',
                  'success'
                )
                show_divistion();
              }
              else{
                Swal.fire({
                  icon: 'error',
                  title: 'ไม่สามารถลบกองได้'
                })
              }
            }
          });
        }
      });
    }

    

    function OnEdit2(id) {
      $.ajax({
        url: "select_divistion.php",
        type: 'post',
        data: {
          divistion_id: id
        },
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {

            $("#divistion_id").val(dataResult.divistion_id);
            $("#divistion_name").val(dataResult.divistion_name);
            $("#divistion_number").val(dataResult.divistion_number);
          }
        }
      });
    }

    $(document).ready(function () {
      $("#save_edit").on('click', function () {

        var emp_id = $("#emp_id").val();
        var emp_firstname = $("#emp_firstname").val();
        var emp_lastname = $("#emp_lastname").val();
        var emp_password = $("#emp_password").val();
        var emp_cardid = $("#emp_cardid").val();
        var gender_id = $("#gender_id").val();
        var Position_id = $("#Position_id").val();
        var divistion_id = $("#divistion_id").val();
        var emp_email = $("#emp_email").val();
        var emp_tel = $("#emp_tel").val();
        var show_username = $("#show_username").val();
        if ( emp_firstname != "" && emp_lastname != "" && emp_password != "" && emp_cardid != "" && gender_id != "" && Position_id != ""&& divistion_id != "" && emp_email != "" && emp_tel != "") {
          
          if (!validateEmail(emp_email)) {
            Swal.fire({
              icon: 'error',
              title: 'กรุณากรอกอีเมลให้ถูกต้อง',
            })
          }
          else{
        $.ajax({
          url: 'update_employee.php',
          method: 'post',
          datatype: 'JSON',
          data: {
                emp_id: emp_id,
                emp_firstname: emp_firstname,
                emp_lastname: emp_lastname,
                emp_password: emp_password,
                emp_cardid:emp_cardid,
                gender_id,gender_id,
                Position_id:Position_id,
                divistion_id:divistion_id,
                emp_email: emp_email,
                emp_tel: emp_tel
          },
          success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              show_employee();
              Swal.fire({
                icon: 'success',
                title: 'แก้ไขข้อมูลสำเร็จ'
              })
              $('#exampleModal').modal('hide');
              $('#exampleModal').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
            } 
            else if (dataResult.statusCode == 201) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีชื่อผู้ใช้นี้แล้ว',
                    })
                }
                else if (dataResult.statusCode == 202) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีอีเมลนี้แล้ว',
                    })
                }
                else if (dataResult.statusCode == 203) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีเบอร์โทรนี้แล้ว',
                    })
                }else if (dataResult.statusCode == 204) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีเลขบัตรประชาชนนี้อยู่แล้ว',
                    })
                }
              }
            });
          }
        }
        else {
          Swal.fire('กรุณากรอกข้อมูลให้ครบ');
        }
      });
    });

    $(document).ready(function () {
      $("#save_edit_divistion").on('click', function () {

        var divistion_id = $("#divistion_id").val();
        var divistion_name = $("#divistion_name").val();
        var divistion_number = $("#divistion_number").val();

        $.ajax({
          url: 'update_divistion.php',
          method: 'post',
          datatype: 'JSON',
          data: {
            divistion_id: divistion_id,
            divistion_name: divistion_name,
            divistion_number: divistion_number
          },
          success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              show_divistion();
              Swal.fire({
                icon: 'success',
                title: 'แก้ไขข้อมูลสำเร็จ'
              })
              $('#exampleModal4').modal('hide');
            } else if (dataResult.statusCode == 201) {
              Swal.fire({
                icon: 'error',
                title: 'แก้ไขข้อมูลไม่สำเร็จ'
              })
            }
          }
        });

      });
    });
   
    $(document).ready(function () {
      $('#butsave').on('click', function () {
        var emp_firstname = $('#emp_firstname2').val();
        var emp_lastname = $('#emp_lastname2').val();
        var emp_password = $('#emp_password2').val();
        var emp_cardid = $('#emp_cardid2').val();
        var gender_id = $('#gender_id2').val();
        var Position_id = $('#Position_id2').val();
        var divistion_id = $('#divistion_id2').val();
        var emp_email = $('#emp_email2').val();
        var emp_tel = $('#emp_tel2').val();

        if ( emp_firstname != "" && emp_lastname != "" && emp_password != "" && emp_cardid != "" && gender_id != "" && Position_id != ""&& divistion_id != "" && emp_email != "" && emp_tel != "") {
          
          if (!validateEmail(emp_email)) {
            Swal.fire({
              icon: 'error',
              title: 'กรุณากรอกอีเมลให้ถูกต้อง',
            })
          }
          else{
            $.ajax({
              url: "save_register.php",
              type: "POST",
              data: {
                emp_firstname: emp_firstname,
                emp_lastname: emp_lastname,
                emp_password: emp_password,
                emp_cardid:emp_cardid,
                gender_id,gender_id,
                Position_id:Position_id,
                divistion_id:divistion_id,
                emp_email: emp_email,
                emp_tel: emp_tel
              },
              cache: false,
              success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                  show_employee();
                  Swal.fire({
                    icon: 'success',
                    title: 'สมัครสมาชิกสำเร็จ',
                  })
                  $('#exampleModal2').modal('hide');
                  $('#exampleModal2').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
                }
                else if (dataResult.statusCode == 201) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีชื่อผู้ใช้นี้แล้ว',
                    })
                }
                else if (dataResult.statusCode == 202) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีอีเมลนี้แล้ว',
                    })
                }
                else if (dataResult.statusCode == 203) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีเบอร์โทรนี้แล้ว',
                    })
                }else if (dataResult.statusCode == 204) {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีเลขบัตรประชาชนนี้อยู่แล้ว',
                    })
                }
              }
            });
          }
        }
        else {
          Swal.fire('กรุณากรอกข้อมูลให้ครบ');
        }
      });
    });

    $(document).ready(function () {
      $('#botsave_file').on('click', function () {

        var board_name = $('#board_name').val();
        var board_name = document.getElementById("img").src;

        if (board_name != "") {
          $.ajax({
            url: "save_file.php",
            type: "POST",
            data: {
              board_name: board_name
            },
            cache: false,
            success: function (dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                show_divistion();
                Swal.fire({
                  icon: 'success',
                  title: 'เพิ่มไฟล์สำเร็จ',
                })
                show_index();
              }
              else if (dataResult.statusCode == 201) {
                Swal.fire({
                  icon: 'error',
                  title: 'ผิดพลาดลองใหม่',
                })
              }
              
            }
          });
        }
        else {
          Swal.fire('กรุณากรอกข้อมูลให้ครบ');
        }
      });
    });
    function readFile() {

var test = ''

if (this.files && this.files[0]) {

    var FR = new FileReader();

    FR.addEventListener("load", function (e) {
        document.getElementById("img").src = e.target.result;
        document.getElementById("b64").innerHTML = e.target.result;
        return e.target.result
    });

    FR.readAsDataURL(this.files[0]);
  }
}
document.getElementById("board_name").addEventListener("change", readFile);

console.log(document.getElementById("board_name"))


    $(document).ready(function () {
      $('#butsave_divistion').on('click', function () {

        var divistion_name = $('#divistion_name2').val();
        var divistion_number = $('#divistion_number2').val();

        if (divistion_name != "" && divistion_number != "") {
          $.ajax({
            url: "save_divistion.php",
            type: "POST",
            data: {
              divistion_name: divistion_name,
              divistion_number: divistion_number
            },
            cache: false,
            success: function (dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                show_divistion();
                Swal.fire({
                  icon: 'success',
                  title: 'เพิ่มกองสำเร็จ',
                })
                $('#exampleModal5').modal('hide');
              }
              else if (dataResult.statusCode == 201) {
                Swal.fire({
                  icon: 'error',
                  title: 'มีชื่อกองนี้แล้ว',
                })
              }
              $('#exampleModal5').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
            }
          });
        }
        else {
          Swal.fire('กรุณากรอกข้อมูลให้ครบ');
        }
      });
    });
    function OnEdit3(id) {
      $.ajax({
        url: "select_board.php",
        type: 'post',
        data: {
          board_id: id
        },
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {

            $("#board_id").val(dataResult.board_id);
            $("#board_name").val(dataResult.board_name);
          }
        }
      });
    }
    function OnDelete3(id) {
      //  alert(id);
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-2',
          cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'คุณต้องการลบข้อมูลนี้หรือไม่ ?',
        icon: 'question',
        // background: 'yellow',
        showCancelButton: true,
        cancelButtonText: 'ยกเลิก',
        confirmButtonText: 'ยืนยัน',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({

            url: "delete_board.php",
            type: 'post',
            data: {
              board_id: id
            },
            success: function (dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                swalWithBootstrapButtons.fire(
                  'ลบข้อมูลสำเร็จ',
                  '',
                  'success'
                  
                )
                header("Refresh:0; url=index_admin.php");
              }
              else{
                Swal.fire({
                  icon: 'error',
                  title: 'ไม่สามารถลบได้'
                })
              }
            }
          });
        }
      });
    }
    
    $(document).ready(function (){
      $('#clear_modal3').on('click', function () {
        $('#exampleModal3').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
      });
      $('#clear_modal2').on('click', function () {
        $('#exampleModal2').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
      });
      $('#clear_modal1').on('click', function () {
        $('#exampleModal1').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
      });
      $('#clear_modal4').on('click', function () {
        $('#exampleModal4').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
      });
      $('#clear_modal5').on('click', function () {
        $('#exampleModal5').find('input[type=text], input[type=password], input[type=number], input[type=tel], input[type=email], textarea').val('');
      });
    });

    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    $(document).ready(function(){
      $("#myInput2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable2 tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

    $(document).ready(function(){
      $("#myInput3").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable3 tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

  </script>
</body>

</html>