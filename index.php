<?php
include('functions.php');


$sql = "SELECT id, title, ingredients, difficulty, mealType, steps, username FROM recipes WHERE verified='Yes'";
$results = mysqli_query($conn, $sql);
$recipes = mysqli_fetch_all($results, MYSQLI_ASSOC);


if (isset($_POST['full-rec'])) {
	$_SESSION['rec-ID'] = $_POST['id'];
	header('location: recipe-card.php');
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Recipe Box</title>
</head>

<?php include('header.php'); ?>
	<h1 class="title">Recipe Box Homepage</h1>
	<!-- Recipe Card -->
	<div class="d-flex p-5">
		<?php foreach ($recipes as $recipe) : ?>
			<div class="mx-1 my-1 border p-3 previews" style="width: 300px;">
				<h2><?php echo $recipe['title'] ?></h2>
				<p><strong>Difficulty:</strong> <?php echo $recipe['difficulty'] ?></p>
				<p><strong>Meal Type:</strong> <?php echo $recipe['mealType'] ?></p>
				<p><strong>Username:</strong> <?php echo $recipe['username'] ?></p>


				<p>
				<form action="index.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $recipe['id'] ?>">
					<input type="submit" class="submitbtn btn brand z-depth-0" name="full-rec" value="View Full Recipe">
				</form>
				</p>

			</div>
		<?php
		endforeach; ?>
	</div>
	
	<?php include('footer.php'); ?>


</html>