<?php

$req_array = array();

/* QUERIES */

$req_t_acc = "CREATE TABLE t_acc (
id_acc INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
acc_name VARCHAR (50) NOT NULL,
acc_pwd CHAR (32) NOT NULL,
PRIMARY KEY (id_acc),
UNIQUE (acc_name)
)";
array_push($req_array,$req_t_acc);

$req_t_hall = "CREATE TABLE t_hall (
id_hall INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
hall_name VARCHAR (128) NOT NULL,
hall_code VARCHAR (16) NOT NULL,
PRIMARY KEY (id_hall),
UNIQUE (hall_code)
)";
array_push($req_array,$req_t_hall);

$req_t_floor = "CREATE TABLE t_floor (
id_floor INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
floor_nb INT (4) UNSIGNED NOT NULL,
PRIMARY KEY (id_floor),
UNIQUE (floor_nb)
)";
array_push($req_array,$req_t_floor);

$req_t_drop = "CREATE TABLE t_drop (
id_drop INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
drop_name VARCHAR (128) NOT NULL,
drop_code VARCHAR (16) NOT NULL,
drop_min INT (2) UNSIGNED NOT NULL,
drop_max INT (2) UNSIGNED NOT NULL,
PRIMARY KEY (id_drop),
UNIQUE (drop_code)
)";
array_push($req_array,$req_t_drop);

$req_t_hall_drop = "CREATE TABLE t_hall_drop (
id_hall_drop INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
hall_code VARCHAR (16) NOT NULL,
drop_code VARCHAR (16) NOT NULL,
PRIMARY KEY (id_hall_drop)
)";
array_push($req_array,$req_t_hall_drop);

$req_t_loot = "CREATE TABLE t_loot (
id_loot INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
loot_datetime INT (11) UNSIGNED NOT NULL,
id_hall INT (11) UNSIGNED NOT NULL,
floor_nb INT (4) UNSIGNED NOT NULL,
id_drop INT (11) UNSIGNED NOT NULL,
drop_qty INT (2) UNSIGNED NOT NULL,
id_acc INT (11) UNSIGNED NOT NULL,
PRIMARY KEY (id_loot)
)";
array_push($req_array,$req_t_loot);

/* END QUERIES */

/* FILL DB */

$req_array_content = array();

array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Hall of Light','light')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Hall of Dark','dark')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Hall of Fire','fire')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Hall of Wind','wind')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Hall of Water','water')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Hall of Magic','magic')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Giant\'s Keep','giant')");
array_push($req_array_content,"INSERT INTO t_hall VALUES(NULL,'Dragon\'s Lair','dragon')");

array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,1)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,2)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,3)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,4)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,5)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,6)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,7)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,8)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,9)");
array_push($req_array_content,"INSERT INTO t_floor VALUES(NULL,10)");

array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Angelmon','angelmon',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Rainbowmon **','rainbowmon2',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Rainbowmon ***','rainbowmon3',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Magic (Low)','magic_low',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Magic (MID)','magic_mid',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Magic (High)','magic_high',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Light (Low)','light_low',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Light (MID)','light_mid',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Light (High)','light_high',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Dark (Low)','dark_low',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Dark (MID)','dark_mid',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Dark (High)','dark_high',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Fire (Low)','fire_low',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Fire (MID)','fire_mid',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Fire (High)','fire_high',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Water (Low)','water_low',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Water (MID)','water_mid',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Water (High)','water_high',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Wind (Low)','wind_low',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Wind (MID)','wind_mid',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Essence of Wind (High)','wind_high',1,3)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Unknown scroll','scroll',1,5)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Mystical scroll','scroll_m',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Secret dungeon','secret_d',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Summoning stone','stone',1,5)");
//runes
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Blade rune','blade',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Despair rune','despair',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Endure rune','endure',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Energy rune','energy',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Fatal rune','fatal',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Focus rune','focus',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Guard rune','guard',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Nemesis rune','nemesis',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Rage rune','rage',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Revenge rune','revenge',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Shield rune','shield',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Swift rune','swift',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Vampire rune','vampire',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Violent rune','violent',1,1)");
array_push($req_array_content,"INSERT INTO t_drop VALUES(NULL,'Will rune','will',1,1)");

//Drop table
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','angelmon')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','light_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','light_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','light_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','secret_d')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'light','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','angelmon')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','dark_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','dark_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','dark_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','secret_d')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dark','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','angelmon')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','fire_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','fire_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','fire_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','secret_d')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'fire','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','angelmon')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','water_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','water_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','water_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','secret_d')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'water','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','angelmon')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','wind_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','wind_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','wind_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','secret_d')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'wind','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','magic_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','magic_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','magic_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','light_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','light_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','light_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','dark_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','dark_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','dark_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','fire_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','fire_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','fire_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','water_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','water_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','water_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','wind_low')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','wind_mid')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','wind_high')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'magic','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','despair')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','energy')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','fatal')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','blade')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','rage')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','swift')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','focus')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'giant','stone')");

array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','rainbowmon2')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','rainbowmon3')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','scroll')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','scroll_m')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','vampire')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','endure')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','violent')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','guard')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','will')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','nemesis')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','shield')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','revenge')");
array_push($req_array_content,"INSERT INTO t_hall_drop VALUES(NULL,'dragon','stone')");



//Connect
include 'db_connect.php';

//Tables creation
foreach ($req_array as $req_query) {
	$link->query($req_query) or die(mysqli_error($link));
}

//Content creation
foreach ($req_array_content as $req_query) {
	$link->query($req_query) or die(mysqli_error($link));
}

//Close connection
mysqli_close($link);

echo "done";

?>