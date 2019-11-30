<div id="profile" class="tab-pane">
				<section class="panel">
				<?php if( !is_null($_SESSION['user']['bio']) ) : ?>
				  <div class="bio-graph-heading">
						<?php echo $_SESSION['user']['bio']; ?>
					</div>
				  <?php endif; ?>
				  <div class="panel-body bio-graph-info">
					<h1>Bio Graph</h1>
					<div class="row">
					  <div class="bio-row">
						<p><span>First Name </span>: <?php echo $_SESSION['user']['first_name']; ?> </p>
					  </div>
					  <div class="bio-row">
						<p><span>Last Name </span>: <?php echo $_SESSION['user']['last_name']; ?></p>
					  </div>
					  <div class="bio-row">
						<p><span>Birthday</span>: 27 August 1987</p>
					  </div>
					  <div class="bio-row">
						<p><span>Country </span>: United</p>
					  </div>
					  <div class="bio-row">
						<p><span>Occupation </span>: UI Designer</p>
					  </div>
					  <div class="bio-row">
						<p><span>Email </span>: <?php echo $_SESSION['user']['email']; ?></p>
					  </div>
					  <div class="bio-row">
						<p><span>Mobile </span>: (+6283) 456 789</p>
					  </div>
					  <div class="bio-row">
						<p><span>Phone </span>: (+021) 956 789123</p>
					  </div>
					</div>
				  </div>
				</section>
				<section>
				  <div class="row">
				  </div>
				</section>
			  </div>