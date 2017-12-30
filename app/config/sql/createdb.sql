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
INSERT INTO `myKanban`.`Roles` (`role_name`) VALUES ('Admin');
INSERT INTO `myKanban`.`Roles` (`role_name`) VALUES ('Standard');
INSERT INTO `myKanban`.`Users` (`username`, `name`, `password`, `email`) VALUES ('Admin', 'Admin', '$2y$10$gQoUv3Fo1N5UztmCGcFTseNioUDF7zUNSRtEfHwWUKBrFuX/OH1KG', 'Admin');
INSERT INTO `myKanban`.`User_Roles` (`user_id`, `role_id`) VALUES ('1', '1');
