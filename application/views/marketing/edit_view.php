<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo base_url('main/save')?>">
            <input type="hidden" name="id" value="<?php echo $remind->id; ?>" />
            <input type="hidden" name="refer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
            Caption : <br/><input type="text" name="title" size="100" class="input-xlarge" value="<?php echo $remind->title; ?>" /><br/>
            Link : <br/><input type="text" name="link" size="120" class="input-xxlarge" value="<?php echo $remind->link; ?>" /><br/>
            Content : <br/><textarea rows="10" cols="120" name="content" class="input-xxlarge" ><?php echo $remind->content; ?></textarea><br/>
            <input type="submit" value="Save" />
        </form>
    </div>
</div>