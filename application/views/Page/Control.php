<?php
$uid = $q['uuid'];
?>
<div class="row">
	<div class="col-md-12">
		<h3 class="title"><span><i class="fa fa-tachometer"></i> Manage Music Bot <a href="dashboard" class="btn btn-warning btn-sm change-page"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></span></h3>
	</div>
	<div class="col-md-12">
		<div class="card card-outline-primary">
			<div class="card-block">
				<div class="row">

					<div class="col-md-6">
						<h3 class="title"><span><i class="fa fa-server"></i> สถานะ</span></h3>
						<center>
							<div class="card">
								<div class="card-block">
									<h3 class="app-status">Status: <i class="fa fa-spin fa-spinner"></i></h3>
									<h3 class="volume">Volume: 0%</h3>
									<button type="button" class="btn btn-success button-launch"><i class="fa fa-play-circle" aria-hidden="true"></i> Launch</button><button href="#" class="btn btn-danger button-shutdown"><i class="fa fa-stop-circle" aria-hidden="true"></i> Shutdown</button>
								</div>
							</div>
							<div class="card">
								<div class="card-block">
									<h3 class="title"><span><i class="fa fa-youtube-play"></i> Playback Control</span></h3>
									<button type="button" class="btn btn-info button-backward"><i class="fa fa-backward" aria-hidden="true"></i> Backward</button>
									<button type="button" class="btn btn-success button-start"><i class="fa fa-play"></i> Start</button>
									<button type="button" class="btn btn-info button-forward"><i class="fa fa-forward" aria-hidden="true"></i> Forward</button>
									<br><br>
									<div class="form-group">
										<button type="button" class="btn btn-outline-warning button-repeat"><i class="fa fa-repeat"></i> Repeat</button>
									</div>
									<div class="form-group col-md-6">
										<label><i class="fa fa-volume-up"></i> SetVolume</label>
										<select class="form-control input-sm select-volume">
											<option value="0">0 %</option>
											<option value="25">25 %</option>
											<option value="50">50 %</option>
											<option value="75">75 %</option>
											<option value="100">100 %</option>
										</select>
									</div>
								</div>
							</div>
						</center>
					</div>
					<div class="col-md-6">
						<h3 class="title"><span><i class="fa fa-gear"></i> ตั้งค่า</span></h3>
						<form class="engine" action="control/<?php echo $q['id'];?>/editSettings">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="alert hidden"></div>
							<div class="form-group">
								<label><i class="fa fa-cubes"></i>Nick Name ชื่อบอท</label>
								<input type="text" name="nick" value="" class="form-control input-3" placeholder="Nick Name">
							</div>
							<div class="form-group">
								<label><i class="fa fa-server"></i> Server IP ไอพีเซิร์ฟเวอร์</label>
								<input type="text" name="server_ip" value="" class="form-control input-1" placeholder="admin.ts3siam.com">
							</div>
							<div class="form-group">
								<label><i class="fa fa-lock"></i> Server Password รหัสผ่านเซิร์ฟเวอร์</label>
								<input type="text" name="server_password" value="" class="form-control input-2" placeholder="Server Password (ไม่มีไม่ต้องใส่)">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-outline-primary btn-block"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<br>
						<h3 class="title"><span><i class="fa fa-music"></i> Playlists</span></h3>
						<form class="engine" action="control/<?php echo $q['id'];?>/pbplist">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
							<div class="alert hidden"></div>
							<div class="form-group">
								<label><i class="fa fa-music"></i> รายการเพลย์ลิสต์ทั้งหมด</label>
								<select class="form-control select-paylists" name="paylist">

								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-outline-primary btn-block"><i class="fa fa-save"></i> เล่นจากเพลย์ลิสต์ที่เลือก</button>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<br>
						<h3 class="title"><span><i class="fa fa-id-card-o"></i> Advanced</span></h3>
						<center>
							<div class="form-group">
								<label>Username ชื่อผู้ใช้</label>
								<input type="text" value="<?php echo $q['username'];?>" readonly="" class="form-control text-center">
							</div>
							<div class="form-group">
								<label>Password รหัสผ่าน</label>
								<input type="text" value="<?php echo $q['password'];?>" readonly="" class="form-control text-center">
							</div>
							<div class="form-group">
								<a href="<?php echo $q['url'];?>" target="_blank" class="btn btn-outline-primary btn-block"><i class="fa fa-sign-in"></i> ไปยังหน้าล็อคอิน</a>
							</div>
						</center>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<br>
						<h3 class="title"><span><i class="fa fa-area-chart" aria-hidden="true"></i> Information Billing</span></h3>
						<center>
							<div class="form-group">
								<label>Dueday เช่าบริการเมื่อ</label>
								<input type="text" value="<?php echo $q['dueday'];?>" readonly="" class="form-control text-center">
							</div>
							<div class="form-group">
								<label>Expireday หมดอายุเมื่อ</label>
								<input type="text" value="<?php echo $q['expireday'];?>" readonly="" class="form-control text-center">
							</div>
							<div class="form-group">
								<form class="engine" action="control/<?php echo $q['id'];?>/renew" >
									<div class="alert hidden"></div>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<button type="submit" class="btn btn-outline-warning btn-block btn-submit"><i class="fa fa-plus-square"></i> ต่ออายุการใช้งาน 30 วัน</button>
								</form>
							</div>
							<div class="form-group">
								<form class="engine" action="control/<?php echo $q['id'];?>/cancel" >
									<div class="alert hidden"></div>
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									<button type="submit" class="btn btn-outline-danger btn-block btn-submit"><i class="fa fa-plus-square"></i> ยกเลิกบริการจากทางเรา</button>
								</form>
							</div>
						</center>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var $id = '<?php echo $q['id'];?>';
	function reload(){
		PageController();
	}
	function Controller(){
		$('button').attr('disabled', true);
		$('input').attr('disabled', true);
		$('.input-1').attr('value', 'Loading...');
		$('.input-2').attr('value', 'Loading...');
		$('.input-3').attr('value', 'Loading...');
		$.get($base_url + 'control/' + $id + '/getsettings', function(data) {
			$('input').attr('disabled', false);
			$('.input-1').attr('value', data.serverHost);
			$('.input-2').attr('value', data.serverPassword);
			$('.input-3').attr('value', data.nick);
		},'json');
		$('.select-paylists > option').remove();
		$.get($base_url + 'control/' + $id + '/getPlaylists', function(data) {
			$DataAll = data;
			$.each($DataAll,function(ID,data){
				$html = '<option value="' + data.uuid + '">' + data.name + ' (' + data.count + ' ไฟล์)</option>'
				$(".select-paylists").append($html);
			});
		},'json');
		$.get($base_url + 'control/' + $id + '/getstatus', function(data) {
			$('button').attr('disabled', false);
			if(data.repeat == true){
				$('.button-repeat').attr('data-value', 0);
				$('.button-repeat').html('<i class="fa fa-repeat"></i> Repeat (<b class="green">On</b>)');
			}else{
				$('.button-repeat').attr('data-value', 1);
				$('.button-repeat').html('<i class="fa fa-repeat"></i> Repeat (<b class="red">Off</b>)');
			}
			if(data.volume){
				$('.volume').html('Volume: ' + data.volume + '%');
			}
			if(data.playing == true){
				$('.button-backward').attr('disabled', false);
				$('.button-forward').attr('disabled', false);
				$('.button-start').attr('disabled', true);
			}else{
				$('.button-backward').attr('disabled', true);
				$('.button-forward').attr('disabled', true);
			}
			if(data.running == true){
				$('.app-status').html('Status: Running');
				$('.button-shutdown').attr('disabled', false);
				$('.button-launch').attr('disabled', true);
				$('.input-1').attr('readonly', true);

				$('.button-backward').attr('disabled', false);
				$('.button-forward').attr('disabled', false);
			}else{
				$('.button-backward').attr('disabled', true);
				$('.button-forward').attr('disabled', true);
				
				$('.app-status').html('Status: Offline');
				$('.button-launch').attr('disabled', false);
				$('.button-shutdown').attr('disabled', true);
				$('.input-1').attr('readonly', false);
			}
		},'json');
	}
	
	$(document).ready(function(){
		Controller();
		$('.btn-submit').click(function(event) {
			/* Act on the event */
			confirm("คุณเเน่ใจที่จะดำเนินการ\rการกระทำดังกล่าวไม่สามารถย้อนกลับได้!");
		});
		$('.button-repeat').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('button').attr('disabled', true);
			$.get($base_url + 'control/' + $id + '/repeat', {"val": $(this).attr('data-value')}, function(data) {
				$('button').attr('disabled', false);
				if(data.success = true){
					Controller();
				}else{
					alert("มีบางอย่างผิดพลาด");
				}
			},'json');
		});
		$('.select-volume').change(function(event) {
			/* Act on the event */
			event.preventDefault();
			$.get($base_url + 'control/' + $id + '/setVolume', {"setVolume": $('.select-volume').val()}, function(data) {
				$('button').attr('disabled', false);
				if(data.success = true){
					Controller();
				}else{
					alert("มีบางอย่างผิดพลาด");
				}
			},'json');
		});
		$('.button-launch').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('button').attr('disabled', true);
			$.get($base_url + 'control/' + $id + '/button_launch', function(data) {
				$('button').attr('disabled', false);
				PageController();
			},'json');
		});
		$('.button-shutdown').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('button').attr('disabled', true);
			$.get($base_url + 'control/' + $id + '/button_shutdown', function(data) {
				$('button').attr('disabled', false);
				PageController();
			},'json');
		});
		$('.button-backward').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('button').attr('disabled', true);
			$.get($base_url + 'control/' + $id + '/button_backward', function(data) {
				$('button').attr('disabled', false);
				PageController();
			},'json');
		});
		$('.button-forward').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('button').attr('disabled', true);
			$.get($base_url + 'control/' + $id + '/button_forward', function(data) {
				$('button').attr('disabled', false);
				PageController();
			},'json');
		});
		$('.button-start').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			$('button').attr('disabled', true);
			$.get($base_url + 'control/' + $id + '/button_start', function(data) {
				$('button').attr('disabled', false);
				PageController();
			},'json');
		});
	});
</script>