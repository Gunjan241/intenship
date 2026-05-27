<?php

include '../../includes/auth.php';
include '../../includes/db.php';

$message = "";

$employees = $conn->query("SELECT * FROM employees");

if(isset($_POST['upload'])){

    $employee_id = $_POST['employee_id'];

    $document_name = $_POST['document_name'];

    $file = $_FILES['document']['name'];

    $tmp = $_FILES['document']['tmp_name'];

    $newfile = uniqid() . $file;

    $allowed = ['pdf','doc','docx'];

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if(in_array($ext,$allowed)){

        move_uploaded_file(
            $tmp,
            "../../uploads/documents/" . $newfile
        );

        $stmt = $conn->prepare("INSERT INTO employee_documents(
            employee_id,
            document_name,
            file_path
        ) VALUES(?,?,?)");

        $stmt->bind_param(
            "iss",
            $employee_id,
            $document_name,
            $newfile
        );

        if($stmt->execute()){

            $message = "Document Uploaded Successfully";

        }else{

            $message = "Upload Failed";

        }

    }else{

        $message = "Only PDF, DOC, DOCX Allowed";

    }
}

include '../../includes/header.php';

?>

<style>

body{
    background:#f4f6f9;
}

.upload-card{
    border:none;
    border-radius:15px;
}

</style>

<div class="container-fluid mt-4">

<div class="card shadow upload-card">

<div class="card-body">

<h2 class="mb-4">
Upload Employee Document
</h2>

<?php if($message!=""){ ?>

<div class="alert alert-info">
<?= $message ?>
</div>

<?php } ?>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">

<label>Select Employee</label>

<select name="employee_id" class="form-control" required>

<option value="">Choose Employee</option>

<?php while($emp = $employees->fetch_assoc()){ ?>

<option value="<?= $emp['id']; ?>">

<?= $emp['fullname']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Document Name</label>

<input type="text"
name="document_name"
class="form-control"
placeholder="Resume / Aadhaar / Offer Letter"
required>

</div>

<div class="col-md-6 mb-3">

<label>Upload Document</label>

<input type="file"
name="document"
class="form-control"
required>

</div>

</div>

<button class="btn btn-primary" name="upload">
Upload Document
</button>

<a href="../dashboard.php" class="btn btn-dark">
Dashboard
</a>

</form>

</div>

</div>

</div>

<?php include '../../includes/footer.php'; ?>