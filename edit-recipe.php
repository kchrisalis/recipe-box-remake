<?php
include('functions.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT id, title, ingredients, difficulty, mealType, steps FROM recipes WHERE id= '$id'";
    $result = mysqli_query($conn, $sql);
    $recipe = mysqli_fetch_assoc($result);
}

if (isset($_POST['saveChanges'])) {
    if ($_SESSION['userID'] && $_SESSION['userID'] != 'Admin') {
        $id = mysqli_escape_string($conn, $_POST['id']);
        $title = mysqli_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_escape_string($conn, $_POST['ingredients']);
        $difficulty = mysqli_escape_string($conn, $_POST['difficulty']);
        $type = mysqli_escape_string($conn, $_POST['type']);
        $steps = mysqli_escape_string($conn, $_POST['steps']);
        $username = mysqli_escape_string($conn, $_SESSION['userID']);

        // sql query
        $sql = "UPDATE recipes SET title='$title', ingredients='$ingredients', difficulty='$difficulty', mealType='$type', steps='$steps', username='$username' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            // success
            header('location: user-page.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    } elseif ($_SESSION['userID'] == 'Admin') {
        $id = mysqli_escape_string($conn, $_POST['id']);
        $title = mysqli_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_escape_string($conn, $_POST['ingredients']);
        $steps = mysqli_escape_string($conn, $_POST['steps']);
        $verified = mysqli_escape_string($conn, $_POST['verified']);

        $sql = "UPDATE recipes SET title='$title', ingredients='$ingredients', steps='$steps', verified='$verified' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            // success
            header('location: admin-page.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}

if (isset($_POST['deleteRecipe'])) {
    $id = mysqli_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM recipes WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header('location: user-page.php');
    } else {
        echo 'query error: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>


<!DOCTYPE html>
<html>

<head>
    <title>Recipe Box</title>
</head>

<?php include('header.php'); ?>


<form class="border forms" action="edit-recipe.php" method="POST">

<h1>Edit Recipe</h1>
    <div class="mb-3">
        <label for="title">
            <h4>Recipe Title</h4>
            <input type="text" name="title" value="<?php echo htmlspecialchars($recipe['title']) ?>">
            <p class="text-danger"><small><?php echo $errors['title']?></small></p>
            </label>
    </div>

    <?php if ($_SESSION['userID'] && $_SESSION['userID'] != 'Admin') : ?>
        <div class="mb-3">
            <label for="difficulty">
            <h4>Difficulty</h4>
                <select name="difficulty" id="">
                    <option value=""></option>
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                </select>
                <p class="text-danger"><small><?php echo $errors['difficulty'] ?></small></p>
            </label>
        </div>

        <div class="mb-3">
            <label for="type">
            <h4>Meal Type</h4>
                <select name="type" id="">
                    <option value=""></option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Dessert">Dessert</option>
                </select>
                <p class="text-danger"><small><?php echo $errors['type'] ?></small></p>
            </label>
        </div>

    <?php elseif ($_SESSION['userID'] == 'Admin') : ?>
        <div class="mb-3">
            <label for="verified">
            <h4>Verified Recipe?</h4>
                <select name="verified" id="">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </label>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="ingredients">
        <h4>Ingredients</h4>
            <?php $ingredients = explodeContent("\n", $recipe['ingredients']) ?>
            <textarea name="ingredients" id="" cols="50" rows="10"><?php foreach ($ingredients as $ingredient) : echo $ingredient;
                                                                    endforeach; ?></textarea>
            <p class="text-danger"><small><?php echo $errors['ingredients'] ?></small></p>
        </label>
    </div>

    <div class="mb-3">
        <label for="steps">
        <h4>Steps</h4>
            <?php $steps = explodeContent("\n", $recipe['steps']); ?>
            <textarea name="steps" id="" cols="50" rows="10"><?php foreach ($steps as $step) : echo $step;
                                                                endforeach; ?></textarea>
            <p class="text-danger"><small><?php echo $errors['steps'] ?></small></p>
        </label>
    </div>

    <div class="mb-3">
    <input type="hidden" name="id" value="<?php echo $recipe['id'] ?>">
    <input type="submit" class="submitbtn btn brand z-depth-0" name='saveChanges' value="Save Changes">
    <input type="submit" class="submitbtn btn brand z-depth-0" name='deleteRecipe' value="Delete Recipe">
    <div class="mb-3"></div>
</form>
<?php include('footer.php'); ?>

</html>