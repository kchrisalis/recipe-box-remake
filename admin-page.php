<?php
include('functions.php');

$sql = "SELECT id, title, username, verified FROM recipes";
$result = mysqli_query($conn, $sql);
$recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Box</title>
</head>

<?php include('header.php'); ?>

<h1 class="title">Admin Page</h1>
<div class="mx-1 p-4 d-flex">

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Recipe Name</th>
                <th scope="col">Created By User</th>
                <th scope="col">Verified?</th>
                <th scope="col">Edit/Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($recipes as $recipe) : ?>
                <tr>
                    <form action="admin-page.php" method="POST">

                        <td><?php echo $recipe['title'] ?></td>
                        <td><?php echo $recipe['username'] ?></td>
                        <td><?php echo $recipe['verified'] ?></td>
                        <td><a href="edit-recipe.php?id=<?php echo $recipe['id'] ?>">Edit/Delete Recipe</a></td>
                        </form? </tr>
                    <?php endforeach; ?>
        </tbody>
    </table>


</div>
<?php include('footer.php'); ?>

</html>