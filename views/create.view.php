<?php use app\models\Task;
use app\models\User;

require 'blocks/header.php';
?>


<?php

?>

<div class="container">
    <div class="col-md-6 col-sm-12 col-xs-12 offset-lg-5">
        <h2>Task</h2>
        <form method="POST" action="/create" id="create_form" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="id" value="<?=$model->id?>">
                <img alt="User Pic" src="/<?=$model->file?>" class="img-responsive m-bot" width="<?=Task::WIDTH_IMG?>"
                     height="<?=Task::HEIGHT_IMG?>" id="imgAvatar">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required
                value="<?=$model->name?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required
                       value="<?=$model->email?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="text" id="description" rows="5" required form="create_form"
                          class="form-control" placeholder="Enter description" required><?=$model->text?></textarea>
            </div>

            <?php if(User::isActiveAdmin()):?>
            <div class="form-check">
                <input type="checkbox" name="status" class="form-check-input" id="Status"
                <?= $model->status? 'checked' : ''?>>
                <label class="form-check-label" for="Status">Active</label>
            </div>
            <?php endif;?>
            <?php if(!empty($model->id)):?>
                <button type="submit" class="btn btn-primary m-top" id="create_btn">Update task</button>
            <?php else: ?>
                <button type="submit" class="btn btn-success m-top" id="create_btn">Create task</button>
            <?php endif; ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info m-top" data-toggle="modal" data-target="#myModal" id="preview_btn">
                Preview
            </button>

            <a href="/index" class="btn btn-default m-top">
                Back to tasks
            </a>
        </form>

    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Preview</h3>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5 class="item">Name</h5><p id="item_name"></p>
                        </li>
                        <li class="list-group-item">
                            <h5 class="item">Email</h5>
                            <p id="item_email"></p>
                        </li>
                        <li class="list-group-item">
                            <h5 class="item">Description</h5>
                            <p id="item_description"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<script>

    $('#preview_btn').on('click', function () {
        var attr =  ['name', 'email', 'description'];
        attr.forEach(function (item) {
            setItem(item);
        });
    });

    $('#save_btn').on('click', function () {
        $('#create_btn').click();
    });

    function setItem(name) {
       var item = $('#'+name).val();
       if (item) {
           $('#item_'+name).text(item).css('color', '').css('font-size', '1.3em').css('font-style', 'italic');
       } else {
           $('#item_'+name).text('Not Set').css('color', '#902544').css('font-size', '1.3em').css('font-style', 'italic');
       }
    }

</script>

<?php require 'blocks/footer.php'; ?>
