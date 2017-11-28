{*
	--------------------------------------------------------------------------------------------------------------
	iDevAffiliate HTML Front-End Template
	--------------------------------------------------------------------------------------------------------------
	Theme Name: Default Theme
	--------------------------------------------------------------------------------------------------------------
	Custom Page Instructions
	------------------------

	You can get to this page in the affiliate control panel here: /account.php?action=30

	You really don't want to "hard code" any text into this page because using language packs will become useless.
	In your admin center, create a "Custom Language Token" and use that token instead.

	There is already a sample token provided for this page.

		{$custom_page_header}

	You can see it being used below.
	Change, remove or create new tokens as you wish.
	------------------------
*}

<div class="page-header title">
<h1 style="color:{$heading_text};">{$custom_link_stats}</h1>
</div>

<div class="row">
<div class="col-md-12">
<div class="portlet" style="border-color:{$portlet_3};">
<div class="portlet-heading" style="background:{$portlet_3};"><div class="portlet-title" style="color:{$portlet_3_text};"><h4>{$choose_marketing_group}</h4></div></div>
<div class="portlet-body">
					
<form class="form-horizontal" role="form" method="post" action="account.php">
<input type="hidden" name="page" value="7">
<div class="form-group">
<label class="col-sm-3 control-label">{$marketing_group_title}</label>
<div class="col-sm-6">
<select name="banner_picked" class="form-control">
{section name=nr loop=$banner_results}
<option value="{$banner_results[nr].banner_group_id}">{$banner_results[nr].banner_group_name}</option>
{/section}
</select>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-6">
<button type="submit" class="btn btn-primary">{$marketing_button} {$menu_banners}</button>
</div>
</div>
</form>

</div>
</div>
</div>
</div>


{if isset($banner_group_chosen)}

{section name=nr loop=$banner_link_results}

<div class="row">
<div class="col-md-12">
<div class="portlet" style="border-color:{$portlet_4};">
<div class="portlet-heading" style="background:{$portlet_4};"><div class="portlet-title" style="color:{$portlet_4_text};"><h4>{$marketing_group_title}: {$banner_chosen_group_name}</h4></div></div>
<div class="portlet-body">

<ul class="list-group">
<li class="list-group-item"><label>{$banners_size}:</label> {$banner_link_results[nr].banner_size_1} x {$banner_link_results[nr].banner_size_2}</li>
<li class="list-group-item"><label>{$banners_description}:</label> {$banner_link_results[nr].banner_description}</li>
<li class="list-group-item"><label>{$marketing_target_url}:</label> <a href="{$banner_link_results[nr].banner_target_url}" target="_blank">{$banner_link_results[nr].banner_target_url}</a></li>
<li class="list-group-item"><label style="width:100%;">{$banner_link_results[nr].banner_display}<br/><br/>{$marketing_source_code}</label><br/><textarea rows="4" class="form-control">{$banner_link_results[nr].banner_code}</textarea></li>
</ul>

</div>
</div>
</div>
</div>

{/section}

{/if}
