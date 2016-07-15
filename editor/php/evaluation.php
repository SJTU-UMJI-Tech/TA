<?php echo $htmlData; ?>
<form name="example" method="post" action="../../../../editor/php/evaluation.php">
    <textarea name="content1" style="width:700px;height:200px;visibility:hidden;">
        <?php echo htmlspecialchars($htmlData); ?>
    </textarea>
    <br/>
    <input type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
</form>