<?php

include('header.php');

?>

<div class="row">
	<div class="content-left column small-12 medium-4">
		<div class="content column small-12 medium-12">
			<div class="content-box column small-12">
				<div class="content-userbox column small-12">
					<div class="userbox-avatar column small-5">
						<img src="<?php GrabSteamAvatar(); ?>">
					</div>

					<div class="userbox-info column small-7">
						<div class="userbox-steamid column small-12">
							<div class="icon">
								<i class="fa fa-steam-square" aria-hidden="true"></i>
							</div>

							<div class="info">
								<?php GrabSteamID(); ?>
							</div>
						</div>

						<div class="userbox-name column small-12">
							<div class="icon">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>

							<div class="info">
								<?php GrabSteamName(); ?>
							</div>
						</div>

						<?php if($CONFIG['ENABLED']): ?>
						<div class="userbox-money column small-12">
							<div class="icon">
								<i class="fa fa-usd" aria-hidden="true"></i>
							</div>

							<div class="info">
								<?php GrabMoney(); ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="content column small-12 medium-12">
			<div class="content-box column small-12">
				<div class="content-serverbox column small-12">
					<div class="serverbox-map column small-12">
						<div class="icon">
							<i class="fa fa-globe" aria-hidden="true"></i>
						</div>

						<div class="info">
							<span id="Map"></span>
						</div>
					</div>

					<div class="serverbox-mode column small-12">
						<div class="icon">
							<i class="fa fa-server" aria-hidden="true"></i>
						</div>

						<div class="info">
							<span id="Gamemode"></span>
						</div>
					</div>

					<div class="serverbox-slots column small-12">
						<div class="icon">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>

						<div class="info">
							<span id="Players"></span> Slots
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content-right column small-12 medium-8">
		<div class="content column small-12 medium-12">
			<div class="content-box2 column small-12">
				<div class="content-box-header">
					Rules
				</div>

				<div class="content-box-content">
					<div class="rule-box">
						<div class="rule-num">
							1
						</div>

						<div class="rule-text">
							<?php echo $RULES[1]; ?>
						</div>
					</div>

					<div class="rule-box2">
						<div class="rule-num2">
							2
						</div>

						<div class="rule-text">
							<?php echo $RULES[2]; ?>
						</div>
					</div>

					<div class="rule-box">
						<div class="rule-num">
							3
						</div>

						<div class="rule-text">
							<?php echo $RULES[3]; ?>
						</div>
					</div>

					<div class="rule-box2">
						<div class="rule-num2">
							4
						</div>

						<div class="rule-text">
							<?php echo $RULES[4]; ?>
						</div>
					</div>

					<div class="rule-box">
						<div class="rule-num">
							5
						</div>

						<div class="rule-text">
							<?php echo $RULES[5]; ?>
						</div>
					</div>

					<div class="rule-box2">
						<div class="rule-num2">
							6
						</div>

						<div class="rule-text">
							<?php echo $RULES[6]; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>