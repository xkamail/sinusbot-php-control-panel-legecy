<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<center>
			<h3 class="green">บอทยังว่างอยู่ในขณะนี้ <i class="fa fa-check"></i></h3>
			<hr>
		</center>
		<div class="card card-outline-primary">
			<div class="card-block">
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#home" role="tab"><b>เข้าสู่ระบบ</b> Login</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#profile" role="tab"><b>สมัคสมาชิก</b> Register</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="home" role="tabpanel">
								<br>
								<form class="engine" action="api/auth/login">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<div class="alert hidden"></div>
									<div class="form-group">
										<label>Username ชื่อผู้ใช้</label>
										<input type="text" name="username" placeholder="Username" required="" class="form-control">
									</div>
									<div class="form-group">
										<label>Password รหัสผ่าน</label>
										<input type="password" name="password" placeholder="Password" required="" class="form-control">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success btn-block btn-outline-success">เข้าสู่ระบบ</button>
									</div>
								</form>
							</div>
							<div class="tab-pane" id="profile" role="tabpanel">
								<br>
								<form class="engine" action="api/auth/register">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<div class="alert hidden"></div>
									<div class="form-group">
										<label>Username ชื่อผู้ใช้</label>
										<input type="text" name="username" placeholder="Username" required="" class="form-control">
									</div>
									<div class="form-group">
										<label>Password รหัสผ่าน</label>
										<input type="password" name="password" placeholder="Password" required="" class="form-control">
									</div>
									<div class="form-group">
										<label>Confirm Password ยืนยันรหัสผ่าน</label>
										<input type="password" name="repassword" placeholder="Confirm Password" required="" class="form-control">
									</div>
									<div class="form-group">
										<label>E-mail อีเมล์</label>
										<input type="email" name="email" placeholder="Your Email" required="" class="form-control">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block btn-outline-primary">เข้าสู่ระบบ</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-3"></div>
</div>