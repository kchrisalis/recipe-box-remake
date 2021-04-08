<?php 
include('functions.php');

$favourites = [];

for($n = 0; $n < count($faveRec); $n++) {
    $sql = "SELECT title, username, id FROM recipes WHERE id = '$faveRec[$n]'";
    $results = mysqli_query($conn, $sql);
    $m = mysqli_fetch_assoc($results);
    array_push($favourites, [
        'id' => $m['id'],
        'title' => $m['title'],
        'username' => $m['username']
    ]);
}

if (isset($_POST['remove'])) {
    $recID = mysqli_real_escape_string($conn, $_POST['rec-id']);
    // print_r($faveRec);
    for($y = 0; $y < count($faveRec); $y++) {
        if ($recID === $faveRec[$y]) {
            array_splice($faveRec, $y, 1);
        }
    }
    $faveRec = join(',', $faveRec);
    $user = $_SESSION['userID'];
    $sql = "UPDATE users SET faves ='$faveRec' WHERE username ='$user'";

    print_r($faveRec);

    if (mysqli_query($conn, $sql)) {
        // success;
        header('Location: favourites.php');
    } else {
        //error
        echo 'query error: ' . mysqli_error($conn);
    }
}

if (isset($_POST['full-rec'])) {
    $recID = mysqli_real_escape_string($conn, $_POST['rec-id']);
    $_SESSION['rec-ID'] = $recID;
    header('Location: recipe-card.php');
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Recipe Box</title>
</head>

<?php include('header.php'); ?>

    <h1 class="title">Favourites Page</h1>
        <div class="p-3 mx-1">
        <?php if($favourites): ?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Recipe Name</th>
                        <th scope="col">Created By User</th>
                        <th scope="col">View Recipe</th>
                        <th scope="col">Remove From Favourites</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($favourites as $recipe) : ?>
                        <tr>
                            <form action="favourites.php" method="POST">
                                <td><?php echo $recipe['title'] ?></td>
                                <td><?php echo $recipe['username'] ?></td>
                                <td scope="col">
					<input type="submit" class="submitbtn btn brand z-depth-0" name="full-rec" value="View Full Recipe"></td>
                                <td><input type="submit" name="remove" value="Remove " class="submitbtn btn brand z-depth-0"><input type="hidden" name="rec-id" value="<?php echo $recipe['id'] ?>"></td>
                                
                                </form> 
                                </tr>
                            <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <h2>No User Created Recipes</h2>
            <a href="index.php">Browse Recipes</a>
            <?php endif; ?>

    </div>
    <?php include('footer.php'); ?>


</html>