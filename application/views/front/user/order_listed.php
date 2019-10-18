<?php 
	$i = 0;
	foreach ($orders as $row1) {
		$i++;
?>
	<tr>
		<td class="image">
			<?php echo $i; ?>
		</td>
		<td class="quantity">
			<?php echo $row1['sale_datetime']; ?>
		</td>
		<td class="description">
			<?php echo $row1['grand_total']; ?>
		</td>
		<td class="order-id">
			<?php 
				$payment_status = json_decode($row1['payment_status'],true); 
				foreach ($payment_status as $dev) {
			?>

			<span class="label label-<?php if($dev['status'] == 'paid'){ ?>success<?php } else { ?>danger<?php } ?>" style="margin:2px;">
			<?php
					if(isset($dev['vendor'])){
						echo $this->crud_model->get_type_name_by_id('vendor', $dev['vendor'], 'display_name').' ('.translate('vendor').') : '.$dev['status'];
					} else if(isset($dev['admin'])) {
						echo translate('admin').' : '.$dev['status'];
					}
			?>
			</span>
			<br>
			<?php
				}
			?>
		</td>
		<td class="order-id" style="    text-align: center;">
            <?php


                $this->db->where('object_id',$row1['shipment_id']);
                $tracking_url_provider = $this->db->get('shipping')->row()->tracking_url_provider;
                 ?>
                 <a href="<?php  echo $tracking_url_provider;?>">Tracking</a>



		</td>
		<td class="add">
			<a class="btn btn-theme btn-theme-xs" href="<?php echo base_url(); ?>home/invoice/<?php echo $row1['sale_id']; ?>"><?php echo translate('invoice');?></a>
		</td>
	</tr>                                            
<?php 
	}
?>


<tr class="text-center" style="display:none;" >
	<td id="pagenation_set_links" ><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>
<!--/end pagination-->


<script>
	$(document).ready(function(){ 
		$('.pagination_box').html($('#pagenation_set_links').html());
	});
</script>

