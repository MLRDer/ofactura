<?php
/* @var $model \common\models\Notifications */


?>
<ul class="notification-list">
<?php foreach ($model as $items){
?>
    <li class="notification-item <?= $items->is_view==1?'active':''?>">
        <span class="badge gray"><?= date('d.m.Y',strtotime($items->created_date))?> </span>
        <a href="<?= $items->path?>&notify=<?= $items->id?>" class="notification-link">
            <span class="title"><?= $items->title_uz?> </span>
            <span class="subtitle"><?= $items->anons_uz?></span>
        </a>
    </li>

<?php }?>
</ul>
