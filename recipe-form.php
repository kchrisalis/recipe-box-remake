<?php

include('functions.php');
$errors = ['title' => "", 'ingredients' => "", 'time' => "", 'difficulty' => "", 'type' => "", 'steps' => ""];


if (isset($_POST['submit'])) {
    // validation of fields (if empty)
    if (empty($_POST['title'])) {
        $errors['title'] = 'Enter a recipe title';
    } else {
        $title = mysqli_escape_string($conn, $_POST['title']);
    }

    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'List at least one ingredient';
    } else {
        $ingredients = mysqli_escape_string($conn, $_POST['ingredients']);
    }

    if (empty($_POST['difficulty'])) {
        $errors['difficulty'] = 'Choose a difficulty';
    } else {
        $difficulty = mysqli_escape_string($conn, $_POST['difficulty']);
    }

    if (empty($_POST['type'])) {
        $errors['type'] = 'Choose a meal type';
    } else {
        $type = mysqli_escape_string($conn, $_POST['type']);
    }

    if (empty($_POST['steps'])) {
        $errors['steps'] = 'Enter at least one step';
    } else {
        $steps = mysqli_escape_string($conn, $_POST['steps']);
    }

    if (array_filter($errors)) {
    } else {
        $username = mysqli_escape_string($conn, $_SESSION['userID']);

        // sql query
        $sql = "INSERT INTO recipes(username, title, ingredients, difficulty, mealType, steps) VALUES ('$username', '$title','$ingredients', '$difficulty', '$type', '$steps')";

        if (mysqli_query($conn, $sql)) {
            // success
            header('location: index.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Recipe Box</title>
</head>

<?php include('header.php'); ?>

<form class="border forms" action="recipe-form.php" method="POST">
    <h1>Add Recipe</h1>
    <div class="mb-3">
        <label for="title">
            <h4>Recipe Title</h4>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <p><?php echo $errors['title'] ?></p>
        </label>
    </div>

    <div class="mb-3">
        <label for="difficulty">
            <h4>Difficulty</h4>
            <select name="difficulty" id="">
                <option value=""></option>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>
            <p><?php echo $errors['difficulty'] ?></p>
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
            <p><?php echo $errors['type'] ?></p>
        </label>
    </div>
    <div class="mb-3">
        <label for="ingredients">
            <h4>Ingredients</h4>
            <textarea name="ingredients" id="" cols="50" rows="10"><?php echo htmlspecialchars($ingredients) ?></textarea>
            <p><?php echo $errors['ingredients'] ?></p>
        </label>
    </div>
    <div class="mb-3">
        <label for="steps">
            <h4>Steps</h4>
            <textarea name="steps" id="" cols="50" rows="10"><?php echo htmlspecialchars($steps) ?></textarea>
            <p><?php echo $errors['steps'] ?></p>
        </label>
    </div>

    <input type="submit" class="submitbtn btn brand z-depth-0" name='submit' value="Submit">
</form>
<?php include('footer.php'); ?>


</html>