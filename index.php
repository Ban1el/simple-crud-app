<?php
include("header.php");
include("database.php");
?>

<script>
  $(document).ready(function() {
    //Fetch the data from database to set value of forms
    $(".update_data_btn").on("click", function() {

      let row_id = $(this).attr('name');

      $.ajax({
        url: 'update_data.php',
        data: {
          action: 'test',
          row_id: row_id
        },
        type: 'post',
        success: function(output) {
          let jsonData = JSON.parse(output);

          document.getElementById('first_name_input').value = jsonData.first_name;
          document.getElementById('last_name_input').value = jsonData.last_name;
          document.getElementById('email_input').value = jsonData.email;
          document.getElementById('mobile_number_input').value = jsonData.mobile_number;
          document.getElementById('address_input').value = jsonData.address;
          document.getElementById('update_row_id').value = row_id;

          const myModal = new bootstrap.Modal('#update_modal');
          myModal.show();

        },
        error: function(xhr, status, error) {
          // Handle error response here
          var errorMessage = xhr.responseText || "An error occurred during the AJAX request.";
          console.error(errorMessage);
        }
      });

    });
  });
</script>

<div class="">
  <button class="btn btn-primary my-3">LOG-OUT</button>
  <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#add_user_modal">ADD USER</button>
</div>

<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">email</th>
      <th scope="col">mobile_number</th>
      <th scope="col">address</th>
      <th scope="col">date registered</th>
      <th scope="col">options</th>
    </tr>
  </thead>
  <tbody>

    <?php

    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
      $page_no = $_GET['page_no'];
    } else {
      $page_no = 1;
    }

    $total_records_per_page = 5;
    $page_offset = ($page_no - 1) * $total_records_per_page;

    //get the count of records
    $result_count = mysqli_query($connection, "SELECT COUNT(*) as total_records FROM simple_crud.users") or die(mysqli_error($connection));
    //total records
    $records = mysqli_fetch_array($result_count);
    //store total_records to a variable
    $total_records = $records['total_records'];
    //get total pages
    $total_no_of_pages = ceil($total_records / $total_records_per_page);

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $query = "SELECT * FROM users LIMIT $page_offset, $total_records_per_page";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    while ($row = mysqli_fetch_assoc($result)) {

    ?>

      <tr>
        <th><?php echo $row['id'] ?></th>
        <td><?php echo $row['first_name'] ?></td>
        <td><?php echo $row['last_name'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['mobile_number'] ?></td>
        <td><?php echo $row['address'] ?></td>
        <td><?php echo $row['date_reg'] ?></td>
        <td class="d-flex justify-content-center gap-2">
          <button class="btn btn-success update_data_btn" name="<?= $row['id'] ?>">UPDATE</button>
          <a class="btn btn-danger" href="./delete_data.php?row_id=<?= $row['id'] ?>">DELETE</a>
        </td>
      </tr>

    <?php
    }
    ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">

    <?php
    $page_counter = $total_records_per_page + 1;
    ?>

    <li class="page-item"><a class="page-link <?= ($page_no <= 1) ? 'disabled' : '' ?>" href="index.php?page_no=<?= $previous_page ?>">Previous</a></li>

    <?php

    for ($current_page = 1; $current_page <= $total_no_of_pages; $current_page++) { ?>

      <?php if ($page_no != $current_page) { ?>
        <li class="page-item"><a class="page-link" href="index.php?page_no=<?= $current_page ?>"><?= $current_page; ?></a></li>
      <?php } else { ?>
        <li class="page-item"><a class="page-link"><?= $current_page; ?></a></li>
      <?php } ?>

    <?php
    }
    ?>

    <li class="page-item"><a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : '' ?>" href="index.php?page_no=<?= $next_page ?>">Next</a></li>
  </ul>
</nav>


<!-- MODALS -->

<!-- Add Modal -->
<form action="./insert_data.php" method="post">
  <div class=" modal fade" id="add_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">ADD USER</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name" aria-describedby="firstNameField" name="first_name">
          </div>

          <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" aria-describedby="lastNameField" name="last_name">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailField" name="email_address">
          </div>

          <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile number</label>
            <input type="text" class="form-control" id="mobile_number" aria-describedby="mobileNumberField" name="mobile_number">
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" aria-describedby="addressField" name="address">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
          <button type="submit" class="btn btn-success" name="add_user">ADD USER</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Update Modal -->
<!-- Button trigger modal -->
<form action="./update_data.php" method="post">
  <div class="modal fade" id="update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">UPDATE RECORD</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="first_name_input" aria-describedby="firstNameField" name="first_name">
          </div>

          <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name_input" aria-describedby="lastNameField" name="last_name">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email_input" aria-describedby="emailField" name="email_address">
          </div>

          <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile number</label>
            <input type="text" class="form-control" id="mobile_number_input" aria-describedby="mobileNumberField" name="mobile_number">
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address_input" aria-describedby="addressField" name="address">
          </div>

          <input type="hidden" name="row_id" id="update_row_id">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
          <button type="submit" class="btn btn-success" name="update_record">UPDATE</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php
include("footer.php");
?>