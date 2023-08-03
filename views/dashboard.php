<?php
include "../classes/User.php";

$u = new User;
$users = $u->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include "nav.php"; ?>

    <div class="container w-75 my-5">
        <h2 class="display-5">User List</h2>
        <table class="table">
            <thead class="table-secondary">
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users->fetch_assoc()) {  // データがある分、繰り返す
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td>
                        <!-- edit link/button -->
                        <a href="edit-user.php?user_id=<?= $row['id'] ?>" class="btn btn-outline-warning me-1"><i class="fa-solid fa-pen"></i></a>
                        <!-- delete button -->
                        <?php if($row['id'] != $_SESSION['user_id']) { ?> <!-- to delete trash button at login user 条件通りならformが表示される　ログインしているユーザーのゴミ箱ボタン消す-->
                        <form action="../actions/deleteUser.php" method="post" class="d-inline">
                            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>