<?php
include "connect2.php";

date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เอกสารนำเข้า</title>

  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#dtable').dataTable({
        "aLengthMenu": [
          [5, 10, 15, 25, 50, 100, -1],
          [5, 10, 15, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 10

      });
    })
  </script>
  <style type="text/css">
    select[multiple],
    select[size] {
      height: auto;
      width: 20px;
    }

    * {
      font-family: 'supermarket';
    }

    body {
      background-image: url('img/wall.jpg');
      background-repeat: no-repeat;
      background-position: center center;
      background-attachment: fixed;
      background-size: 100% 100%, auto;
    }

    .pull-right {
      float: right;
      margin: 2px !important;
    }


    #loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('img/lg.flip-book-loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
      opacity: 1;
    }

    /*   #dtable{
 display: block;

  overflow-x: scroll;
  width: 600px;
    }*/
  </style>

  <script>
    $(window).on('load', function() {
      //you remove this timeout
      setTimeout(function() {
        $('#loader').fadeOut('slow');
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
    });
  </script>

</head>

<body style="padding:0px; margin:0px; background-color:#fff;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">
  <?php
  include "connect.php";

  if (!isset($_SESSION['emp_id'])) {
    header('Location: login_admin.php');
  }

  $emp_id = $_SESSION['emp_id'];
  $emp_firstname = $_SESSION['emp_firstname'];
  $Position_name = $_SESSION['Position_name'];

  date_default_timezone_set("Asia/Bangkok");

  ?>
  <!-- Start your project here-->
  <!--Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mx-auto" style="width:200%">
    <a class="navbar-brand" href="index_admin.php">
      <font color="#F0B56F">D</font>ocument <font color="#F0B56F"></font>Management <font color="#F0B56F">S</font>ystem
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <label style="color:#FFFFFF83">ชื่อผู้ใช้ : <?php echo $emp_firstname ?> &nbsp</label>
            <label style="color:#FFFFFF83">สถานะ : <?php echo $Position_name ?> &nbsp</label>
            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
              <a class="dropdown-item" href="history_log.php"> <i class="fas fa-chalkboard-teacher"></i> User Logged</a>
              <a class="dropdown-item" href="login_user.php"><i class="fas fa-sign-in-alt"></i> LogOut</a>

            </div>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <Br><br>
  <!-- Card -->
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <center>
          <h2>เอกสารนำเข้า</h2>
        </center>

        <!--/.Navbar -->
        <br><Br><br>
        <!-- Card -->
        <div class="container contact">
          <div class="row">
            <div class="col-md-10">
              <hr>
              <table id="dtable" class="table table-striped" style="width:150%">
                <thead>
                  <th style="color:#fff; font-size:23px">เลขที่เอกสาร</th>
                  <th style="color:#fff;font-size:23px">เรื่อง</th>
                  <th style="color:#fff;font-size:23px">วันที่นำเข้าเอกสาร</th>
                  <th style="color:#fff;font-size:23px">วันหมดอายุเอกสาร</th>
                  <th style="color:#fff;font-size:23px">ประเภทเอกสาร</th>
                  <th style="color:#fff;font-size:23px">การจัดการ</th>
                  <th style="color:#fff;font-size:23px">ดาวน์โหลด</th>
                </thead>
                <tbody id="Input_doc" style=" width:100%; height:100%">
                  <?php
                  $search1 = date("Y/m/d");

                  $sql_query = "SELECT a.Doc_id,a.document_number,a.document_name,a.document_date,b.documenttype_name,a.download,a.documentstatus_id,a.document_dnow
            FROM document a , documenttype b
            Where a.documenttype_id = b.documenttype_id and a.documentstatus_id = '6'
            ORDER BY `document_date` DESC";

                  $result = mysqli_query($conn, $sql_query);
                  $num_row = mysqli_num_rows($result);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr style="background-color:white; color:black;">
                        <td style="color:black; font-size:23px"><?= $row['document_number']; ?></a></td>
                        <td style="color:black; font-size:23px"><?= $row['document_name']; ?></a></td>
                        <td style="color:black; font-size:23px"><?= $row['document_dnow']; ?></a></td>
                        <td style="color:black; font-size:23px"><?= $row['document_date']; ?></a></td>
                        <td style="color:black; font-size:23px"><?= $row['documenttype_name']; ?></a></td>
                        <td style="width:20%;">
                          <button class="btn btn-success" onclick="Onsent(<?= $row['Doc_id']; ?>)" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal5">ส่ง</button>
                          <button onclick="OnDelete4(<?= $row['Doc_id']; ?>)" type="button" class="btn btn-danger">ลบ</button>
                        </td>
                        <td <?= $row['download']; ?>class="alert-success"><a href='download.php?filename=<?= $row['download']; ?>'><img src="img/download.png" width="60px" height="60px" title="Download File"></a> </td>
                      </tr>

                  <?php
                    }
                  } else {
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>

          <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="exampleModalLabel">หน้าการส่ง</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="text" class="form-control" name="Doc_id" id="Doc_id" hidden>
                        <input type="text" class="form-control" name="document_number" id="document_number" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <?php
                        $sql = "SELECT * from divistion";

                        $result = mysqli_query($conn, $sql);
                        ?>
                        <select name="divistion_id" id="divistion_id" class="form-select" style="text-align: center; width: 70%; ">
                          <option value="กอง">กอง</option>
                          <?php
                          while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                            <option value="<?php echo $row["divistion_id"] ?>"><?php echo $row["divistion_name"] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">

                        <select name="emid" id="emid" class="form-select" style="text-align: center; width: 70%;" aria-label="Default select example">
                          <option value="" selected disabled>กรุณาเลือกชื่อกอง</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="clear_modal5">ปิด</button>
                  <button type="button" class="btn btn-success" id="butupdatedoc">ยืนยัน</button>
                </div>
              </div>
            </div>
          </div>

          </script>




          <script>
            function OnDelete4(id) {
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

                    url: "delete_inputDoc.php",
                    type: 'post',
                    data: {
                      Doc_id: id
                    },
                    success: function(dataResult) {
                      var dataResult = JSON.parse(dataResult);
                      if (dataResult.statusCode == 200) {
                        swalWithBootstrapButtons.fire(
                          'ลบข้อมูลสำเร็จ',
                          '',
                          'success'

                        )
                        header("Refresh:1; url=add_document.php");
                      } else {
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

            function Onsent(id) {
              $.ajax({
                url: "Select_Doc.php",
                type: 'post',
                data: {
                  Doc_id: id
                },
                success: function(dataResult) {
                  var dataResult = JSON.parse(dataResult);
                  if (dataResult.statusCode == 200) {

                    $("#Doc_id").val(dataResult.Doc_id);
                    $("#document_number").val(dataResult.document_number);

                  }
                }
              });
            }
          </script>
          <script>
            $(document).ready(function() {

              $('#divistion_id').change(function() {
                var divistion_id = $(this).val();

                $.ajax({
                  type: "post",
                  url: "SelectDivistion.php",
                  data: {
                    id: divistion_id,
                    function: 'divistion_id'
                  },
                  success: function(data) {
                    $('#emid').html(data);
                  }
                });
              });


              function OnDelete3(id) {
                //  alert(id);
                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                  },
                  buttonsStyling: false
                })
              }
              $("#butupdatedoc").on('click', function() {

                var divistion_id = $("#divistion_id").val();
                var emid = $("#emid").val();
                var Doc_id = $("#Doc_id").val();

                if (divistion_id != "" && emid != "") {
                  $.ajax({
                    url: "save_sentdoc.php",
                    type: "POST",
                    data: {
                      divistion_id: divistion_id,
                      emid: emid,
                      Doc_id: Doc_id
                    },
                    cache: false,
                    success: function(dataResult) {
                      var dataResult = JSON.parse(dataResult);
                      if (dataResult.statusCode == 200) {
                        Swal.fire({
                          icon: 'success',
                          title: 'ส่งข้อความสำเร็จ',

                        })
                        $('#exampleModal5').modal('hide');
                        AutoRefresh();
                      } else if (dataResult.statusCode == 201) {
                        Swal.fire({
                          icon: 'error',
                          title: 'ส่งข้อความไม่สำเร็จ',
                        })
                      }

                    }
                  });
                } else {
                  Swal.fire('กรุณากรอกข้อมูลให้ครบ');
                }

              });
            });

            function AutoRefresh() {
              setTimeout("location.reload(true);", 1000);

            }
          </script>
</body>

</html>