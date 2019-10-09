<?php
/*
 * Template Name: Form
 */

get_header();
?>


<?php 

// Cread Table
global $wpdb;

$table_crm_form = $wpdb->prefix . "crm_form";
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_crm_form (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  value1 text NOT NULL,
  value2 text NOT NULL,
  value3 text NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

dbDelta( $sql );


// Insert data
if ( isset( $_POST['form_submit'] ) ) {

	var_dump($_POST);

	global $wpdb;

	$wpdb->insert( 
		$table_crm_form, 
		array(
			'id' => '',
			'value1' => $_POST['fullname'],
			'value2' => $_POST['email'],
			'value3' => $_POST['message'],
		) 
	);

}

// Get Data
$get_data = $wpdb->get_var( "SELECT * FROM $table_crm_form",1,1 );
echo $get_data;

?>
<div id="content">
    <form method="post">
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname" required>
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>
        <label for="message">Your Message</label>
        <textarea name="message" id="message"></textarea>
        <input type="submit" name="form_submit" value="Send My Message">
    </form>
</div>

<?php
get_footer();