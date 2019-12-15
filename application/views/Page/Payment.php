<div class="row">
	<div class="col-md-12">
		<div class="card card-outline-warning">
			<div class="card-block">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<h3 class="title"><span><i class="fa fa-bank"></i> Payment</span></h3>
						<!-- <center>
							<img width="80%" height="175" src="<?php echo site_url('/assets/truemoney.jpg');?>"><hr>
						</center> -->
						<form class="engine" action="api/payment/truemoney">
							<div class="alert hidden"></div>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash()?>">
							<div class="form-group">
								<label>Truemoney</label>
								<input type="text" name="truemoney" class="form-control" required="" placeholder="รหัสบัตรเงินสดทรูมันนี่ 14 หลัก" maxlength="14">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-outline-warning btn-block"><i class="fa fa-save "></i> เติมเงินด้วยทรูมันนี่</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>