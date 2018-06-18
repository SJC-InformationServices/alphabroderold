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
      <div class="row flex-nowrap">
        <div class="col col-2" id="productsTreeContent">
          <div id="productsTree"></div>
        </div>
        <div class="col col" id="productsTableContent">
          <table id="productsTable" class="table table-condensed table-striped table-bordered table-hover table-compact ">

          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="profile-tab">
  <div class="container-fluid">
      <div class="row flex-nowrap">
        <div class="col-md-2 col-12" id="projectsTreeContent">
           <div id="projectsTree"></div>
        </div>
        <div class="col-md-10 col-12" id="projectsTableContent">
        <table id="projectsTable" class="table table-condensed table-striped table-bordered table-hover table-compact ">
        </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="contact-tab">
  <div class="container-fluid">
      <div class="row flex-nowrap">
        <div class="col-md2 col-12" id="attachmentsTreeContent">
          <div id="attachmentsTree"></div>
        </div>
        <div class="col-md2 col-12" id="attachmentsTableContent">
        <table id="attachmentsTable" class="table table-condensed table-striped table-bordered table-hover table-compact ">
        </table>
        </div>
      </div>
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
  
 Y.io.header('Content-Type', 'application/json'); 
 
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
  
  var projectcols = [
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
  var attachmentscols = [
    'id','name'
  ];
var productsTree,projectsTree,attachmentsTree;
  var productsTableElement = Y.one("#productsTable");
  productsTableElement.appendChild(Y.Node.create('<th>'+productcols.join("</th><th>")));

  var projectsTableElement = Y.one("#projectsTable");
  projectsTableElement.appendChild(Y.Node.create('<th>'+projectcols.join("</th><th>")));

 var attachmentsTableElement = Y.one("#attachmentsTable");
 attachmentsTableElement.appendChild(Y.Node.create('<th>'+attachmentscols.join("</th><th>")));

var stylesActions = {"allbrands":[]};
var productActions = {};
var attachmentsActions = {};

var loadTree=function() {

};
var activeNode = null;

productTree = new YUI2.widget.TreeView('productsTree');
productTree.setDynamicLoad(loadTree);

var productBrandsObj = {
  type: 'Text',
  label: 'All Brands',
  isLeaf: false,
  editable: true,
  archiveHierarchy: ["styles", "allbrands"]
};
var productBrandsNode = new YUI2.widget.TextNode(productBrandsObj, productTree.getRoot(), false);

var productStylesObj = {
  type: 'Text',
  label: 'All Styles',
  isLeaf: false,
  editable: true,
  archiveHierarchy: ["alpha_styles", "allstyles"]
};
var productStylesNode = new YUI2.widget.TextNode(productStylesObj, productTree.getRoot(), false);
productTree.draw();


}
);
  </script>
  
 </body>
</html>

