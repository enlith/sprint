

CREATE TABLE  `sprint`.`retrospective_table` (
`ID` INT NOT NULL ,
`Name` VARCHAR( 256 ) NOT NULL ,
`XFT_ID` INT NOT NULL ,
`StartWeek` INT NOT NULL ,
PRIMARY KEY (  `ID` )
) ENGINE = INNODB COMMENT =  'Sprint retrospective table';


CREATE TABLE  `sprint`.`xft_table` (
`ID` INT NOT NULL ,
`Name` VARCHAR( 256 ) NOT NULL ,
`Master` VARCHAR( 64 ) NOT NULL ,
PRIMARY KEY (  `ID` )
) ENGINE = INNODB COMMENT =  'XFT team and Scrum Master mapping';


CREATE TABLE  `sprint`.`retros_items_table` (
`ID` INT NOT NULL ,
`ItemName` VARCHAR( 32 ) NOT NULL ,
PRIMARY KEY (  `ID` )
) ENGINE = INNODB COMMENT =  'Items to be reviewed';


CREATE TABLE  `sprint`.`retros_review_items_table` (
`SprintRetrosID` INT NOT NULL ,
`ItemID` INT NOT NULL ,
`Status` VARCHAR( 32 ) NOT NULL ,
`Trend` VARCHAR( 32 ) NOT NULL ,
`Comment` VARCHAR( 1024 ) NOT NULL ,
INDEX (  `SprintRetrosID` ,  `ItemID` )
) ENGINE = INNODB COMMENT =  'Retrospective review result';



INSERT INTO `sprint`.`xft_table` (`ID`, `Name`, `Master`) VALUES ('1', 'XFT WCDMA AREA51', 'ERACAAH'), ('2', 'XFT WCDMA RadioForce', 'eghaadn');


INSERT INTO `sprint`.`retros_items_table` (`ID`, `ItemName`) VALUES ('1', 'OPO'), ('2', 'RADIATORS'), ('3', 'TEST HOTEL'), ('4', 'LINE'), ('5', 'TOOL/ENVIRONMENT'), ('6', 'CI'), ('7', '3GSIM'), ('8', 'DEPENDENCIES');


INSERT INTO `sprint`.`retros_review_items_table` (`SprintRetrosID`, `ItemID`, `Status`, `Trend`, `Comment`) VALUES ('1', '1', 'Good', 'Flat', ''), ('1', '2', 'Good', 'Up', ''), ('1', '3', 'Good', 'Down', ''), ('1', '4', 'Good', 'Flat', ''), ('1', '5', 'Good', 'Flat', ''), ('1', '6', 'Good', 'Flat', ''), ('1', '7', 'Good', 'Flat', ''), ('1', '8', 'Good', 'Flat', '');

INSERT INTO `sprint`.`retrospective_table` (`ID`, `Name`, `XFT_ID`, `StartWeek`) VALUES ('1', 'Sprint_7', '1', '201306'), ('2', 'Sprint_21', '2', '201303');
