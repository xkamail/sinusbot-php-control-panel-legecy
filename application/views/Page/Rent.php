<div class="row">
	<div class="col-md-12">
		<div class="card card-outline-primary">
			<div class="card-block">
				<div class="col-md-12"></div>
				<div class="col-md-12">
					<div class="card text-center">
						<div class="card-header">Music Bot</div>
						<div class="card-block">
							<h4 class="card-title">บอทเพลง TS3 ราคา 90.00 บาท</h4>
							<form class="engine" action="api/rent/buy">
								<div class="alert hidden"></div>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
								<button type="submit" class="btn btn-primary"><i class="fa fa-shopping-basket"></i> Buy 90.00 Point.</button>
							</form>
						</div>
						<div class="card-footer text-muted">จำนวนจำกัด.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>