<?php
use app\models\User;

require 'blocks/header.php';
?>

<div class="container">

    <?php if(User::isActiveAdmin()):?>
        <a href="/logout"><span class="btn btn-primary" style="float: right; margin-top: 10px;">Log Out</span></a>
    <?php else:?>
        <a href="/sign_in"><span class="btn btn-info" style="float: right; margin-top: 10px;">Sign In</span></a>
    <?php endif;?>

    <h1>Taskman</h1>
    <a href="/create"><span class="btn btn-primary" style="margin-bottom: 10px;">Create task</span></a>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>
                Img
            </th>
            <th>
                <a href="/index?sort=<?=key($sortParams['name'])?>&page=<?=$activePage?>">Name</a>
            </th>
            <th>
                <a href="/index?sort=<?=key($sortParams['email'])?>&page=<?=$activePage?>">Email</a>
            </th>
            <th>Text</th>
            <th>
                <a href="/index?sort=<?=key($sortParams['status'])?>&page=<?=$activePage?>">Status</a>
            </th>
            <?php if(User::isActiveAdmin()):?>
                <th style="width: 10px;">Actions</th>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task):?>
            <tr>
                <td style="width: 80px;"><img alt="User Pic" src="/<?=$task->file?>" class="img-responsive" width="80" height="70"></td>
                <td><?= $task->name?></td>
                <td><?= $task->email?></td>
                <td><?= $task->text?></td>
                <td>
                    <?php if($task->status):?>
                    <span class="glyphicon glyphicon-ok" style="color: #00cc00"></span>
                    <?php else:?>
                    <span class="glyphicon glyphicon-ok" style="color: #e7e9ff"></span>
                    <?php endif;?>
                </td>
                <?php if(User::isActiveAdmin()):?>
                <td style="text-align: center">
                    <a href="/edit/?id=<?=$task->id?>">
                        <span title="Edit task" class="glyphicon glyphicon-pencil"></span>
                    </a>
                </td>
                <?php endif;?>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <ul class="pagination">
        <?php foreach ($p->buttons as $button) :
            if ($button->isActive) : ?>
                <li class="<?php $class = "";
                if ($button->text === 'Previous') $class = 'prev';
                if ($button->text === 'Next') $class = 'next';
                echo $class?>">
                    <a href = '?page=<?=$button->page?>&sort=<?=$activeSort?>'><?=$button->text?></a>
                </li>
            <?php else : ?>
                <li class="<?php $class = "active";
                if ($button->text === 'Previous') $class = 'prev';
                if ($button->text === 'Next') $class = 'next';
                echo $class?>">
                    <span style="color:#555555"><?=$button->text?></span>
                </li>

            <?php endif;
        endforeach; ?>
    </ul>
</div>

<?php require 'blocks/footer.php'; ?>
