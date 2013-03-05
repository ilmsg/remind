<div class="row-fluid">
    <div class="span12">
        <form method="post" action="<?php echo base_url('main/save')?>">
            ไตล์เติ้์ล : <br/><input type="text" name="title" size="100" class="input-xlarge" /><br/>
            ลิงค์ : <br/><input type="text" name="link" size="120" class="input-xxlarge" /><br/>
            ข้อความ : <br/><textarea rows="10" cols="120" name="content" class="input-xxlarge" ></textarea><br/>
            <input type="submit" value="บันทึก" />
        </form>
    </div>
</div>