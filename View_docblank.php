<?php
include 'connect.php';

$doc_id = $_POST["doc_id"];


    $sql_query1 = "SELECT *
    FROM document Where Doc_id = '$doc_id'";

    $result = mysqli_query($conn, $sql_query1);
    $num_row = mysqli_num_rows($result);

    if ($num_row > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <tr style="background-color:white; color:black;">
            
            <?php
                
                echo "<td>" . "<embed src='" .$row['download'] . "' type='text/html' width='600px' height='500px'>" . "</td>" ?>
                <td hidden><?=$row['document_number'];?></td>
                <td hidden><?=$row['document_name'];?></td>
                <td hidden><?=$row['document_detail'];?></td>
                <td hidden><?=$row['divistion_id'];?></td>
                <td hidden><?=$row['emp_id'];?></td>
                <td hidden><?=$row['documenttype_id'];?></td>
                <td hidden><?=$row['documentstatus_id'];?></td>
                <td hidden><?=$row['speed_send'];?></td>
            </tr>
            <td>
            <button class="btn btn-sm btn-success"style="width:10%; margin-left:10%" onclick="Onsent(<?= $row['Doc_id']; ?>)" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal5">ส่งเอกสาร</button>
            <button class="btn btn-sm btn-info"style="width:10%; margin-left:10%" onclick="Onsent2(<?= $row['Doc_id']; ?>)" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal6">เสนอสั่งการ</button>

            </td>

        <?php
        }
    } else {
        echo '<span style="color:black;">ไม่พบเอกสารที่แนบมา</span>';
    }
    mysqli_close($conn);
?>