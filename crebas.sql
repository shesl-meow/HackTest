drop database playermansystem;

create database playermansystem;

USE playermansystem;
/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2018/5/25 12:18:24                           */
/*==============================================================*/

drop table if exists Developer;

drop table if exists Games;

drop table if exists LabelUp;

drop table if exists Platform;

drop table if exists Play;

drop table if exists ProvidedGames;

drop table if exists TypeTable;

drop table if exists Users;

drop table if exists isFriend;

/*==============================================================*/
/* Table: Developer                                             */
/*==============================================================*/
create table Developer
(
   HumanID              int not null,
   HName                varchar(64),
   gender               bool,
   birthday             date,
   useLanguage          varchar(32),
   primary key (HumanID)
);

/*==============================================================*/
/* Table: Games                                                 */
/*==============================================================*/
create table Games
(
   GameID               int not null,
   PName                varchar(32),
   HumanID              int,
   GName                varchar(64) not null,
   primary key (GameID)
);

/*==============================================================*/
/* Table: LabelUp                                               */
/*==============================================================*/
create table LabelUp
(
   TName                varchar(32) not null,
   GameID               int not null,
   primary key (TName, GameID)
);

/*==============================================================*/
/* Table: Platform                                              */
/*==============================================================*/
create table Platform
(
   PName                varchar(32) not null,
   useLanguage          varchar(32) DEFAULT 'JavaScript',
   primary key (PName)
);

/*==============================================================*/
/* Table: Play                                                  */
/*==============================================================*/
create table Play
(
   HumanID              int not null,
   GameID               int not null,
   BestScore            int not null,
   UserRank             double,
   primary key (HumanID, GameID)
);

/*==============================================================*/
/* Table: ProvidedGames                                         */
/*==============================================================*/
create table ProvidedGames
(
   GameID               int not null,
   PName                varchar(32),
   GName                varchar(64) not null,
   AvgRank              double DEFAULT 0,
   primary key (GameID)
);

/*==============================================================*/
/* Table: TypeTable                                             */
/*==============================================================*/
create table TypeTable
(
   TName                varchar(32) not null,
   primary key (TName)
);

/*==============================================================*/
/* Table: Users                                                 */
/*==============================================================*/
create table Users
(
   HumanID              int not null AUTO_INCREMENT,
   Email                varchar(256) not null,
   Alias                varchar(64) not null,
   GameID               int,
   HName                varchar(64),
   gender               bool,
   birthday             date,
   password             varchar(256) not null,
   primary key (HumanID)
);

/*==============================================================*/
/* Table: isFriend                                              */
/*==============================================================*/
create table isFriend
(
   HumanID              int not null,
   Use_HumanID          int not null,
   primary key (HumanID, Use_HumanID)
);

alter table Games add constraint FK_BuiltIn foreign key (PName)
      references Platform (PName) on delete restrict on update restrict;

alter table Games add constraint FK_develop foreign key (HumanID)
      references Developer (HumanID) on delete restrict on update restrict;

alter table LabelUp add constraint FK_LabelUp foreign key (TName)
      references TypeTable (TName) on delete restrict on update restrict;

alter table LabelUp add constraint FK_LabelUp2 foreign key (GameID)
      references Games (GameID) on delete restrict on update restrict;

alter table Play add constraint FK_Play foreign key (HumanID)
      references Users (HumanID) on delete restrict on update restrict;

alter table Play add constraint FK_Play2 foreign key (GameID)
      references ProvidedGames (GameID) on delete restrict on update restrict;

alter table ProvidedGames add constraint FK_isIn foreign key (GameID)
      references Games (GameID) on delete restrict on update restrict;

alter table Users add constraint FK_Favorate foreign key (GameID)
      references Games (GameID) on delete restrict on update restrict;

alter table isFriend add constraint FK_isFriend foreign key (HumanID)
      references Users (HumanID) on delete restrict on update restrict;

alter table isFriend add constraint FK_isFriend2 foreign key (Use_HumanID)
      references Users (HumanID) on delete restrict on update restrict;

/*==============================================================*/
/* Procedure to check whether rank of game is between 0 and 5   */
/*==============================================================*/
DELIMITER //
CREATE PROCEDURE check_rank_range(IN test_rank double)
BEGIN 
	IF test_rank < 0 or test_rank > 5 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Rank not in range.';
	END IF;
END //
DELIMITER ;

/*==============================================================*/
/* Bind the procedure with the rank contained table             */
/*==============================================================*/
DELIMITER //
CREATE Trigger gamesup_rank_range BEFORE UPDATE ON ProvidedGames
FOR EACH ROW
BEGIN
	CALL check_rank_range( NEW.AvgRank );
END //
CREATE Trigger gamesin_rank_range BEFORE INSERT ON ProvidedGames
FOR EACH ROW
BEGIN
	CALL check_rank_range( NEW.AvgRank );
END //

CREATE Trigger usrup_rank_range BEFORE UPDATE ON Play
FOR EACH ROW
BEGIN
	CALL check_rank_range( NEW.UserRank );
END //
CREATE Trigger usrin_rank_range BEFORE INSERT ON Play
FOR EACH ROW
BEGIN
	CALL check_rank_range( NEW.UserRank );
END //
DELIMITER ;

/*==============================================================*/
/* Set Insert Procedure prevent 'admin' or 'root' acount        */
/*==============================================================*/
DELIMITER //
CREATE PROCEDURE deny_admin_root(IN test_name varchar(64))
BEGIN 
	IF test_name = 'root' or test_name = 'admin' THEN
		SIGNAL SQLSTATE '45001'
			SET MESSAGE_TEXT = "user name can't be root or admin.";
	END IF;
END //
DELIMITER ;

/*==============================================================*/
/* Bind the procedure with the user table                       */
/*==============================================================*/
DELIMITER //
CREATE Trigger denyin_illegal BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
	CALL deny_admin_root(NEW.Alias);
END; //
CREATE Trigger denyup_illegal BEFORE UPDATE ON Users
FOR EACH ROW
BEGIN
	CALL deny_admin_root(NEW.Alias);
END; //
DELIMITER ;


/*==============================================================*/
/* Set Update Procedure update the avgRank of specific game     */
/*==============================================================*/
delimiter //
create procedure update_rank (In game_name varchar(32))
begin
	update ProvidedGames
	set AvgRank = (select AVG(UserRank)
	        from Games inner join Play
	        on Games.GameID = Play.GameID
	        where GName = game_name
	)
	where GName = game_name;
end; //
delimiter ;

/*==============================================================*/
/* Insert initial table for testing                             */
/*==============================================================*/
Insert into Users(HumanID,Alias,Email,password) value(1,"John","John@gmail.com","md5password");
Insert into Users(HumanID,Alias,Email,password) value(2,"Amy","Amy@gmail.com","md5password");
Insert into Platform(PName) value("web");
Insert into Games(GameID,GName,PName) value(1,"ElsBlock","web");
Insert into Games(GameID,GName,PName) value(2,"GreedySnake","web");
Insert into ProvidedGames(GameID,GName,PName) value(1,"ElsBlock","web");
Insert into Play(HumanID,GameID,BestScore,UserRank) value(1,1,94,4.8);
Insert into Play(HumanID,GameID,BestScore,UserRank) value(2,1,98,3.5);
