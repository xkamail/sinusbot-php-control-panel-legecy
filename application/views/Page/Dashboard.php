<?php
$res = query("SELECT * FROM `server` WHERE `status` = ?",array("N"))->rowCount();
?>
<div class="row">
	<div class="col-md-4">
		<div class="card text-center card-outline-primary">
			<div class="card-block">
				<h4 class="card-title">BOT TS3SIAM.</h4>
				<p class="card-text user-point"><i class="fa fa-money"></i> ยอดเงินคงเหลือ : <b>0.00</b> Point.</p>
				<hr>
				<h4>จำนวนบอทที่เหลือทั้งหมด<br><?php echo $res;?></h4>
				<hr>
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="card text-center card-outline-primary">
			<div class="card-block">
				<div class="row">
					<div class="col-md-12">
						<h3 class="title"><span><i class="fa fa-tachometer"></i> Dashboard</span></h3>
						<div class="table-responsive">
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<th width="5%">#</th>
										<th>Current</th>
										<th>Dueday</th>
										<th>Expireday</th>
										<th>Control</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($q = query("SELECT * FROM rent WHERE owner_uid = ?",array($Auth['uid']))){
										while($row = $q->fetch()){
											?>
											<tr>
												<th scope="row"><?php echo $row['id'];?></th>
												<th><?php echo $row['currentday'];?></th>
												<td><?php echo $row['dueday'];?></td>
												<td><?php echo $row['expireday'];?></td>
												<td><a href="control/&id/<?php echo $row['id'];?>" class="change-page btn btn-outline-success btn-block">จัดการ</a></td>
											</tr>
											<?php
										}}
										?>
									</tbody>
								</table>
							</div>
							<div class="alert alert-warning">
								คำเตื่อน! หากคุณไม่ต่ออายุภายใน 3 วัน บอทจะถูกลบโดยอัตโนมัติ
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>