<?php
include('functions.php');

$username = $_SESSION['userID'];

$sql = "SELECT id, title, ingredients, difficulty, mealType, steps FROM recipes WHERE username= '$username'";
$results = mysqli_query($conn, $sql);

if (mysqli_num_rows($results) >= 1) {
    $recipes = mysqli_fetch_all($results, MYSQLI_ASSOC);
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Box</title>
</head>

<?php include('header.php'); ?>
    <h1 class="title">Welcome <?php echo $_SESSION['userID'] ?></h1>
    <?php if($recipes): ?>
    <div class="d-flex p-5">
        <?php foreach ($recipes as $recipe) : ?>
            <div class="mx-1 my-1 border p-3 previews" style="width: 300px;">
                <h2><?php echo $recipe['title'] ?></h2>
                <p>Difficulty: <?php echo $recipe['difficulty'] ?></p>
                <p>Meal Type: <?php echo $recipe['mealType'] ?></p>

                <p>Ingredients</p>
                <ul>
                    <?php $ingredients = explodeContent("\n", $recipe['ingredients']);
                    foreach ($ingredients as $ingredient) : ?>
                        <li><?php echo $ingredient ?></li>
                    <?php endforeach; ?>
                </ul>

                <p>Steps</p>
                <ol>
                    <?php $steps = explodeContent("\n", $recipe['steps']);
                    foreach ($steps as $step) : ?>
                        <li><?php echo $step ?></li>
                    <?php endforeach; ?>
                </ol>

                <p>
                <form action="user-page.php" method="POST">
                    <a href="edit-recipe.php?id=<?php echo $recipe['id'] ?>">Edit</a>
                </form>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <h2>No User Created Recipes</h2>
<?php endif; ?>
    <?php include('footer.php'); ?>

</html>