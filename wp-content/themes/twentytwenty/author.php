<?php
/**
 * Template for displaying Author Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header();

global $wp_query;
global $wp_roles;

$user 	   = $wp_query->get_queried_object();
$roleNames = [];

foreach ($wp_roles->roles as $role => $roleDetails){
	$roleNames[$role] = $roleDetails['name'];
}

$currRoleNames = [];
foreach ($user->roles as $role) {
	$currRoleNames[] = $roleNames[$role];
} ?>

	<div id="container">
		<div id="content" role="main">
			<div class="row">
				<div class="col-sm-12">
					<h2>Utilizator: <?php echo $user->first_name . ' ' . $user->last_name; ?></h2>
				</div>
				<div class="col-sm-12">
					<h3>Datele contului</h3>
					<hr>
				</div>
			</div>
			<form class="form-horizontal" name="kik_company" action="" method="post">
				<input type="hidden" id="user_id" name="user_id" value="<?php echo $user->ID; ?>" />
				<input type="hidden" id="kik_company_id" name="kik_company_id" value="<?php echo $kik_ID; ?>" />
				<input type="hidden" id="author-nonce" value="<?php echo wp_create_nonce('update-author'); ?>" />
				<!-- FIRST NAME -->
				<div class="row no-margin">
					<div class="form-group">
						<label class="control-label col-sm-2" for="kik_user_first_name">Prenume: </label>
						<div class="col-sm-10">
							<input type="text"
								   id="kik_user_first_name"
								   class="form-control"
								   name="kik_user_first_name"
								   placeholder="Prenume"
								   value="<?php echo $user->first_name; ?>" />
						</div>
					</div>
				</div>
				<!-- LAST NAME -->
				<div class="form-group">
					<label class="control-label col-sm-2" for="kik_user_last_name">Nume: </label>
					<div class="col-sm-10">
						<input type="text"
							   id="kik_user_last_name"
							   class="form-control"
							   name="kik_user_last_name"
							   placeholder="Nume"
							   value="<?php echo $user->last_name; ?>" />
					</div>
				</div>
				<!-- EMAIL -->
				<div class="form-group">
					<label class="control-label col-sm-2" for="kik_user_email">Email: </label>
					<div class="col-sm-10">
						<input type="text"
							   id="kik_user_email"
							   class="form-control"
							   name="kik_user_email"
							   placeholder="Email"
							   value="<?php echo $user->user_email; ?>" />
					</div>
				</div>
				<!-- UTILIZATOR -->
				<div class="form-group">
					<label class="control-label col-sm-2" for="kik_user_login">Utilizator: </label>
					<div class="col-sm-10">
						<input type="text"
							   id="kik_user_login"
							   class="form-control"
							   name="kik_user_login"
							   placeholder="Utilizator"
							   disabled="disabled"
							   value="<?php echo $user->user_login; ?>" />
					</div>
				</div>
				<!-- PAROLA NOUA -->
				<div class="form-group">
					<label class="control-label col-sm-2" for="kik_user_pass">Parolă nouă: </label>
					<div class="col-sm-10">
						<input type="password"
							   id="kik_user_pass"
							   class="form-control"
							   name="kik_user_pass"
							   placeholder="Parolă nouă"/>
					</div>
				</div>
				<!-- CONFIRMA PAROLA -->
				<div class="form-group">
					<label class="control-label col-sm-2" for="kik_user_pass_confirm">Confirmă parola nouă: </label>
					<div class="col-sm-10">
						<input type="password"
							   id="kik_user_pass_confirm"
							   class="form-control"
							   name="kik_user_pass_confirm"
							   placeholder="Confirmă parola nouă"/>
					</div>
				</div>
				<!-- ROLES VIEW -->
				<div class="form-group">
					<label class="control-label col-sm-2" for="kik_user_roles">Roluri: </label>
					<div class="col-sm-10">
						<input type="input"
							   id="kik_user_roles"
							   class="form-control"
							   name="kik_user_roles"
							   disabled="disabled" 
							   placeholder="Roluri"
							   value="<?php echo implode(', ' , $currRoleNames); ?>" />
					</div>
				</div>
				<div class="kik_save_area">
					<button type="button" class="btn btn-primary update-author-btn" aria-label="Left Align">
						Salvează
					</button>
			</form>		
		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer(); ?>
