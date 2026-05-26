<?php

require_once "Book.php";

session_start();

if(!isset($_SESSION['books'])) {

    $_SESSION['books'] = [

        new Book("Clean Code", "Robert Martin", "1001"),
        new Book("PHP Basics", "Rasmus", "1002"),
        new Book("JavaScript Guide", "John Doe", "1003"),
        new Book("Python Master", "Alex", "1004"),
        new Book("Database System", "Smith", "1005")
    ];
}

$message = "";

if(isset($_POST['action']) && isset($_POST['index'])) {

    $index = $_POST['index'];

    $book = $_SESSION['books'][$index];

    if($_POST['action'] == "borrow") {

        $message = $book->borrowBook()
        ? "📕 Book Borrowed Successfully"
        : "❌ Book Already Borrowed";
    }

    if($_POST['action'] == "return") {

        $message = $book->returnBook()
        ? "📗 Book Returned Successfully"
        : "❌ Book Already Available";
    }

    $_SESSION['books'][$index] = $book;
}

$books = $_SESSION['books'];

?>

<!DOCTYPE html>
<html>
<head>

    <title>Library Management System</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial;
            background:#eef2ff;
            padding:40px;
        }

        .big-message{

            width:80%;
            margin:20px auto;
            background:#dcfce7;
            color:#166534;
            padding:20px;
            text-align:center;
            font-size:32px;
            font-weight:bold;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);

        }

        .container{
            max-width:1000px;
            margin:auto;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        h1{
            text-align:center;
            margin-bottom:20px;
            color:#1e3a8a;
            font-size:38px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#1e3a8a;
            color:white;
            padding:14px;
            font-size:18px;
        }

        td{
            border:1px solid #ddd;
            padding:12px;
            text-align:center;
            font-size:17px;
        }

        .available{
            color:green;
            font-weight:bold;
            font-size:18px;
        }

        .borrowed{
            color:red;
            font-weight:bold;
            font-size:18px;
        }

        button{
            padding:10px 18px;
            border:none;
            border-radius:6px;
            color:white;
            cursor:pointer;
            transition:0.3s;
            font-size:15px;
            font-weight:bold;
        }

        .borrow-btn{
            background:#2563eb;
        }

        .borrow-btn:hover{
            background:#1d4ed8;
            transform:scale(1.05);
        }

        .return-btn{
            background:#16a34a;
        }

        .return-btn:hover{
            background:#15803d;
            transform:scale(1.05);
        }

        tr:hover{
            background:#f8fafc;
            transition:0.3s;
        }

        .reset{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:red;
            font-weight:bold;
            font-size:18px;
        }

        .reset:hover{
            text-decoration:underline;
        }

    </style>

</head>

<body>

<?php if($message){ ?>

<div class="big-message">
    <?php echo $message; ?>
</div>

<?php } ?>

<div class="container">

    <h1>📚 Library Management System</h1>

    <table>

        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php foreach($books as $index => $book){ ?>

        <tr>

            <td><?php echo $index + 1; ?></td>

            <td><?php echo $book->getTitle(); ?></td>

            <td><?php echo $book->getAuthor(); ?></td>

            <td><?php echo $book->getIsbn(); ?></td>

            <td class="<?php echo $book->isAvailable() ? 'available' : 'borrowed'; ?>">

                <?php echo $book->getStatus(); ?>

            </td>

            <td>

                <form method="POST">

                    <input type="hidden" name="index" value="<?php echo $index; ?>">

                    <?php if($book->isAvailable()){ ?>

                        <input type="hidden" name="action" value="borrow">

                        <button class="borrow-btn" type="submit">
                            Borrow
                        </button>

                    <?php } else { ?>

                        <input type="hidden" name="action" value="return">

                        <button class="return-btn" type="submit">
                            Return
                        </button>

                    <?php } ?>

                </form>

            </td>

        </tr>

        <?php } ?>

    </table>

    <a class="reset" href="reset.php">
        Reset Library
    </a>

</div>

</body>
</html>