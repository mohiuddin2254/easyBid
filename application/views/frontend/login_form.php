
            <div id="post_header" class="container" style="height: 40px">
                <!-- Spacing below header -->
            </div>
            <div id="content-top-border" class="container">
            </div>
            <!-- === END HEADER === -->
            <!-- === BEGIN CONTENT === -->
            <div id="content">
				  <div class="container">
					<div class="card card-container">
						<img id="profile-img" class="profile-img-card" src="<?php echo base_url().'assets/images/'?>avatar_2x.png" />
						<p id="profile-name" class="profile-name-card"></p>
						<form class="form-signin" action="<?php echo base_url();?>users/login" method="post">
							<span id="reauth-email" class="reauth-email"></span>
							<input type="email" id="inputEmail" name="user_email" class="form-control" placeholder="Email address" required autofocus>
							<?php echo form_error('email','<span class="help-block">','</span>'); ?>
							<input type="password" id="inputPassword" name="user_password" class="form-control" placeholder="Password" required>
							<?php echo form_error('password','<span class="help-block">','</span>'); ?>
							<div id="remember" class="checkbox">
								<label>
									<input type="checkbox" value="remember-me"> Remember me
								</label>
							</div>
							<button class="btn btn-lg btn-primary btn-block btn-signin" name="loginSubmit" type="submit">Sign in</button>
						</form><!-- /form -->

						<?php if(isset($wrong_message)) { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h6><?php echo $wrong_message; ?></h6>
							</div>
						<?php } ?>
					</div><!-- /card-container -->
				</div><!-- /container -->
            </div>
            <!-- === END CONTENT === -->
