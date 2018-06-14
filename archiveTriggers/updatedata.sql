insert into `abstyles` (`abstyle`, `millstyle`, `stylefamily`, `brand`, `category`, `subcategory`, `usstatus`, `cdnstatus`, `gender`, `styledescription`, `mainstyleattributes`, `subattributes`, `earthfriendly`, `garmentfit`, `icons`, `companionladies`, `companiontall`, `companionyouth`,  `styledescriptionofchange`) 
select `AB_Style_#`, `Mill_Style`, `Style_Family`, `Brand`, `Category`, `Sub-Category`, `US_Status`, `CDN_Status`, `Gender`, `Style_Description`, `Main_Style_Attributes`, `Sub-Attributes`, `Earth_Friendly_Style`, `Garment_Fit`, `Icons`, `Companion:_Ladies'`, `Companion:_Tall_`, `Companion:_Youth`, `Description_of_Change_from_previous_publish_date` from `styles` where `AB_Style_#` is not null
ON DUPLICATE KEY UPDATE 
`stylefamily` = `styles`.`Style_Family`, 
`abstyles`.`category` = `styles`.`Category`, 
`abstyles`.`subcategory` = `styles`.`Sub-Category`, 
`abstyles`.`usstatus` = `styles`.`US_Status`, 
`abstyles`.`cdnstatus` = `styles`.`CDN_Status`, 
`abstyles`.`gender` = `styles`.`Gender`, 
`abstyles`.`styledescription` = `styles`.`Style_Description`, 
`abstyles`.`mainstyleattributes` = `styles`.`Main_Style_Attributes`, 
`abstyles`.`subattributes`= `styles`.`Sub-Attributes`, 
`abstyles`.`earthfriendly` = `styles`.`Earth_Friendly_Style`, 
`abstyles`.`garmentfit` = `styles`.`Garment_Fit`, 
`abstyles`.`icons`=`styles`.`Icons`, 
`abstyles`.`companionladies`=`styles`.`Companion:_Ladies'`, 
`abstyles`.`companiontall` = `styles`.`Companion:_Tall_`, 
`abstyles`.`companionyouth` = `styles`.`Companion:_Youth`, 
`abstyles`.`styledescriptionofchange` = `styles`.`Description_of_Change_from_previous_publish_date`;

insert into `abcolors` (`category`, `brand`, `abstyle`, `millstyle`, `styledescription`, `colorname`, `colorfamily`, `colorstatusus`, `colorstatuscdn`, `ussizerange`, `ussizecount`, `usskucount`, `cdnsizerange`, `cdnsizecount`, `cdnskucount`, `groupforpricing`, `hexcodemainbody`, `hexcodecontrast`, `pmscodemainbody`, `pmscodecontrast`, `colordescriptionofchange`)
select `Category`, `Brand`, `AB_Style_#`, `Mill_Style`, `Style_Description`, `Color_Name`, `Color_Family`, `Color_Status_US`, `Color_Status_CDN`, `US_Size_Range`, `US_Size_Count`, `US_Sku_Count`, `CDN_Size_Range`, `CDN_Size_Count`, `CDN_Sku_Count`, `Color_Group_for_Pricing`, `Hex_Code_Main_Body`, `Hex_Code_Contrast`, `PMS_Code_Main_Body`, `PMS_Code_Contrast`, `Description_of_Change` from `colors`
on duplicate key update 
`abcolors`.`category` = `colors`.`Category`, 
`abcolors`.`styledescription` = `colors`.`Style_Description`, 
`abcolors`.`colorfamily` = `colors`.`Color_Family`, 
`abcolors`.`colorstatusus` = `colors`.`Color_Status_US`, 
`abcolors`.`colorstatuscdn` = `colors`.`Color_status_CDN`, 
`abcolors`.`ussizerange` = `colors`.`US_Size_Range`, 
`abcolors`.`ussizecount` = `colors`.`US_Size_Count`, 
`abcolors`.`usskucount` = `colors`.`US_Sku_Count`, 
`abcolors`.`cdnsizerange` = `colors`.`CDN_Size_Range`, 
`abcolors`.`cdnsizecount` = `colors`.`CDN_Size_Count`, 
`abcolors`.`cdnskucount` = `colors`.`CDN_Sku_Count, 
`abcolors`.`groupforpricing` = `colors`.`Color_Group_For_Pricing`, 
`abcolors`.`hexcodemainbody` = `colors`.`Hex_Code_Main_Body`, 
`abcolors`.`hexcodecontrast` = `colors`.`Hex_Code_Contrast`, 
`abcolors`.`pmscodemainbody` = `colors`.`PMS_Code_Main_Body`, 
`abcolors`.`pmscodecontrast` = `colors`.`PMS_Code_Contrast`, 
`abcolors`.`colordescriptionofchange`=  `colors`.`Description_of_Change`;

"Ash City","Ash City Vintage","CORE365™","Extreme","Extreme®","Il Migliore","North End®","North End Sport® Red","North End Sport® Blue");


If NEW.brand in ("Ash City","Ash City Vintage","CORE365™","Extreme","Extreme®","Il Migliore","North End®","North End Sport® Red","North End Sport® Blue") then 

update `abstyles` set `stylecolorgroup` = (select GROUP_CONCAT(`generatedcolornameus` order by `colororder`,`colorname` SEPARATOR "\r") from `abcolors` where `abstyle` = NEW.`abstyle` and upper(`colorstatusus`) not in ('MILL DROP','AB DROP','NOT AVAILABLE')) where `abstyle` = NEW.`abstyle` limit 1;

update `abstyles` set `stylecolorgroupcdn` = (select GROUP_CONCAT(`generatedcolornamecdn` order by `colororder`,`colorname` SEPARATOR "\r") from `abcolors` where `abstyle` = NEW.`abstyle` and upper(`colorstatuscdn`) not in ('MILL DROP','AB DROP','NOT AVAILABLE')) where `abstyle` = NEW.`abstyle` limit 1;

else

update `abstyles` set `stylecolorgroup` = (select GROUP_CONCAT(`generatedcolornameus` order by `colororder`,`colorname` SEPARATOR ", ") from `abcolors` where `abstyle` = NEW.`abstyle` and upper(`colorstatusus`) not in ('MILL DROP','AB DROP','NOT AVAILABLE')) where `abstyle` = NEW.`abstyle` limit 1;

update `abstyles` set `stylecolorgroupcdn` = (select GROUP_CONCAT(`generatedcolornamecdn` order by `colororder`,`colorname` SEPARATOR ", ") from `abcolors` where `abstyle` = NEW.`abstyle` and upper(`colorstatuscdn`) not in ('MILL DROP','AB DROP','NOT AVAILABLE')) where `abstyle` = NEW.`abstyle` limit 1;
end if;