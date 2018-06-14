BEGIN
IF OLD.abstyle <> NEW.abstyle THEN
update `abcolors` set `abcolors`.`abstyle` = NEW.abstyle where `abcolors`.`abstyle` = OLD.abstyle; 
end if;

IF OLD.stylesizeus <> NEW.stylesizeus then 
set NEW.stylesizegroupus = select `sizegroup` from `alphasizegroup` where upper(`sizerange`) = UPPER(NEW.stylesizeus);
end IF;

IF OLD.stylesizecdn <> NEW.stylesizecdn then 
set NEW.stylesizegroupcdn = select `sizegroup` from `alphasizegroup` where UPPER(`sizerange`) = UPPER(NEW.stylesizecdn);
end IF;

END


select GROUP_CONCAT(`colorname`,", " order by `colororder`,`colorname`) from `abcolors` where `abstyle` = '8802';
select GROUP_CONCAT(`colorname`,", " order by `colororder`,`colorname`) from `abcolors` where `abstyle` = '8802'
delimiter ||;
Drop Trigger `abcolorsinsert`||
CREATE TRIGGER `abcolorsinsert` BEFORE INSERT ON `abcolors` 
FOR EACH ROW
BEGIN 

if upper(NEW.`colorstatusus`) not in ('MILL DROP','AB DROP') then
	if upper(NEW.`colorstatusus`) = "NEW" then
		if upper(NEW.colorname) = 'WHITE' then
			update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',CONCAT("*",NEW.colorname),`abstyles`.`stylecolorgroup`) 
			where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
		ELSEIF upper(NEW.colorname) == 'BLACK' then
			update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',CONCAT("*",NEW.colorname),`abstyles`.`stylecolorgroup`) 
			where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
		ELSE
			update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',CONCAT("*",NEW.colorname),`abstyles`.`stylecolorgroup`) 
			where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
	END IF;
ELSE
if upper(NEW.colorname) = 'WHITE' then
	update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',NEW.colorname,`abstyles`.`stylecolorgroup`) 
	where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
ELSEIF upper(NEW.colorname) == 'BLACK' then
	update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',`abstyles`.`stylecolorgroup`,NEW.colorname) 
	where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
ELSE
	update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',`abstyles`.`stylecolorgroup`,NEW.colorname)
	where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
END IF;
END||

update `abstyles` set `stylecolorgroup` = NULL;
update `abstyles`,`abcolorssortedview` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',`stylecolorgroup`,`colorname`) where
`abstyles`.`style` = `abcolorssortedview`.`abstyle` and `abstyles`.`brand` = `abcolorssortedview`.`brand`
order by `abstyles`.`abstyle` asc


SELECT `abstyles`.`abstyle`,`stylecolorgroup`,`colorname`,`colororder` FROM `abstyles`,`abcolorssortedview` where `abstyles`.`abstyle` = `abcolorssortedview`.`abstyle` and `abstyles`.`brand` = `abcolorssortedview`.`brand`


BEGIN 

update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(", ",select `colorname` from `abcolorssortedview`) where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;
 ;

if upper(NEW.`colorstatusus`) = 'NEW' and upper(NEW.`colorstatusus`) not in ('MILL DROP','AB DROP') then

update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',`abstyles`.`stylecolorgroup`,CONCAT("*",NEW.colorname)) 
where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;

ELSE 

if upper(NEW.`colorstatusus`) not in ('MILL DROP','AB DROP') then

update `abstyles` set `abstyles`.`stylecolorgroup` = CONCAT_WS(', ',`abstyles`.`stylecolorgroup`,NEW.colorname) 
where `abstyles`.`abstyle` = NEW.abstyle and `abstyles`.`brand` = NEW.brand;

END IF;

update `abstyles` set `abstyles`.`stylesize` = NEW.ussizerange where `abstyle` = NEW.abstyle limit 1 ;
end if;
END


