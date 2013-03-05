<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo base_url('main/postfeed')?>">
            Caption : <br/><input type="text" name="caption" size="100" class="input-xlarge" /><br/>
            Link : <br/><input type="text" name="link" size="120" class="input-xxlarge" /><br/>
            Content : <br/><textarea rows="5" cols="120" name="content" class="input-xxlarge" ></textarea><br/>
            <input type="submit" value="Post To Wall" />
        </form>
    </div>
</div>  