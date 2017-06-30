<?php 
	function is_dir_empty($dir) {
	  if (!is_readable($dir)) return NULL; 
	  $handle = opendir($dir);
	  while (false !== ($entry = readdir($handle))) {
	    if ($entry != "." && $entry != "..") {
	      return FALSE;
	    }
	  }
	  return TRUE;
	}

	shell_exec ('mysql -Bse "CREATE DATABASE IF NOT EXISTS cwp_installer;"');
	shell_exec ('mysql -Bse "CREATE TABLE IF NOT EXISTS cwp_installer.list (  id int(11) NOT NULL AUTO_INCREMENT,  username varchar(50) NOT NULL,  password varchar(50) NOT NULL, dbname varchar(50) NOT NULL,  foldername varchar(255) NOT NULL,  PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=latin1;"');
	if (isset($_POST['submit'])) {
		$user = $user_login;
		$name = substr(uniqid(mt_rand(), true), 0,7);
		$password = substr(uniqid(mt_rand(), true), 0,24);
		$folder = $_POST['folder'];
		shell_exec ('wget https://wordpress.org/latest.tar.gz -P /home/'.$user.'/public_html/'.$folder.'/');
		shell_exec ('tar xfz /home/'.$user.'/public_html/'.$folder.'/latest.tar.gz -C /home/'.$user.'/public_html/'.$folder.'/');
		shell_exec ('mv /home/'.$user.'/public_html/'.$folder.'/wordpress/* /home/'.$user.'/public_html/'.$folder.'/');
		shell_exec ('rm -rf /home/'.$user.'/public_html/'.$folder.'/latest.tar.gz');
		shell_exec ('rm -rf /home/'.$user.'/public_html/'.$folder.'/wordpress/');
		shell_exec ('mysql -Bse "create database '.$user.'_'.$name.'"');
		shell_exec ('mysql -Bse "create user \''.$user.'_'.$name.'\'@\'localhost\' identified by \''.$password.'\';"');
		shell_exec ('mysql -Bse "grant usage on *.* to '.$user.'_'.$name.'@localhost identified by \''.$password.'\';"');
		shell_exec ('mysql -Bse "grant all privileges on '.$user.'_'.$name.'.* to '.$user.'_'.$name.'@localhost;"');
		shell_exec ('echo \'<?php																																					\'  > /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/**																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * The base configuration for WordPress																												\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * The wp-config.php creation script uses this file during the																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * installation. You don"t have to use the web site, you can																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * copy this file to "wp-config.php" and fill in the values.																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * This file contains the following configurations:																									\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * * MySQL settings																																	\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * * Secret keys																																	\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * * Database table prefix																															\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * * ABSPATH																																		\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * @link https://codex.wordpress.org/Editing_wp-config.php																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * @package WordPress																																\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 */																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	// ** MySQL settings - You can get this info from your web host ** //																				\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** The name of the database for WordPress */																										\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("DB_NAME", "'.$user.'_'.$name.'");																											\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** MySQL database username */																														\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("DB_USER", "'.$user.'_'.$name.'");																											\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** MySQL database password */																														\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("DB_PASSWORD", "'.$password.'");																												\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** MySQL hostname */																																\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("DB_HOST", "localhost");																														\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** Database Charset to use in creating database tables. */																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("DB_CHARSET", "utf8");																														\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** The Database Collate type. Don"t change this if in doubt. */																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("DB_COLLATE", "");																															\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/**#@+																																				\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * Authentication Unique Keys and Salts.																											\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * Change these to different unique phrases!																										\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ 	"WordPress.org secret-key service}						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * You can change these at any point in time to invalidate all existing cookies. This will force all 	"users to have to log in again.				\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * @since 2.6.0																																		\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 */																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("AUTH_KEY",         "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("SECURE_AUTH_KEY",  "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("LOGGED_IN_KEY",    "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("NONCE_KEY",        "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("AUTH_SALT",        "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("SECURE_AUTH_SALT", "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("LOGGED_IN_SALT",   "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("NONCE_SALT",       "'.uniqid(mt_rand(), true).'");																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/**#@-*/																																			\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/**																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * WordPress Database Table prefix.																													\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * You can have multiple installations in one database if you give each																				\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * a unique prefix. Only numbers, letters, and underscores please!																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 */																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	$table_prefix  = "wp_";																																\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/**																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * For developers: WordPress debugging mode.																										\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * Change this to true to enable the display of notices during development.																			\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * It is strongly recommended that plugin and theme developers use WP_DEBUG																			\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * in their development environments.																												\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * For information on other constants that can be used for debugging,																				\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * visit the Codex.																																	\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 *																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 * @link https://codex.wordpress.org/Debugging_in_WordPress																							\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	 */																																					\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	define("WP_DEBUG", false);																															\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/* That"s all, stop editing! Happy blogging. */																										\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** Absolute path to the WordPress directory. */																									\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	if ( !defined("ABSPATH") )																															\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'		define("ABSPATH", dirname(__FILE__) . "/");																										\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'																																						\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	/** Sets up WordPress vars and included files. */																									\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('echo \'	require_once(ABSPATH . "wp-settings.php");																											\' >> /home/'.$user.'/public_html/'.$folder.'/wp-config.php');
		shell_exec ('chown '.$user.':'.$user.' -R /home/'.$user.'/public_html/'.$folder.'/*');
		shell_exec ('chown '.$user.':'.$user.' /home/'.$user.'/public_html/'.$folder.'/');
		shell_exec ('find /home/'.$user.'/public_html/'.$folder.' -type d -exec chmod 755 {} \;');
		shell_exec ('chmod 755 /home/'.$user.'/public_html/'.$folder);
		shell_exec ('find /home/'.$user.'/public_html/'.$folder.' -type f -exec chmod 644 {} \;');

		shell_exec ('mysql -Bse "INSERT INTO cwp_installer.list (id, username, dbname, password, foldername) VALUES (NULL, \''.$user.'\', \''.$user.'_'.$name.'\', \''.$password.'\', \''.'/home/'.$user.'/public_html/'.$folder.'/'.'\');"');
	}

	$servername = $db_host;
	$username = $db_user;
	$password = $db_pass;
	$dbname = "cwp_installer";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    //die("Connection failed: " . $conn->connect_error);
	} 

	if (isset($_GET['action'])) {
		if ($_GET['action']=='delete') {

			$sql = "SELECT * FROM list WHERE id=? AND dbname=? AND password=? AND foldername=?";
			/*$sql2 = "SELECT * FROM list WHERE id='".$_GET['id']."' AND dbname='".$_GET['dbname']."' AND password='".$_GET['password']."' AND foldername='".$_GET['foldername']."'";
			echo $sql2;*/
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("isss", $_GET['id'],$_GET['dbname'],$_GET['password'],$_GET['foldername']);
			$stmt->execute();
			$meta = $stmt->result_metadata(); 
			$result = null;
			$params = null;
			while ($field = $meta->fetch_field()) 
			{ 
			    $params[] = &$row[$field->name]; 
			} 
			call_user_func_array(array($stmt, 'bind_result'), $params); 
			while ($stmt->fetch()) { 
			    foreach($row as $key => $val) 
			    { 
			        $c[$key] = $val; 
			    } 
			    $result[] = $c; 
			} 
			$stmt->close();

			if (isset($result))
			if (count($result)>0) {
				$sql = "DELETE FROM list WHERE id=? AND dbname=? AND password=? AND foldername=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("isss", $_GET['id'],$_GET['dbname'],$_GET['password'],$_GET['foldername']);
				$stmt->execute();
				$stmt->close();

				$sql = "DROP DATABASE ".$_GET['dbname'];
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$stmt->close();

				$sql = "DROP USER ".$_GET['dbname']."@localhost;";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$stmt->close();

				shell_exec('rm -rf '.$_GET['foldername'].'wp-admin/');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-content/');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-includes/');
				shell_exec('rm -rf '.$_GET['foldername'].'index.php');
				shell_exec('rm -rf '.$_GET['foldername'].'license.txt');
				shell_exec('rm -rf '.$_GET['foldername'].'readme.html');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-activate.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-admin');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-blog-header.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-comments-post.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-config-sample.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-config.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-content');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-cron.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-includes');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-links-opml.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-load.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-login.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-mail.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-settings.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-signup.php');
				shell_exec('rm -rf '.$_GET['foldername'].'wp-trackback.php');
				shell_exec('rm -rf '.$_GET['foldername'].'xmlrpc.php');
				shell_exec('rm -rf '.$_GET['foldername'].'.htaccess');

				if (is_dir_empty($_GET['foldername'])) {
					shell_exec('rm -rf '.$_GET['foldername']);
				}else{
				  	echo "<p>Not Deleting Folder ".$_GET['foldername'].", Because it is not empty</p>";
				}

			}
		}
	}

	?>
	<div id="tablecontainer">
	<?php
		$sql = "SELECT * FROM `list` WHERE `username`=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $user_login);
		$stmt->execute();
		$meta = $stmt->result_metadata(); 
		$result = null;
		$params = null;
		while ($field = $meta->fetch_field()) 
		{ 
		    $params[] = &$row[$field->name]; 
		} 
		call_user_func_array(array($stmt, 'bind_result'), $params); 
		while ($stmt->fetch()) { 
		    foreach($row as $key => $val) 
		    { 
		        $c[$key] = $val; 
		    } 
		    $result[] = $c; 
		} 
		$stmt->close();
	?>
					<table border=1 id="dbtable">
						<tr>
							<th>ID</th>
							<th>Database Name/User</th>
							<th>Install Location</th>
							<th></th>
						</tr>
						<?php for ($i=0;$i<=count($result)-1;$i++) : ?>
						<tr>
							<td><?php echo ($result[$i]['id']) ?></td>
							<td><?php echo ($result[$i]['dbname']) ?></td>
							<td><?php echo ($result[$i]['foldername']) ?></td>
							<td>
								<a href="index.php?module=installer_wordpress&action=delete&id=<?php echo ($result[$i]['id']) ?>&dbname=<?php echo ($result[$i]['dbname']) ?>&password=<?php echo ($result[$i]['password']) ?>&foldername=<?php echo ($result[$i]['foldername']) ?>"><span class="label label-danger"><img src="design/img/delete.png" title="Detele Wordpress Installation">&nbsp;&nbsp;Delete</span></a>
								&nbsp;&nbsp;
								<form class="pma_form" target="_BLANK" method="post" action="<?php echo ((!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/pma/') ?>">
									<input type="hidden" name="pma_username" value="<?php echo ($result[$i]['dbname']) ?>" />
									<input type="hidden" name="pma_password" value="<?php echo ($result[$i]['password']) ?>" />
									<button class="pma_submit" type="submit" class="btn btn-default"><span class="label label-warning"><img src="design/img/media-reload.png" height="16px" />&nbsp;phpMyAdmin</span></button>
								</form>
						</tr>
						<?php endfor; ?>
					</table>
	</div>

	<form method="POST">
		<div><input type="text" name="folder" placeholder="Folder Location"> &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" name="submit" class="btn btn-default">Install</button></div>
		<input type="hidden" name=user value="<?php echo ($user_login) ?>">
		<p><span class="text">example : <br/>wordpress<br/>subfolder/wordpress</span></p>
		
	</form>

	<style type="text/css">	
		#dbtable {width: 100%; margin-bottom: 20px;}
		#dbtable td,#dbtable th { padding: 10px; }
		.pma_submit { background: none; border: none; margin:0; padding : 0;}
		.pma_form { display: inline; }
	</style>
