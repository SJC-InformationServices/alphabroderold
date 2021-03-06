<?php
/**
 * API.PHP
 *
 * For Any Archive Request Start Here
 *
 * PHP version 7
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   Application
 * @package    Request
 * @author     Kevin Noseworthy <kevin.noseworthy@stjoseph.com>
 * @copyright  1997-2018 St.Joseph Communication
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */ 
require_once "archive/archive_config_inc.php";
if (!isset($_SESSION['LOGGEDIN']) || !$_SESSION['LOGGEDIN'] ) {
    $_SESSION['LOGGEDIN'] = true;
    header("Location: index.php");
} else {
    session_regenerate_id();
}


?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <title>SJC Archive AB</title>
  <meta charset="utf-8">
  
  
  
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>

<link rel="stylesheet" href="https://s3.amazonaws.com/sjcarchiveassets/alphabroderold/style/archive.css">

 <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script>
<script src="https://s3.amazonaws.com/sjcarchiveassets/lib/DataTables/Editor-1.7.4/js/dataTables.editor.min.js"></script>
<script src="https://s3.amazonaws.com/sjcarchiveassets/lib/DataTables/Editor-1.7.4/js/editor.bootstrap.min.js"></script>
 


 </head>
 <body class="yui3-skin-sam yui-skin-sam">
 <nav class="navbar navbar-dark bg-faded">
  <a class="navbar-brand" href="#">
    <img src="https://s3.amazonaws.com/sjcarchiveassets/lib/images/logo.jpg" alt="St.Joseph Communications">
  </a>
</nav>
<ul class="nav nav-tabs" id="archiveTabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="home" aria-selected="true">Products</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="catalogs-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="profile" aria-selected="false">Projects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="contact" aria-selected="false">Attachments</a>
  </li>
</ul>
<div class="tab-content" id="archiveTabContent">
  <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="home-tab">
    <div class="container-fluid">
      <div class="row">
        <div class="col col-2" id="productsTreeContent">
          <div id="productsTree"></div>
        </div>
        <div class="col col" id="productsTableContent">
          <table id="productsTable" class="cell-border compact stripe">

          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="profile-tab">
  <div class="container-fluid">
      <div class="row">
        <div class="col col-2" id="projectsTreeContent">
           <div id="projectsTree"></div>
        </div>
        <div class="col col" id="projectsTableContent">
        
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="contact-tab">
  <div class="container-fluid">
      <div class="row">
        <div class="col col-2" id="attachmentsTreeContent">Tree</div>
        <div class="col col" id="attachmentsTableContent">DT</div>
      </div>
    </div>
  </div>
</div>  


  <div id="archivebody" class="container-fluid">
        <div class="row">
         <div class="col-md-12">
          <div class="archivecontent" id="archivesrcnode"></div>
        </div>
       </div>
  </div>
  <script>
  YUI.GlobalConfig = {
  groups: {
   yui2: {
    base: 'https://s3.amazonaws.com/sjcarchiveassets/alphabroderold/yui2in3/',
    patterns: {
     'yui2-': {
      configFn: function(me) {
       if (/-skin|reset|fonts|grids|base/.test(me.name)) {
        me.type = 'css';
        me.path = me.path.replace(/\.js/, '.css');
        me.path = me.path.replace(/\/yui2-skin/, '/assets/skins/sam/yui2-skin');
       }
      }
     }
    }
   }
  }
 };
 YUI().use('stylesheet','aui-tabview', 'node', 'yui2-treeview','yui2-containercore','yui2-utilities','yui2-menu','json-stringify','json-parse','io',function(Y) {
  var YUI2 = Y.YUI2;
  var archiveHead = Y.one("#archivehead");
  var archiveBody = Y.one("#archivebody");
 Y.io.header('Content-Type', 'application/json'); 
 var tabtemplate = '<div id="{{ID}}" class="archiveApp"><div class="row"><div class="col-sm-2"><div id="{{TREE}}" class="left"></div></div><div class="col-md-10"><div class="right"><table id="{{DT}}" cellpadding="0" cellspacing="0" class="table table-condensed table-striped table-bordered table-hover table-compact "><thead><tr>{{COLS}}</tr></thead></table></div></div></div></div>'; 
 
  var tv = new Y.TabView({stacked:false});
  var productId = Y.guid();
  //<th>'+productcols.join("</th><th>")+'</th>
  var productcols = [
  'id',
  'abstyle',
  'millstyle',
  'stylefamily',
  'brand',
  'category',
  'subcategory',
  'usastatus',
  'cdnstatus',
  'gender',
  'styleheadline',
  'styledescription',
  'mainstyleattributes',
  'subattributes',
  'earthfriendly',
  'garmentfit',
  'icons',
  'companionladies',
  'companiontall',
  'Companionyouth',
  'stylecolorgroupusa',
  'stylecolorgroupcdn',
  'stylesizerangeus',
  'stylesizegroupus',
  'stylesizerangecdn',
  'stylesizegroupcdn',
  'styledescriptionofchange',
  'createdon',
  'updatedon'];
  
  var catalogcols = [
  'id',
  'season',
  'project',
  'pagefrom',
  'abstyle',
  'brand',
  'style_status',
  'short_description',
  'long_description',
  'sub_description',
  'gender','garmentfit','earthfriendly','category',
  'subcategory','catalog_color_group','price','sizegroup','sizerange',
  'createdon','updatedon'
  ];

  var productsTableElement = Y.one("#productsTable");
  productsTableElement.appendChild(Y.Node.create('<th>'+productcols.join("</th><th>")));
  
  var product_tab = new Y.Tab({
   label: "Products",
   content: tabtemplate.replace("{{ID}}",'product-'+productId).replace("{{TREE}}",'productTree-'+productId).replace("{{DT}}",'productTable-'+productId).replace('{{COLS}}','<th>'+productcols.join("</th><th>")+'</th>')
  });
  
  var catalogId = Y.guid();
  var catalog_tab = new Y.Tab({
   label: "Catalogs",
   content: tabtemplate.replace("{{ID}}",'catalog-'+catalogId).replace("{{TREE}}",'catalogTree-'+catalogId).replace("{{DT}}",'catalogTable-'+catalogId).replace('{{COLS}}','<th>'+catalogcols.join("</th><th>")+'</th>')
  });
  var assetId = Y.guid();
  var asset_tab = new Y.Tab({
   label: "Assets",
   content: tabtemplate.replace("{{ID}}",'asset-'+assetId).replace("{{TREE}}",'assetTree-'+assetId).replace("{{DT}}",'assetTable-'+assetId)
  });
   
  tv.add(product_tab);
  tv.add(catalog_tab);
  tv.add(asset_tab);
 var productTree,catalogTree;
 var productDt,catalogDt;
 
 var afterRender = function()
 {
 var contentHeight = archiveBody.get('offsetHeight')-60;
 var contentWidth = archiveBody.get('offsetWidth')*0.70;
 
 var productNode = Y.one("#product-"+productId);
 var catalogNode = Y.one("#catalog-"+catalogId);
 var assetNode = Y.one("#asset-"+assetId);
 
 productNode.set('offsetHeight',contentHeight+'px');
 catalogNode.set('offsetHeight',contentHeight+'px');
 assetNode.set('offsetHeight',contentHeight+'px');
 
 var css = "#product-"+productId+" .row .col-sm-2 .left{height:"+contentHeight+"px;}" +
     "#product-"+productId+" .row .right{height:"+contentHeight+"px;}" +
     "#catalog-"+catalogId+" .row .col-sm-2 .left{height:"+contentHeight+"px;}" +
     "#catalog-"+catalogId+" .row .right{height:"+contentHeight+"px;}" +
     "#asset-"+assetId+" .row .col-sm-2 .left{height:"+contentHeight+"px;}" +
     "#asset-"+assetId+" .row .right{height:"+contentHeight+"px;}"     ;
 var archiveStyle = new Y.StyleSheet(css);
 
 
 var loadProductData = function(node, fnLoadComplete) {
   
    var label = node.label;
    var sendRequest=true;
    
   var nodeData = node.data;
   var hierarchy = nodeData.archiveHierarchy;
   
   switch(hierarchy[0])
   {
   case 'alpha_styles':
     switch(hierarchy[1]){
      case 'allstyles':
      var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["abstyle"],"groupby":"true","sort":[["abstyle","asc"]]}));
      var url = "/alpha_styles/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].abstyle,isLeaf:false,editable:true,archiveHierarchy:["alpha_colors","colorsbystyle"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();};
      break;
      case 'allbrands':
      
      var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["brand"],"groupby":"true","sort":[["brand","asc"]]}));
      var url = "/alpha_styles/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].brand,isLeaf:false,editable:true,archiveHierarchy:["alpha_styles","brands"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();};
      
      break;
      case 'brands':
      
      var newNodeObja = {type:'Text',label:"Categories",isLeaf:false,editable:false,archiveHierarchy:["alpha_styles","categories"]};
    var na = new YUI2.widget.TextNode(newNodeObja, node, false); 
    
    var newNodeObjb = {type:'Text',label:"Styles",isLeaf:false,editable:false,archiveHierarchy:["alpha_styles","stylesbybrand"]};
    var nb = new YUI2.widget.TextNode(newNodeObjb, node, false);    
      
     fnLoadComplete();
     return; 
      break;
      case 'categories':
      
        var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["category"],"filters":[{"attribute":"brand","value":node.parent.label,"operator":"="}],"groupby":"true","sort":[["category","asc"]]}));
      var url = "/alpha_styles/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].category,isLeaf:false,editable:true,archiveHierarchy:["alpha_styles","stylesbycategory"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();}; 
      break;
      case 'stylesbycategory':
      case 'stylesbybrand':
      
       if(hierarchy[1] == 'stylesbycategory'){
        var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["abstyle"],"filters":[{"attribute":"category","value":node.label,"operator":"="},{"attribute":"brand","value":node.parent.parent.label,"operator":"="}],"groupby":"true","sort":[["abstyle","asc"]]}));
       }else{
        var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["abstyle"],"filters":[{"attribute":"brand","value":node.parent.label,"operator":"="}],"groupby":"true","sort":[["abstyle","asc"]]}));
       }
       var url = "/alpha_styles/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].abstyle,isLeaf:false,editable:true,archiveHierarchy:["alpha_colors","colorsbystyle"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();};
      break;
     }
    break;
    case 'alpha_colors':
     switch(hierarchy[1])
     {
      case 'colorsbystyle':
      var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["colorname"],"filters":[{"attribute":"abstyle","value":node.label,"operator":"="}],"groupby":"true","sort":[["colorname","asc"]]}));
      var url = "/alpha_colors/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].colorname,isLeaf:true,editable:true,archiveHierarchy:["alpha_colors","colorname"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();
       };      
      break;
     }
    
    
    break;
    case 'alpha_catalogs':
    
     switch(hierarchy[1]){
      case 'seasons':
      
      var verb = encodeURIComponent(Y.JSON.stringify({"filters":[{"attribute":"season","value":node.label,"operator":"="}],"attributes":["catalog_name"],"groupby":"true","sort":[["season","asc"]]}));
      var url = "/alpha_catalogs/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].catalog_name,isLeaf:false,editable:true,archiveHierarchy:["alpha_catalogs","catalog"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();
       }; 
      
      break;
      case 'catalog':
       var newNodeObja = {type:'Text',label:"Styles",isLeaf:false,editable:false,archiveHierarchy:["alpha_catalogs","styles"]};
     var na = new YUI2.widget.TextNode(newNodeObja, node, false);
     
     var newNodeObjb = {type:'Text',label:"Pages",isLeaf:false,editable:false,archiveHierarchy:["alpha_catalogs","pages"]};
     var nb = new YUI2.widget.TextNode(newNodeObjb, node, false);
     
     var newNodeObjc = {type:'Text',label:"Brands",isLeaf:false,editable:false,archiveHierarchy:["alpha_catalogs","brands"]};
     var nc = new YUI2.widget.TextNode(newNodeObjc, node, false);
     
       fnLoadComplete();
       return;
      break;
      case 'pages':
      var filters = 
      [{"attribute":"season","value":node.parent.parent.label,"operator":"="},
      {"attribute":"catalog_name","value":node.parent.label,"operator":"="}];
      
      var verb = encodeURIComponent(Y.JSON.stringify({"filters":filters,"attributes":["page"],"groupby":"true","sort":[["page","asc"]]}));
      
      var url = "/alpha_catalogs/?data="+verb;
      complete = function(id,response)
      {
       var d = Y.JSON.parse(response.responseText);
       
       for(var i=0;i<d.length;i++)
       {
        if(Y.Lang.isNull(d[i].page))
        {
         d[i].page = 'BLANK';
        }
        
        var newNodeObja = {type:'Text',label:d[i].page,isLeaf:false,editable:true,archiveHierarchy:["alpha_catalogs","stylesbypage"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();
      }; 
      
      break;
      case 'brands':
      var filters = 
      [{"attribute":"season","value":node.parent.parent.label,"operator":"="},
      {"attribute":"catalog_name","value":node.parent.label,"operator":"="}];
      
      var verb = encodeURIComponent(Y.JSON.stringify({"filters":filters,"attributes":["brand"],"groupby":"true","sort":[["brand","asc"]]}));
      
      var url = "/alpha_catalogs/?data="+verb;
      complete = function(id,response)
      {
       var d = Y.JSON.parse(response.responseText);
       
       for(var i=0;i<d.length;i++)
       {
        if(Y.Lang.isNull(d[i].brand))
        {
         d[i].brand = 'BLANK';
        }
        
        var newNodeObja = {type:'Text',label:d[i].brand,isLeaf:false,editable:true,archiveHierarchy:["alpha_catalogs","stylesbybrand"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();
      };
      break;
      case 'styles':
      case 'stylesbypage':
      case 'stylesbybrand':
      if(hierarchy[1] == 'stylesbypage')
      {
      var filters = 
      [
      {"attribute":"season","value":node.parent.parent.parent.label,"operator":"="},
      {"attribute":"catalog_name","value":node.parent.parent.label,"operator":"="},
      {"attribute":"page","value":node.label=="BLANK"? "":node.label,"operator":"="}
      ];
      }
      else if(hierarchy[1] == 'stylesbybrand')
      {
      var filters = 
      [
      {"attribute":"season","value":node.parent.parent.parent.label,"operator":"="},
      {"attribute":"catalog_name","value":node.parent.parent.label,"operator":"="},
      {"attribute":"brand","value":node.label,"operator":"="}
      ]; 
      }
      else
      {
      var filters = 
      [{"attribute":"season","value":node.parent.parent.label,"operator":"="},
      {"attribute":"catalog_name","value":node.parent.label,"operator":"="}];
      }
      var verb = encodeURIComponent(Y.JSON.stringify({"filters":filters,"attributes":["style"],"groupby":"TRUE","sort":[["style","asc"]]}));
      
      var url = "/alpha_catalogs/?data="+verb;
      complete = function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObja = {type:'Text',label:d[i].style,isLeaf:true,editable:true,archiveHierarchy:["alpha_catalogs","style"]};
        var na = new YUI2.widget.TextNode(newNodeObja, node, false);
       }       
       fnLoadComplete();
       };
      
      break;      
     }    
    break;
    case 'alpha_assets':return;
    break;
    case 'alpha_reports':return;
    break;
   }
        
   Y.io("archive"+url,{
     headers: {'Content-Type': 'application/json'},
     on:{
      success:complete,
      failure:function(id,response){
       fnLoadComplete();
      }
     }
   });
      
   };

 var oCurrentProductNode = null;
 productTree = new YUI2.widget.TreeView('productsTree');
 productTree.setDynamicLoad(loadProductData);
 
 var assignProduct = function(o){
  
  return;
 };
  
 
   
   var productBrandsObj = {type:'Text',label:'All Brands',isLeaf:false,editable:true,archiveHierarchy:["alpha_styles","allbrands"]};
   var productBrandsNode = new YUI2.widget.TextNode(productBrandsObj, productTree.getRoot(), false);
   
   var productStylesObj = {type:'Text',label:'All Styles',isLeaf:false,editable:true,archiveHierarchy:["alpha_styles","allstyles"]};
   var productStylesNode = new YUI2.widget.TextNode(productStylesObj, productTree.getRoot(), false);
   productTree.draw();
   var currentTextNode = null;
   var onTriggerContextMenu = function(p_oEvent){
  var oTarget = this.contextEventTarget;
  
  var node = productTree.getNodedByElement(oTarget);
  if(!node){this.cancel();return;}
  var nodeData = node.data;
   var hierarchy = nodeData.archiveHierarchy;
   
   switch(hierarchy[0])
   {
   case 'alpha_colors':
   switch(hierarchy[1])
   {
    case 'colorsbystyle':
    currentTextNode = node;
    break;
   }
   break;
   default:
   this.cancel();
   currentTextNode = null;
   break;
   }
   return;  
 };
 var productContextMenu = new YUI2.widget.ContextMenu('productContentMenu',{
   trigger:'productTree-'+productId,
   lazyload:true,
   zindex:100000
  }
 );
 var productContextMenuSelected = function(){
  if(Y.Lang.isNull(currentTextNode)){
   
  }else
  {
  var style = currentTextNode.label;
   var season = this.value.season;
   var catalog_name=this.value.catalog_name;
   var zone = this.value.zone;
   var putRecord = {
    season:season,catalog_name:catalog_name,page:"0",style:style
   };
  var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "filters":[
       {"attribute":"abstyle","value":currentTextNode.label,"operator":"="}
       ],
       }));
   var url = "alpha_styles/?data="+verb;
      complete = function(id,response)
      {              
       var d = Y.JSON.parse(response.responseText);
       var rec = d[0];
       
       putRecord.style = rec.abstyle;
       putRecord.companionstyle = rec.companionladies+','+rec.companiontall+','+rec.companionyouth;
       putRecord.brand = rec.brand;
       putRecord.style_status = rec.usstatus;
       putRecord.short_description = rec.styledescription;
       putRecord.long_description = rec.mainstyleattributes;
       putRecord.sub_description = rec.subattributes;
       putRecord.gender = rec.gender;
       putRecord.womens_fit = rec.garmentfit;
       putRecord.earth_friendly = rec.earthfriendly;
       putRecord.b2b_category = rec.category;
       switch(zone)
       {
       case "USA":
       putRecord.catalog_color_group = rec.stylecolorgroup;
       putRecord.size_group = rec.stylesizegroupus;
       putRecord.b2b_size_group = rec.stylesizeus;
       break;
       case 'CDNENG':
       putRecord.catalog_color_group = rec.stylecolorgroupcdn;
       putRecord.size_group = rec.stylesizegroupcdn;
       putRecord.b2b_size_group = rec.stylesizecdn;
       break;
       case 'CDNFRE':
       putRecord.catalog_color_group = rec.stylecolorgroupcdn;
       putRecord.size_group = rec.stylesizegroupfre;
       putRecord.b2b_size_group = rec.stylesizefre;
       putRecord.short_description = rec.styledescriptionfre;
       putRecord.long_description = rec.mainstyleattributesfre;
       putRecord.sub_description = rec.subattributesfre;
       break;
       }
       
       var verb = encodeURIComponent(Y.JSON.stringify(putRecord));
       var url = "archive/alpha_catalogs/";
       $.ajax({
        type:'PUT',dataType:'json',headers: {'content-type': 'application/json'},
        data:Y.JSON.stringify(putRecord),
        url:url,success:function(o){
         
        }
       });
       
       
             
      };
         
   Y.io("archive/"+url,{
    headers: {'Content-Type': 'application/json'},
     on:{
      success:complete,
      failure:function(id,response){
       
      }
     }
   });
  }
 };
 
 var contextSuccess = function(id,response)
      {
       var d = Y.JSON.parse(response.responseText);
       var menudata = {"USA":[],"CDNEng":[],"CDNFre":[]};
       for(var i=0;i<d.length;i++)
       {       
        if(!Y.Lang.isArray(menudata.USA[d[i].season])){
         menudata.USA[d[i].season] = [];
         menudata.CDNEng[d[i].season] = [];
         menudata.CDNFre[d[i].season] = [];
        }
        menudata.USA[d[i].season].push({text:d[i].catalog_name,value:{season:d[i].season,"catalog_name":d[i].catalog_name,"zone":"USA"},onclick:{fn:productContextMenuSelected}});
        menudata.CDNEng[d[i].season].push({text:d[i].catalog_name,value:{season:d[i].season,"catalog_name":d[i].catalog_name,"zone":"CDNENG"},onclick:{fn:productContextMenuSelected}});
        menudata.CDNFre[d[i].season].push({text:d[i].catalog_name,value:{season:d[i].season,"catalog_name":d[i].catalog_name,"zone":"CDNFRE"},onclick:{fn:productContextMenuSelected}});            
       }
       
       var contextContent = [];       
       for(var y in menudata)
       {
        var zone = menudata[y];
        
        var rec = {
         text:y,
         id:"productcontext-"+y,
         submenu:{id:"productcontext-"+y+"-sub",itemdata:[]}
        };        
        
        for(var x in zone)
        {
         var item = {text:x,submenu:{id:"productcontext-"+y+"-"+x+"sub",itemdata:zone[x]}};
         rec.submenu.itemdata.push(item);                  
        }
        
        contextContent.push(rec);                
       }
              
       productContextMenu.addItems(contextContent);
       productContextMenu.render(document.body);       
       
      };
 var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["season","catalog_name"],"groupby":"true","sort":[["season","asc"],["catalog_name","asc"]]}));
   Y.io("archive/alpha_catalogs/?data="+verb,{
    headers: {'Content-Type': 'application/json'},
     on:{
      success:contextSuccess,
      failure:function(id,response){
       
      }
     }
   });
 
 
 
 
 
 productContextMenu.subscribe("triggerContextMenu",onTriggerContextMenu);
   
   
   
 var productTreeEdited = function(oArgs)
 {
    var oldVal = oArgs.oldValue;
    var newVal = oArgs.newValue;
    var node = oArgs.node;
    
   var nodeData = node.data;
   var hierarchy = nodeData.archiveHierarchy;
   
   switch(hierarchy[0])
   {
   case 'alpha_styles':
     switch(hierarchy[1])
     {
      case 'brands':
      var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "attributes":[{"attribute":"brand","value":newVal}],
       "filters":[{"attribute":"brand","value":oldVal,"operator":"="}],
       }));
     var url = "/alpha_styles/";
     complete = function(id,response){var d = Y.JSON.parse(response.responseText);};    
      break;
      case 'categories':
       
      break;
      case 'stylesbycategory':
      var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "attributes":[{"attribute":"category","value":newVal}],
       "filters":[
       {"attribute":"brand","value":node.parent.parent.label,"operator":"="},
       {"attribute":"category","value":oldVal,"operator":"="}
       ],
       }));
      var url = "/alpha_styles/";
      complete = function(id,response)
      {
       var d = Y.JSON.parse(response.responseText);
      };
      break;
     } 
    break;
    case 'alpha_colors':
     switch(hierarchy[1])
     {
      case 'colorsbystyle':
       
       var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "attributes":[{"attribute":"abstyle","value":newVal}],
       "filters":[
       {"attribute":"abstyle","value":oldVal,"operator":"="}
       ],
       }));
      var url = "/alpha_styles/";
      complete = function(id,response)
      {
       var d = Y.JSON.parse(response.responseText);
      };
       
      break;
      case 'colorname':
      var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "attributes":[{"attribute":"colorname","value":newVal}],
       "filters":[
       {"attribute":"abstyle","value":node.parent.label,"operator":"="},
       {"attribute":"colorname","value":oldVal,"operator":"="},
       ],
       }));
      var url = "/alpha_colors/";
      complete = function(id,response)
      {
       var d = Y.JSON.parse(response.responseText);
      };
      break;
     }
    break; 
    case 'alpha_catalogs':
   
    console.log('catalogtree');
    
    return;
     break;
    case 'alpha_assets':return;
    
    break;
    case 'alpha_reports':return;
    
    break;
   }
    Y.io("archive"+url,{
       method:'POST',
       data:verb,
     headers: {'Content-Type': 'application/json'},
     on:{
      success:complete,
      failure:function(id,response){
       
      }
     }
   });
   };
      
   
  productTree.subscribe("dblClickEvent",productTree.onEventEditNode);
  productTree.subscribe("editorSaveEvent",productTreeEdited);
  productTree.subscribe("clickEvent",productTree.onEventToggleHighlight);
  var productEditor = new $.fn.dataTable.Editor(
   {   
    idSrc:  'abstyleid', 
    display:'bootstrap',
    table:'#productTable-'+productId,
    ajax:{
     create :{
      type:"PUT",
      url:"archive/alpha_styles/",contentType:'application/json',
      data:function(json){
      return Y.JSON.stringify(json.data);
     }
     },
     edit:{
      type:"POST",
      url:"archive/alpha_styles/",
      contentType:'application/json',
      data:function(json){
       var rec = {};
       var abStyleId,field,value;
       for(var i in json.data)
       {
        abStyleId = i;
        for(var y in json.data[i])
        {
         field = y;
         value = json.data[i][y];
        }
       }
       var verb = Y.JSON.stringify(
        {"attributes":[{"attribute":field,"value":value}],
        "filters":[{"attribute":"abstyleid","value":abStyleId,"operator":"="}]});
       
       return verb;
      }
      
     },
     remove:{
      type:"DELETE",
      url:"archive/alpha_styles/_id_",
      data:function(json)
      {
      
       
       
      },
      contentType:'application/json'
     }
    },
    fields:[
    {"name":"abstyle","label":'ABStyle',"type":"text"},
    {"name":"millstyle","label":'MillStyle',"type":"text"},
    {"name":"stylefamily","label":'StyleFamily',"type":"text"},
    {"name":"brand","label":'Brand',"type":"text"},
    {"name":"category","label":'Category',"type":"select",options:['Accessories','Bags','Bottoms','Fleece','Hats','Kids','Knits_Layering','Outerwear','Polos','Sweaters','Sweatshirts','T_Shirts','Wovens']},
    {"name":"subcategory","label":'Sub-Category'},
    {"name":"usstatus","label":'US-Status',"type":"select",options:['New','Active','Mill Drop','AB Drop','Not Available']},
    {"name":"cdnstatus","label":'CDN-Status',"type":"select",options:['New','Active','Mill Drop','AB Drop','Not Available']},
    {"name":"gender","label":'Gender'},
    {"name":"styleheadline","label":'Style-Headline',"type":"textarea"},
    {"name":"styledescription","label":'Style-Description',"type":"textarea"},
    {"name":"mainstyleattributes","label":'Main-Style-Attributes',"type":"textarea"},
    {"name":"subattributes","label":'Sub-Attributes',"type":"textarea"},
    {"name":"earthfriendly","label":'Earth-Friendly',type:"select",options:['Y','N']},
    {"name":"garmentfit","label":'Garment-Fit',"type":"select",options:["Active","Athletic","Classic","Junior","Missy","Modern","N/A","Perfect","Relaxed","Tall"]},
    {"name":"icons","label":'Icons',"type":"textarea"},
    {"name":"companionladies","label":'Companion-Ladies'},
    {"name":"companiontall","label":'Companion-Tall'},
    {"name":"companionyouth","label":'Companion-Youths'},
    {"name":"stylecolorgroup","label":'Style-Color-Group',"type":"textarea"},
    {"name":"stylesizeus","label":'Style-Size'},
    {"name":"stylesizegroupus","label":'Style-Size-Group'},
    {"name":"colorname","label":'Color-Name'},
    {"name":"styledescriptionofchange","label":'Style-Changes',"type":"textarea"}
    ]
   }
  );
  $('#productTable-'+productId).on('dblclick','tbody td:not(:first-child)', function (e)
  {
         productEditor.bubble( this );
        });
        
  productDt = $('#productTable-'+productId).DataTable(
   {
    dom: "<'row'<'col-sm-3'B><'col-md-5'p><'col-sm-3'l>><'row'<'col-md-6'i><'col-md-4'f>><'row'<'col-md-12't>>",
    lengthMenu:[5,10,50,100],
    scrollY:contentHeight-160,
    scrollX:contentWidth-80,
    paging:true,
    processing:true,
    autowidth:false,
    deferRender: true,
    select:{style:'single',items:'row',blurable:false},
    fixedColumns:  {leftColumns: 1},
    idSrc:"abstyleid",
   "columns":[
   {"data":"abstyle","width":"30px"},
   {"data":"millstyle","width":"30px"},
   {"data":"stylefamily","width":"30px"},
   {"data":"brand","width":"50px"},
   {"data":"category","width":"75px"},
   {"data":"subcategory","width":"75px"},
   {"data":"usstatus","width":"75px"},
   {"data":"cdnstatus","width":"75px"},
   {"data":"gender","width":"75px"},
   {"data":"styleheadline","width":"75px"},
   {"data":"styledescription","width":"350px"},
   {"data":"mainstyleattributes","width":"350px"},
   {"data":"subattributes","width":"350px"},
   {"data":"earthfriendly","width":"75px"},
   {"data":"garmentfit","width":"75px"},
   {"data":"icons","width":"75px"},
   {"data":"companionladies","width":"75px"},
   {"data":"companiontall","width":"75px"},
   {"data":"companionyouth","width":"75px"},
   {"data":"stylecolorgroup","width":"75px"},
   {"data":"stylesizeus","width":"75px"},
   {"data":"stylesizegroupus","width":"75px"},
   {"data":"colorname","width":"75px","defaultContent":"","visible":false},
   {"data":"styledescriptionofchange","width":"150px"},
   {"data":"stylecreatedon","width":"75px"},
   {"data":"styleupdatedon","width":"75px"}],
   "columnDefs":[],
   "order":[[0,'asc']],
   buttons: [
        { extend: 'create', editor: productEditor },
        { extend: 'edit',   editor: productEditor },
        { extend: 'remove', editor: productEditor }
    ]
  }); 

 var treeExpanded = function(node){ 
    
   var nodeData = node.data;
   var hierarchy = nodeData.archiveHierarchy;
     
   switch(hierarchy[0])
   {
   case 'alpha_styles':
     switch(hierarchy[1])
     {
      case 'allbrands':return;
      break;
      case 'allstyles':
       return;
     var url = "/alpha_styles/";
     complete = function(id,response){
      var d = Y.JSON.parse(response.responseText);
      productDt.rows.add(d).draw();
      /*for(var i = 0;i<d.length;i++)
      {
      
      productDt.row.add(d[i]).draw(); 
      }*/
     }; 
      break;
      case 'brands':
      var nodes = productTree.getNodesByProperty('expanded',true);
      for(var i = 0;i<Expandednodes.length;i++)
      {
       var n = nodes[i];
       
      }
      
      productDt.column(3).search(node.label).draw();
    
      return;
      var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "filters":[{"attribute":"brand","value":node.label,"operator":"="}],
       }));
     var url = "/alpha_styles/?data="+verb;
     complete = function(id,response){
      var d = Y.JSON.parse(response.responseText);
      productDt.rows.add(d).draw();
      /*for(var i = 0;i<d.length;i++)
      {
      
      productDt.row.add(d[i]).draw(); 
      }*/
     };    
      break;
      case 'categories':
       return;
      break;
      case 'stylesbycategory':
       productDt.search(node.label).draw();return;
      break;
      case 'stylesbybrand':
       productDt.search(node.parent.label).draw();return;
      break;
     } 
    break;
    case 'alpha_colors':
     switch(hierarchy[1])
     {
      case 'colorsbystyle':
       productDt.search(node.label).draw();return;
      break;
      case 'colorname':
      return;
      break;
     }
    break; 
    case 'alpha_catalogs':
     //console.dir(hierarchy);
     switch(hierarchy[1])
     {
      case 'seasons':
      return;
      break;
      case 'catalog':
        /*Note: ADD Rows*/
       var verb = encodeURIComponent(Y.JSON.stringify(
       {
       "filters":[{"attribute":"catalog_name","value":node.label,"operator":"="}],
       }));
     var url = "/alpha_catalogs/?data="+verb;
     complete = function(id,response){
      var d = Y.JSON.parse(response.responseText);
      catalogDt.rows.add(d).draw();
      /*(for(var i = 0;i<d.length;i++)
      {
      
      catalogDt.row.add(d[i]).draw(); 
      }*/
     };
      break;
      case 'stylesbypage':
       catalogDt.column(3).search(node.label).draw();
      return;
      break;
      case 'stylesbybrand':
       catalogDt.column(7).search(node.label).draw();
      return;
      break;
      default:
      return;
      break; 
     }
       
    break;
    case 'alpha_assets':return;
    
    break;
    case 'alpha_reports':return;
    
    break;
   }
    Y.io("archive"+url,{
       method:'GET',
     headers: {'Content-Type': 'application/json'},
     on:{
      success:complete,
      failure:function(id,response){
       
      }
     }
   });
   
   
  
 }; 
  productTree.subscribe("expand",treeExpanded);
  var productTreeCollapsed = function(node){
 
    
   var nodeData = node.data;
   var hierarchy = nodeData.archiveHierarchy;
   var data = productDt.data;
   var rows = [];
   switch(hierarchy[0])
   {
   case 'alpha_styles':
     switch(hierarchy[1])
     {
      case 'brands':
      productDt.column(3).search("").draw();
      productDt.search("").draw();
      return;
       var count = 0;
       productDt.data().each(function(d)
       {
        if(data.brand === node.label){
         productDt.row(count).invalidate();
        }
        
        count++; 
       });
       productDt.rows(function(idx,data,trnode){
        
        return data.brand === node.label ? this : null;
       }).remove();
       
       productDt.draw();
       
      break;
      case 'categories':
       productDt.search("").draw();
       return;
      break;
      case 'stylesbycategory':
       productDt.search("").draw();
      break;
     } 
    break;
    case 'alpha_colors':
     switch(hierarchy[1])
     {
      case 'colorsbystyle':
              
      break;
      case 'colorname':
      
      break;
     }
    break; 
    case 'alpha_catalogs':
    //console.dir(hierarchy);
     switch(hierarchy[1])
     {
      case 'seasons':
      
      catalogDt.data().each(function(d)
       {
        if(data.season === node.label){
         productDt.row(count).invalidate();
        }
        
        count++; 
       });
       catalogDt.rows(function(idx,data,trnode){
        
        return data.season === node.label ? this : null;
       }).remove();
       
       catalogDt.draw();
      
      break;
      case 'catalog':
      
       catalogDt.data().each(function(d)
       {
        if(data.catalog_name === node.label){
         productDt.row(count).invalidate();
        }
        
        count++; 
       });
       catalogDt.rows(function(idx,data,trnode){
        
        return data.catalog_name === node.label ? this : null;
       }).remove();
       
       catalogDt.draw();
      
      break;
      case 'stylesbypage':
       catalogDt.column(3).search("").draw();
      return;
      break;
      case 'stylesbybrand':
       catalogDt.column(7).search("").draw();
      return;
      break;
      case 'seasons':
      break;
      case 'stylesbybrand':
      break;
      default:
      return;
      break;
      
     }
    
    
    return;
    
    break;
    case 'alpha_assets':return;
    
    break;
    case 'alpha_reports':return;
    
    break;
   }   
  
 };  
 productTree.subscribe("collapse",productTreeCollapsed); 
 catalogTree = new YUI2.widget.TreeView('catalogTree-'+catalogId);
 catalogTree.setDynamicLoad(loadProductData);
 catalogTree.subscribe("expand",treeExpanded);
 var catalogEditor = new $.fn.dataTable.Editor(
   {   
    idSrc:  'assetid', 
    display:'bootstrap',
    table:'#catalogTable-'+catalogId,
    ajax:{
    create :{
      type:"PUT",
      url:"archive/alpha_catalogs/",contentType:'application/json',
      data:function(json){
      return Y.JSON.stringify(json.data);
     }
     },
     edit:{
      type:"POST",
      url:"archive/alpha_catalogs/",
      contentType:'application/json',
      data:function(json){
       var rec = {};
       var assetId,field,value;
       for(var i in json.data)
       {
        assetId = i;
        for(var y in json.data[i])
        {
         field = y;
         value = json.data[i][y];
        }
       }
     var verb = Y.JSON.stringify({
      "attributes":[{"attribute":field,"value":value}],
      "filters":[{"attribute":"assetid","value":assetId,"operator":"="}]
       });
       
       return verb;
      }
     },
     remove:{
      type:"DELETE",
      url:"archive/alpha_catalogs/_id_",
      contentType:'application/json'
     }},
    fields:[
    {"name":"style","label":'Style',"type":"text"},
    {"name":"brand","label":'Brand',"type":"text"},
    {"name":"page","label":'Page',"type":"text"},
    {"name":"companionstyle","label":'CompanionStyles',"type":"textarea"},
    {"name":"companioncopy","label":'Companion Copy',"type":"textarea"},
    {"name":"b2b_category","label":'Category',"type":"select",options:['Accessories','Bags','Bottoms','Fleece','Hats','Kids','Knits_Layering','Outerwear','Polos','Sweaters','Sweatshirts','T_Shirts','Wovens']},
    {"name":"style_status","label":'Status',"type":"select",options:['New','Active','Mill Drop','AB Drop','Not Available']},
    {"name":"short_description","label":'Style-Description',"type":"textarea"},
    {"name":"long_description","label":'Main-Style-Attributes',"type":"textarea"},
    {"name":"sub_description","label":'Sub-Attributes',"type":"textarea"},
    {"name":"gender","label":'Gender',type:"select",options:['Men\'s','Ladies\'','Youth','Adult']},
    {"name":"womens_fit","label":'Garment-Fit',"type":"select",options:["Active","Athletic","Classic","Junior","Missy","Modern","N/A","Perfect","Relaxed","Tall"]},
    {"name":"earth_friendly","label":'Earth-Friendly',type:"select",options:['Y','N']},
    {"name":"catalog_color_group","label":'Style-Color-Group',"type":"textarea"},
    {"name":"price","label":'Price',"type":"text"},
    {"name":"size_group","label":'Style-Size-Group',"type":"textarea"},
    {"name":"b2b_size_group","label":'B2b-Size-Group',"type":"textarea"}
    ]
   }
  );
  
  $('#catalogTable-'+catalogId).on('dblclick','tbody td:not(:first-child)', function (e)
  {
         catalogEditor.bubble( this );
        });
 catalogDt = $('#catalogTable-'+catalogId).DataTable(
   {
    dom: "<'row'<'col-sm-3'B><'col-md-5'p><'col-sm-3'l>><'row'<'col-md-6'i><'col-md-4'f>><'row'<'col-md-12't>>",
    lengthMenu:[5,10,50,100],
    scrollY:contentHeight-140,
    scrollX:contentWidth-30,
    paging:true,
    processing:true,
    deferRender: true,
    select:{style:'single',items:'row',blurable:false},
    fixedColumns:  {leftColumns: 2},
    idSrc:"assetid",
   "columns":[
   {"data":"assetid","visible":false},
   {"data":"season",width:25},
   {"data":"catalog_name",width:25},
   {"data":"page",width:25},
   {"data":"style",width:25},
   {"data":"companionstyle",width:25},
   {"data":"companioncopy",width:25},
   {"data":"brand",width:25},
   {"data":"style_status",width:25},   
   {"data":"short_description",width:"300px"},
   {"data":"long_description",width:"300px"},
   {"data":"sub_description",width:"300px"},
   {"data":"gender",width:25},
   {"data":"womens_fit",width:25},
   {"data":"earth_friendly",width:25},   
   {"data":"b2b_category",width:25},
   {"data":"catalog_color_group",width:25},
   {"data":"price",width:25},
   {"data":"size_group",width:25},
   {"data":"b2b_size_group",width:25},
   {"data":"abdatecreated",width:25},
   {"data":"abdateupdated",width:25},{"data":"lastuser",width:25}],
   buttons: [
        { extend: 'edit',   editor: catalogEditor },
        { extend: 'remove', editor: catalogEditor }
    ]
  });
 
 
  var verb = encodeURIComponent(Y.JSON.stringify({"attributes":["season"],"groupby":"true","sort":[["season","asc"]]}));
   Y.io("archive/alpha_catalogs/?data="+verb,{
    headers: {'Content-Type': 'application/json'},
     on:{
      success:function(id,response){
       var d = Y.JSON.parse(response.responseText);
       for(var i=0;i<d.length;i++)
       {
        var newNodeObj = {type:'Text',label:d[i].season,isLeaf:false,editable:true,archiveHierarchy:["alpha_catalogs","seasons"]};
        var n = new YUI2.widget.TextNode(newNodeObj, catalogTree.getRoot(), false);        
       }       
       catalogTree.draw();
      },
      failure:function(id,response){
       catalogTree.draw();
      }
     }
   }); 
 catalogTree.subscribe("dblClickEvent",catalogTree.onEventEditNode);
 catalogTree.subscribe("editorSaveEvent",productTreeEdited);
 catalogTree.subscribe("collapse",productTreeCollapsed);
 
 var initComplete = function(id,response){
      var d = Y.JSON.parse(response.responseText);
      productDt.rows.add(d).draw();
      /*for(var i = 0;i<d.length;i++)
      {
      
      productDt.row.add(d[i]).draw(); 
      }*/
     };
 Y.io("archive/alpha_styles/",{
       method:'GET',
     headers: {'Content-Type': 'application/json'},
     on:{
      success:initComplete,
      failure:function(id,response)
      {
       
      }
     }
   });  
  
 };
  
  tv.after("render", afterRender);
  tv.render('#archivesrcnode');
 });
  </script>
  
 </body>
</html>

