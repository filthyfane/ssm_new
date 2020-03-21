<?php


#####------------------------------------
##### kik_new_company
#####------------------------------------


function kik_new_user_FUNC($atts, $content = null) {
	ob_start();
	// extract params
	$a = shortcode_atts(array(
	), $atts);
			
	$current_user_id = wp_get_current_user()->ID;
	$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
	if (($current_user_id == 14) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))){

		global $wp_query;
		$user = $wp_query->get_queried_object();
		//echo DrawObject($user);
		$kik_user_roles = get_user_meta($user->ID, 'kik_user_roles', true);?>
		<form name="kik_user" action="" method="post">
			
			<input type="hidden" id="ID" name="ID" value="<?php echo $user->ID; ?>" />
			
			<input type="hidden" id="kik_action" name="kik_action" value="add" />
			
			<div class="kik_company_title">
				<div class="kik_company_title_tag">Adaugă utilizator</div>
				<a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Adaugă utilizatorul</a>
				<div class="kik_save_btn_response"></div>
			</div>
			
			<div class="kik_company_fields_title">Datele contului</div>
			
			<table class="kik_company_fields users table_type_main" data-tab="Datele contului">
				
				<!-- Labels -->
				<tr>
					<th>Camp</th>
					<th>Valoare</th>
				</tr>
				
				<!-- Existing rows -->
				<tr>
					<td colspan="2">
						<table class="table_type_row">
							<!-- Prenume -->
							<tr>
								<td>
									<label for="kik_user_first_name">Prenume:</label>
								</td>
								<td>
									<input type="text" class="size_s" id="kik_user_first_name" name="kik_user_first_name" value="<?php echo $user->first_name; ?>" /> <span></span>
								</td>
							</tr>
							<!-- Nume -->
							<tr>
								<td>
									<label for="kik_user_last_name">Nume:</label>
								</td>
								<td>
									<input type="text" class="size_s" id="kik_user_last_name" name="kik_user_last_name" value="<?php echo $user->last_name; ?>" /> <span></span>
								</td>
							</tr>
							<!-- Email -->
							<tr>
								<td>
									<label for="kik_user_email">Email:</label>
								</td>
								<td>
									<input type="text" class="size_s" id="kik_user_email" name="kik_user_email" value="<?php echo $user->user_email; ?>" /> <span></span>
								</td>
							</tr>
						</table>
					</td>
				<tr>
				<tr>
					<td colspan="2">
						<table class="table_type_row">
							<!-- Utilizator -->
							<tr>
								<td>
									<label for="kik_user_login">Utilizator:</label>
								</td>
								<td>
									<input type="text" class="size_s" id="kik_user_login" name="kik_user_login" value="<?php echo $user->user_login; ?>" disabled style="color:#787878;" />
								</td>
							</tr>
							<!-- Parola -->
							<tr>
								<td>
									<label for="kik_user_pass">Parolă:</label>
								</td>
								<td>
									<input type="password" class="size_s" id="kik_user_pass" name="kik_user_pass" value="" /> <span></span>
								</td>
							</tr>
							<!-- Confirma parola -->
							<tr>
								<td>
									<label for="kik_user_pass_confirm">Confirmă parola</label>
								</td>
								<td>
									<input type="password" class="size_s" id="kik_user_pass_confirm" name="kik_user_pass_confirm" value="" /> <span></span>
								</td>
							</tr>
						</table>
					</td>
				<tr>
				<tr>
					<td colspan="2">
						<table class="table_type_row">
							<!-- Roluri -->
							<tr>
								<td>
									<label for="kik_user_roles">Roluri:</label>
								</td>
								<td>
									<select id="kik_user_roles" name="kik_user_roles[]" class="size_s" multiple>
										<?php foreach (get_option('kik_user_roles') as $role) { ?>
											<option value="<?php echo $role; ?>"<?php echo (is_array($kik_user_roles) && in_array($role, $kik_user_roles) ? ' selected' : ''); ?>><?php echo $role; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
					</td>
				<tr>
				
			</table>
			
			&nbsp;<br />
			
			<div class="kik_company_fields_footer"></div>
			
			<div class="kik_save_area"><a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează utilizatorul</a><div class="kik_save_btn_response"></div></div>
			
		</form><?php 
	} 

	return ob_get_clean();
}
?>