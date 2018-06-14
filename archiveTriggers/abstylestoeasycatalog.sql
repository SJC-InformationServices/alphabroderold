/** Select from assortmentsheets into easy catalog*/
Insert Into `masterdataview` (`season`, `catalog_name`, `page`, `style`, `companionstyle`, `brand`, `style_status`, `short_description`, `long_description`, `sub_description`, `gender`, `womens_fit`, `earth_friendly`, `b2b_category`, `catalog_color_group`, `size_group`, `b2b_size_group`)
SELECT '2017','USA AlphaBroder Buyers Guide', '0',`abstyle`,CONCAT_WS(",",`companionladies`, `companiontall`, `companionyouth`), `brand`, `usstatus`, `styledescription`, `mainstyleattributes`, `subattributes`,`gender`, `garmentfit`, `earthfriendly`, `category`, `stylecolorgroup`, `stylesizegroupus`,`stylesizeus` FROM `abstyles` where 
`abstyle` in ('8210LS','M355','M355W') and 
`abstyle` not in (select `style` from `masterdataview` where `season` ='2017' and `catalog_name` = 'USA AlphaBroder Buyers Guide')

/** From easy catalog to easy catalog */
Insert Into `masterdataview` (`season`, `catalog_name`, `page`, `style`, `companionstyle`, `brand`, `style_status`, `short_description`, `long_description`, `sub_description`, `gender`, `womens_fit`, `earth_friendly`, `b2b_category`, `catalog_color_group`, `size_group`, `b2b_size_group`,`price`)
SELECT '2017','USA AlphaBroder Buyers Guide', '0',`style`, `companionstyle`, `brand`, `style_status`, `short_description`, `long_description`, `sub_description`, `gender`, `womens_fit`, `earth_friendly`, `b2b_category`, `catalog_color_group`, `size_group`, `b2b_size_group`,`price` FROM `masterdataview`
 where `season` = '2016' and `catalog_name` = 'USA What\'s New' and 
`style` in (select `abstyle` from `abbuyersindex`) and 
`style` not in (select `style` from `masterdataview` where `season` ='2017' and `catalog_name` = 'USA AlphaBroder Buyers Guide') group by `style`;

