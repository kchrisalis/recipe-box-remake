<?php 
include('functions.php');

$id = $_SESSION['rec-ID'];

$sql = "SELECT title, ingredients, difficulty, mealType, steps, username FROM recipes WHERE id='$id'";
$results = mysqli_query($conn, $sql);
$recipe = mysqli_fetch_assoc($results);

if(isset($_POST['faves'])) {
    if (empty($EmptyTestArray)) {
        // prevents an 'empty product'
        $faveRec = $id;
    } else {
        array_push($faveRec, $id);
        $faveRec = join(',', $faveRec);
    }

    $sql = "UPDATE users SET faves = '$faveRec' WHERE username = '$user'";

    if (mysqli_query($conn, $sql)) {
        // success;
        header('Location: recipe-card.php');
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Recipe Box</title>
</head>

<?php include('header.php'); ?>
<div class="forms">
	<h1><?php echo $recipe['title']?></h1>
    <h4>Username</h4><p><?php echo $recipe['username']?></p>
    <h3>Difficulty</h3><p><?php echo $recipe['difficulty']?></p>
    <h3>Meal Type</h3><p><?php echo $recipe['mealType']?></p>
    <h3>Ingredients</h3>
    <ul>
					<?php $ingredients = explodeContent("\n", $recipe['ingredients']);
					foreach ($ingredients as $ingredient) : ?>
						<li><?php echo $ingredient ?></li>
					<?php endforeach; ?>
				</ul>
    <h3>Steps</h3>
    <ol>
					<?php $steps = explodeContent("\n", $recipe['steps']);
					foreach ($steps as $step) : ?>
						<li><?php echo $step ?></li>
					<?php endforeach; ?>
				</ol>

                <?php for($m = 0; $m < count($faveRec); $m++):
                        if ($faveRec[$m] == $id) :
                            $inFaves = true;
                            break;
                        else: 
                            $inFaves = false;
                        endif;
                    endfor;

                    if($recipe['username'] != $_SESSION['userID']):
                if ($_SESSION['userID'] != 'Admin' && $_SESSION['userID'] && $inFaves == true): ?>
                <h3>Already In Favourites</h3>
                <?php else:?>
                <form action="recipe-card.php" method="POST">
                <input type="submit" class="submitbtn btn brand z-depth-0" value="Add To Favourites" name="faves">
                </form>
                <?php 
            endif; endif; ?>
            </div>
<?php include('footer.php'); ?>


</html>