DROP DATABASE IF EXISTS myKanban;
CREATE DATABASE myKanban;

drop user 'user1'@'localhost';

create user 'user1'@'localhost' identified by 'mypass';

grant select, insert, update, delete, create, drop on myKanban.* to 'user1'@'localhost';


USE myKanban;

CREATE TABLE Users
(
	user_id  int NOT NULL AUTO_INCREMENT,
	username varchar(100) NOT NULL,
	name varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	email varchar(50) NOT NULL,
	accountcreated DATETIME DEFAULT CURRENT_TIMESTAMP,
	accountmodified DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deleted TINYINT(1) NOT NULL DEFAULT 0,
	CONSTRAINT PK_user_id PRIMARY KEY (user_id),
	UNIQUE (username)
);

CREATE TABLE Roles
(
	role_id  int NOT NULL AUTO_INCREMENT,
	role_name varchar(100) NOT NULL,
    deleted TINYINT(1) NOT NULL DEFAULT 0,
	CONSTRAINT PK_role_id PRIMARY KEY (role_id)
);


CREATE TABLE User_Roles
(
    user_role_id  int NOT NULL AUTO_INCREMENT,
	user_id  int NOT NULL,
	role_id int NOT NULL,
	CONSTRAINT PK_user_role_id PRIMARY KEY (user_role_id),
    CONSTRAINT FK_userroles_user_id FOREIGN KEY (user_id)
    REFERENCES Users(user_id),
    CONSTRAINT FK_userroles_role_id FOREIGN KEY (role_id)
    REFERENCES Roles(role_id)
);


CREATE TABLE Boards
(
	board_id int NOT NULL AUTO_INCREMENT,
    board_name varchar(100) NOT NULL,
    hex_color varchar(100) NOT NULL,  
	board_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	board_last_modified DATETIME ON UPDATE CURRENT_TIMESTAMP,
    deleted TINYINT(1) NOT NULL DEFAULT 0,
    public TINYINT(1) NOT NULL DEFAULT 0,
	CONSTRAINT PK_board_id PRIMARY KEY (board_id)
);

CREATE TABLE User_Actions
(
	user_action_id int NOT NULL AUTO_INCREMENT,
	user_id int NOT NULL,
	action_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    action_desc varchar(100) NOT NULL,
    board_id int NOT NULL,
	CONSTRAINT PK_user_action_id PRIMARY KEY (user_action_id),
    CONSTRAINT FK_useractions_user_id FOREIGN KEY (user_id)
    REFERENCES Users(user_id),
    CONSTRAINT FK_useractions_board_id FOREIGN KEY (board_id)
    REFERENCES Boards(board_id)
);

CREATE TABLE Membership
(
    membership_id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    board_id int NOT NULL,
    CONSTRAINT PK_membership_id PRIMARY KEY (membership_id),
    CONSTRAINT FK_membership_user_id FOREIGN KEY (user_id)
    REFERENCES Users(user_id),
    CONSTRAINT FK_membership_board_id FOREIGN KEY (board_id)
    REFERENCES Boards(board_id)
);

CREATE TABLE States
(
    state_id int NOT NULL AUTO_INCREMENT,
    state_name varchar(55) NOT NULL,
    board_id int NOT NULL,
    deleted TINYINT(1) NOT NULL DEFAULT 0,
    position int NULL,
    state_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    state_last_modified DATETIME ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT PK_state_id PRIMARY KEY (state_id),
    CONSTRAINT FK_states_board_id FOREIGN KEY (board_id)
    REFERENCES Boards(board_id)
);

CREATE TABLE Cards
(
	card_id int NOT NULL AUTO_INCREMENT,
	state_id  int NOT NULL,
    card_name varchar(55) NOT NULL,
    deleted TINYINT(1) NOT NULL DEFAULT 0,
    card_created DATETIME DEFAULT CURRENT_TIMESTAMP,
    card_last_modified DATETIME ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT PK_card_id PRIMARY KEY (card_id),
	CONSTRAINT FK_cards_state_id FOREIGN KEY (state_id)
    REFERENCES States(state_id)
    
);
-- users
INSERT INTO `myKanban`.`Roles` (`role_name`) VALUES ('Admin');
INSERT INTO `myKanban`.`Roles` (`role_name`) VALUES ('Standard');
INSERT INTO `myKanban`.`Users` (`username`, `name`, `password`, `email`) VALUES ('Admin', 'Admin', '$2y$10$gQoUv3Fo1N5UztmCGcFTseNioUDF7zUNSRtEfHwWUKBrFuX/OH1KG', 'Admin');
INSERT INTO `myKanban`.`User_Roles` (`user_id`, `role_id`) VALUES ('1', '1');
INSERT INTO `myKanban`.`User_Roles` (`user_id`, `role_id`) VALUES ('1', '2');
INSERT INTO `myKanban`.`Users` (`user_id`, `username`, `name`, `password`, `email`, `accountcreated`, `deleted`) VALUES ('2', 'Standard', 'Standard', '$2y$10$ebrQoAiZa.7sT6/weP0FeOqyb/E0ypq37I7EvmGBH.8/Khd5N.aNe', 'Standard@hotmail.com', '2017-12-31 10:54:08', '0');
INSERT INTO `myKanban`.`User_Roles` (`user_id`, `role_id`) VALUES ('2', '2');
INSERT INTO `myKanban`.`Users` (`user_id`, `username`, `name`, `password`, `email`, `accountcreated`, `deleted`) VALUES ('3', 'Standard2', 'Standard2', '$2y$10$1dRZ5x/EtEngG4Jz43y9zOFsnlxBQBKX21gmtknG3tM/7djZ0X9o.', 'Standard2@hotmail.com', '2017-12-31 10:54:08', '0');
INSERT INTO `myKanban`.`User_Roles` (`user_id`, `role_id`) VALUES ('3', '2');

-- boards
INSERT INTO `myKanban`.`Boards` (`board_id`, `board_name`, `hex_color`, `board_created`, `deleted`, `public`) VALUES ('1', 'Project 1', '#00C303', '2018-01-01 13:06:39', '0', '0');
INSERT INTO `myKanban`.`Membership` (`membership_id`, `user_id`, `board_id`) VALUES ('1', '2', '1');

INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('1', 'To Do', '1', '0', '2', '2018-01-01 13:06:39', '2018-01-01 13:07:46');
INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('2', 'In Progress', '1', '0', '3', '2018-01-01 13:06:39', '2018-01-01 13:07:45');
INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('3', 'Done', '1', '0', '4', '2018-01-01 13:06:39', '2018-01-01 13:07:42');
INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('4', 'Work on Hold', '1', '0', '1', '2018-01-01 13:07:39', '2018-01-01 13:07:46');

INSERT INTO `myKanban`.`Cards` (`card_id`, `state_id`, `card_name`, `deleted`, `card_created`, `card_last_modified`) VALUES ('1', '1', 'Work To Be Done', '1', '2018-01-01 13:06:52', '2018-01-01 13:07:01');
INSERT INTO `myKanban`.`Cards` (`card_id`, `state_id`, `card_name`, `deleted`, `card_created`) VALUES ('2', '1', 'Write up notes', '0', '2018-01-01 13:07:12');
INSERT INTO `myKanban`.`Cards` (`card_id`, `state_id`, `card_name`, `deleted`, `card_created`) VALUES ('3', '1', 'Pay staff', '0', '2018-01-01 13:07:18');
INSERT INTO `myKanban`.`Cards` (`card_id`, `state_id`, `card_name`, `deleted`, `card_created`) VALUES ('4', '1', 'Random Task', '0', '2018-01-01 13:07:26');
INSERT INTO `myKanban`.`Cards` (`card_id`, `state_id`, `card_name`, `deleted`, `card_created`) VALUES ('5', '2', '', '0', '2018-01-01 13:07:30');
INSERT INTO `myKanban`.`Cards` (`card_id`, `state_id`, `card_name`, `deleted`, `card_created`) VALUES ('6', '4', 'Pay council tax', '0', '2018-01-01 13:07:59');

INSERT INTO `myKanban`.`Boards` (`board_id`, `board_name`, `hex_color`, `board_created`, `deleted`, `public`) VALUES ('2', 'Project 2', '#FF8C3C', '2018-01-01 13:06:39', '0', '1');
INSERT INTO `myKanban`.`Membership` (`membership_id`, `user_id`, `board_id`) VALUES ('2', '3', '2');

INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('5', 'To Do', '2', '0', '2', '2018-01-01 13:06:39', '2018-01-01 13:07:46');
INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('6', 'In Progress', '2', '0', '3', '2018-01-01 13:06:39', '2018-01-01 13:07:45');
INSERT INTO `myKanban`.`States` (`state_id`, `state_name`, `board_id`, `deleted`, `position`, `state_created`, `state_last_modified`) VALUES ('7', 'Done', '2', '0', '4', '2018-01-01 13:06:39', '2018-01-01 13:07:42');