{*
	--------------------------------------------------------------------------------------------------------------
	iDevAffiliate HTML Front-End Template
	--------------------------------------------------------------------------------------------------------------
	Theme Name: Default Theme
	--------------------------------------------------------------------------------------------------------------
*}
<!DOCTYPE HTML><html{if $language_direction == '1' } dir="rtl"{/if} lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset={$char_set}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>{$sitename} - {$header_title}</title>

	<link rel="stylesheet" href="templates/source/common/bootstrap/css/bootstrap.css">
	{if $language_direction == '1'}<link rel="stylesheet" href="templates/source/common/bootstrap/css/bootstrap-rtl.min.css">{/if}
	<link rel="stylesheet" href="templates/source/common/bootstrap/css/bootstrap-social.css">
	<link rel="stylesheet" href="templates/source/common/font-awesome/font-awesome.css">
	{if $language_direction == '1'}<link rel="stylesheet" href="templates/source/common/font-awesome/font-awesome-rtl.css">{/if}
	<link rel="stylesheet" href="templates/source/common/morris_charts/css/morris.css">
	<link rel="stylesheet" href="templates/themes/{$active_theme}/css/fonts.css">
	{if $language_direction == '1'}<link rel="stylesheet" href="templates/themes/{$active_theme}/css/style-rtl.css">
	{else}<link rel="stylesheet" href="templates/themes/{$active_theme}/css/style.css">{/if}
	<link rel="stylesheet" href="templates/source/lightbox/css/jquery.fancybox.css" />
	<link rel="stylesheet" href="templates/source/lightbox/css/video-js.css" />
	<link rel="stylesheet" href="includes/video_source/skin/functional.css" />
	<link rel="stylesheet" href="templates/source/common/pace/css/pace.css" />
    <link rel="stylesheet" href="templates/source/common/css/plugins/uniform.css" />
    <link rel="stylesheet" href="templates/source/common/css/plugins/tagsinput.css" />
    <link rel="stylesheet" href="templates/source/common/css/plugins/select2.css" />
    <link rel="stylesheet" href="templates/source/common/css/plugins/duallistbox.css" />
    <link rel="stylesheet" href="templates/source/common/css/plugins/datatables_bootstrap.css" />
    <link rel="stylesheet" href="templates/source/common/css/plugins/datatables.css" />

	<!-- jsTree CSS-->
	{if isset($internal_page) && $internal_page == 2}
		<link rel="stylesheet" href="templates/source/common/jstree/themes/default/style.min.css" />
	{/if}
	<!--[if lte IE 8]>
	<link rel="stylesheet" href="templates/source/common/css/ie-fix.css" />
	<![endif]-->
	
	<!--[if lte IE 8]>
	{literal}
	<script type="text/javascript" src="templates/source/common/js/easypiechart.ie-fix.js"></script>
	{/literal}
	<![endif]-->
	
	<!--[if lt IE 9]>
	{literal}
	<script type="text/javascript" src="templates/source/common/js/html5shiv.js"></script>
	<script type="text/javascript" src="templates/source/common/js/respond.min.js"></script>
	{/literal}
	<![endif]-->
		
	{literal}
	<script src="templates/source/lightbox/js/jquery-1.11.1.min.js"></script>
	<script src="templates/themes/{/literal}{$active_theme}{literal}/js/jquery.hc-sticky.min.js"></script>
	<script src="templates/themes/{/literal}{$active_theme}{literal}/js/css_browser_selector.js"></script>
	<script src="templates/source/lightbox/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="templates/source/lightbox/js/video.js"></script>
	<script src="templates/source/lightbox/js/jquery.fancybox.js"></script>
	<script src="templates/source/lightbox/js/jquery.fancybox-media.js"></script>
	<script src="templates/source/lightbox/js/fancy-custom.js"></script>
	<script src="includes/video_source/flowplayer.min.js"></script>
	<script src="templates/source/common/morris_charts/js/raphael-min.js"></script>
	<script src="templates/source/common/morris_charts/js/morris.js"></script>
	
    <script type="text/javascript" src="templates/source/common/plugins/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="templates/source/common/plugins/select2/select2.min.js"></script>    
    <script type="text/javascript" src="templates/source/common/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="templates/source/common/plugins/datatables/tabletools/TableTools.min.js"></script>
    <script type="text/javascript" src="templates/source/common/plugins/datatables/colvis/ColVis.min.js"></script>
    <script type="text/javascript" src="templates/source/common/plugins/datatables/DT_bootstrap.js"></script>
	
	<!-- Language variables for Datatables (Start) -->
    <script type="text/javascript">
    	var langDataTable = {};
    	langDataTable["sEmptyTable"] = "{/literal}{$lang_data_table.sEmptyTable|escape:'html'}{literal}";
		langDataTable["sInfo"] = "{/literal}{$lang_data_table.sInfo|escape:'html'}{literal}";
		langDataTable["sInfoEmpty"] = "{/literal}{$lang_data_table.sInfoEmpty|escape:'html'}{literal}";
		langDataTable["sInfoFiltered"] = "{/literal}{$lang_data_table.sInfoFiltered|escape:'html'}{literal}";
		langDataTable["sLengthMenu"] = "{/literal}{$lang_data_table.sLengthMenu|escape:'html'}{literal}";
		langDataTable["sLoadingRecords"] =  "{/literal}{$lang_data_table.sLoadingRecords|escape:'html'}{literal}";
		langDataTable["sProcessing"] = "{/literal}{$lang_data_table.sProcessing|escape:'html'}{literal}";
		langDataTable["sSearch"] = "";
		langDataTable["sZeroRecords"] = "{/literal}{$lang_data_table.sZeroRecords|escape:'html'}{literal}";
		langDataTable["sFirst"] = "{/literal}{$lang_data_table.sFirst|escape:'html'}{literal}";
		langDataTable["sLast"] = "{/literal}{$lang_data_table.sLast|escape:'html'}{literal}";
		langDataTable["sNext"] = "{/literal}{$lang_data_table.sNext|escape:'html'}{literal}";
		langDataTable["sPrevious"] = "{/literal}{$lang_data_table.sPrevious|escape:'html'}{literal}";
		langDataTable["sSortAscending"] = "{/literal}{$lang_data_table.sSortAscending|escape:'html'}{literal}";
		langDataTable["sSortDescending"] = "{/literal}{$lang_data_table.sSortDescending|escape:'html'}{literal}";
    </script>
    <!-- Language variables for Datatables (End) -->
    <script type="text/javascript" src="templates/source/common/js/dynamic_tables.js"></script>
	<script type="text/javascript" src="templates/themes/{/literal}{$active_theme}{literal}/js/custom.js"></script>
	{/literal}

	<!-- jsTree -->
	{if isset($internal_page) && $internal_page == 2}
		<script type="text/javascript" src="templates/source/common/jstree/jstree.min.js"></script>
	{/if}


</head>

<body style="background:{$background_color}; background-image: url('{$background_image}'); no-repeat; min-height: 500px; background-size: cover !important;">

	<div id="wrapper" {if $cp_fixed_left_menu == 0} class="simple-wrapper"{/if}>
    
  
	{include file='file:menu_top.tpl'}
    <div id="main-container" class="{if !isset($cp_page_width) } container {else}full-width-main-container{/if}">
    
    <div id="page-wrapper"{if !isset($cp_menu_location) || !isset($inner_page)} class="collapsed"{/if}>
    

	<div class="row {if $cp_menu_location == 1} wrapper-outer{/if}">
	
    {if $cp_menu_location == 1 } <div class="col-md-3 col-lg-2 sideBar hidden-xs {if isset($cp_fixed_left_menu)} fixed{/if}"> {/if}
    	{include file='file:menu_left_column.tpl'}
    {if $cp_menu_location == 1} </div> {/if}
		
    <div class="{if $language_direction == '1' }pull-left{else}pull-right{/if} col-xs-12 {if isset($inner_page) == 1} set1 {/if} {if $cp_menu_location == 0} navigation-at-top col-md-12 col-lg-12 set2 {else}{if isset($inner_page) == 1} contentArea col-sm-8 col-md-9 col-lg-9  set3{/if}{/if}{if isset($inner_page) != 1} set4{/if}{if isset($cp_page_width) && isset($inner_page) } fullWidth {else} fixedWidth{/if}">
    <!--
    {if $cp_menu_location == 0} navigation-at-top{/if}
    {if !isset($cp_page_width) && isset($inner_page) } col-lg-9 {else} col-lg-12{/if}
    -->
	