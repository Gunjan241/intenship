<?php

include '../../includes/auth.php';
include '../../includes/db.php';

$query = "SELECT employee_documents.*, employees.fullname
          FROM employee_documents
          JOIN employees
          ON employee_documents.employee_id = employees.id";

$result = $conn->query($query);

include '../../includes/header.php';

?>

<div class="container-fluid mt-4">

<h2 class="mb-4">
Employee Documents
</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered table-hover">

<tr class="table-dark">

<th>ID</th>
<th>Employee</th>
<th>Document Name</th>
<th>File</th>

</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['fullname']; ?></td>

<td><?= $row['document_name']; ?></td>

<td>

<a href="../../uploads/documents/<?= $row['file_path']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

View File

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

<?php include '../../includes/footer.php'; ?>