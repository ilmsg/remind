<?php if( isset($reminds) ){ ?>
	<?php foreach( $reminds->result() as $key => $remind ){ ?>
	<div class="row-fluid">
		<div class="span12">
			<h4><?php echo $remind->id;?>. <?php echo $remind->title; ?></h4>
			<p><?php echo nl2br($remind->content); ?><br/><?php echo anchor($remind->link, $remind->link); ?></p>
			<p>
            	<a href="javascript:postToFeed('<?php echo $remind->title; ?>','<?php echo $remind->content; ?>','<?php echo $remind->link; ?>');" class="btn btn-mini">โพสลงกระดานเฟสบุค</a>
                <?php if( $this->user == $this->admin ){ ?>				
                        | <?php echo anchor('main/edit/' . $remind->id, 'แก้ไข', 'class="btn btn-mini"'); ?>
                        | <?php echo anchor('main/del/' . $remind->id, 'ลบ', 'class="btn btn-mini" onclick="return confirm(\'คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?\');"'); ?>
                <?php } ?>
                <div class="fb-like" data-href="<?php echo $remind->link; ?>" data-send="true" data-width="450" data-show-faces="true" data-font="tahoma"></div>
            </p>
			<hr/>
        </div>
	 </div>
	<?php } ?>
<?php } ?>    

<div class="row-fluid marketing">
	<div class="span12 pagination"><?php echo $links; ?></div>
</div>

<?php /*
<div class="row-fluid marketing">
<div class="span6">
  <h4>Subheading</h4>
  <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

  <h4>Subheading</h4>
  <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

  <h4>Subheading</h4>
  <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
</div>

*/ ?>
