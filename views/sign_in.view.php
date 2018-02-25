<?php require 'blocks/header.php';

?>

<div class="container">
    <div class="col-md-6 col-sm-12 col-xs-12 offset-lg-5">
        <h2>Sign In</h2>
        <?php if(isset($message)):?>
            <div class="alert alert-danger">
                <?=$message?>
            </div>
        <?php endif;?>
        <form action="/login" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info" style="margin-top: 10px;" id="create_btn">Login</button>
        </form>
    </div>
</div>

<?php require 'blocks/footer.php'; ?>
