<?php
if (!(strlen($_GET["db"]) ? $mysql->select_db($_GET["db"]) : isset($_GET["sql"]) || isset($_GET["dump"]) || isset($_GET["database"]) || isset($_GET["processlist"]) || isset($_GET["privileges"]) || isset($_GET["user"]))) {
	if (strlen($_GET["db"])) {
		unset($_SESSION["databases"][$_GET["server"]]);
	}
	if (strlen($_GET["db"])) {
		page_header(lang('Database') . ": " . htmlspecialchars($_GET["db"]), lang('Invalid database.'), false);
	} else {
		page_header(lang('Select database'), "", null);
		echo '<p><a href="' . htmlspecialchars($SELF) . 'database=">' . lang('Create new database') . "</a></p>\n";
		echo '<p><a href="' . htmlspecialchars($SELF) . 'privileges=">' . lang('Privileges') . "</a></p>\n";
		echo '<p><a href="' . htmlspecialchars($SELF) . 'processlist=">' . lang('Process list') . "</a></p>\n";
		echo "<p>" . lang('MySQL version: %s through PHP extension %s', "<b>$mysql->server_info</b>", "<b>$mysql->extension</b>") . "</p>\n";
		echo "<p>" . lang('Logged as: %s', "<b>" . htmlspecialchars($mysql->result($mysql->query("SELECT USER()"))) . "</b>") . "</p>\n";
	}
	page_footer("db");
	exit;
}
$mysql->query("SET CHARACTER SET utf8");
