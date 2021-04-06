
            <div id="post_header" class="container" style="height: 40px">
                <!-- Spacing below header -->
            </div>
            <div id="content-top-border" class="container">
            </div>
            <!-- === END HEADER === -->
            <!-- === BEGIN CONTENT === -->
            <div id="content">
                <div class="container background-white">
                    <div class="container">
                        <div class="row margin-vert-30">
                            <!-- Login Box -->
							<div class="col-md-2"></div>
                            <div class="col-md-8 col-md-offset-3 col-sm-offset-3">
								
							<?php if (isset($_SESSION['success'])) { ?>
								<div class="alert alert-success"> <?php echo $_SESSION['success']; ?></div>
							<?php
							} ?>
							<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
							<form action="" method="POST">
								<div class="form-group">
									<label for="gender">User Type:</label>
									<select class="form-control" id="user_type" name="user_type">
										<option value="">Select User Type</option>
										<option value="Creator">Auction Creator</option>
										<option value="Bidder">Bidder</option>
									</select>
								</div>
								<div class="form-group">
									<label for="username">Username:</label>
									<input class="form-control" name="user_name" id="username" type="text">
								</div>

								<div class="form-group">
									<label for="email">Email:</label>
									<input class="form-control" name="user_email" id="email" type="email">
								</div>

								<div class="form-group">
									<label for="password">Password:</label>
									<input class="form-control" name="user_password" id="password" type="password">
								</div>

								<div class="form-group">
									<label for="password">Confirm Password:</label>
									<input class="form-control" name="confirm_password" id="password" type="password">
								</div>

								<div>
									<button class="btn btn-primary regg" name="register">Register</button>
								</div>
							</form>							
                                
                            </div>
							<div class="col-md-2"></div>
							
                            <!-- End Login Box -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- === END CONTENT === -->
