{*
	--------------------------------------------------------------------------------------------------------------
	iDevAffiliate HTML Front-End Template
	--------------------------------------------------------------------------------------------------------------
	Theme Name: Blue Crush
	--------------------------------------------------------------------------------------------------------------
*}

<div class="row" style="margin-top:0px;">

<div class="total-chart-area clearfix">
    <div class="col-md-3">
        <div class="transactions green" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$box_tt_back}; color:{$box_tt_text};">
            <h3>{$total_transactions} <i class="fa fa-shopping-cart"></i></h3>
            <div class="txt-cnt">{$account_total_transactions}</div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="transactions pink" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$box_ce_back}; color:{$box_ce_text};">
            <h3>{$current_total_commissions} <i class="fa fa-paperclip"></i></h3>
            <div class="txt-cnt">{$general_current_earnings}</div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="transactions brown" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$box_te_back}; color:{$box_te_text};">
            <h3>{$total_amount_earned} {$total_amount_earned_currency}<i class="fa fa-refresh fa-spin"></i></h3>
            <div class="txt-cnt">{$account_earned_todate}</div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="transactions purple visitor-sec" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$box_uv_back}; color:{$box_uv_text};">
            <h3>{$unchits}<span class="pull-right">{$perc}%</span></h3>
            <div class="txt-cnt f12 clearfix"><span class="pull-left">{$general_traffic_unique}</span><span class="pull-right">{$general_traffic_ratio}</span></div>
        </div>
    </div>
</div>
{if $none == 'done'}
<!--Note: adjusted state boxes in 3 columns width only-->
<!--<div class="col-sm-{if isset($cp_page_width)}3{else}6{/if}">-->
<!--<div class="col-sm-6 col-md-3">
<div class="widget stateBox" style="background:linear-gradient(to right, rgba(47, 47, 47, 0.41) 0%, rgba(0, 0, 0, 0) 100%), {$box_tt_back}; color:{$box_tt_text};">
<div class="body">
<div class="background-icon-right"><span class="fa fa-shopping-cart"></span></div>
<h2 class="heading">{$total_transactions}</h2>
<p style="margin-top:15px;">{$account_total_transactions}</p>
</div>
</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="widget stateBox" style="background:linear-gradient(to right, rgba(47, 47, 47, 0.41) 0%, rgba(0, 0, 0, 0) 100%), {$box_ce_back}; color:{$box_ce_text};">
<div class="body">
<div class="background-icon-right"><span class="fa fa-paperclip"></span></div>
<h2 class="heading">{$current_total_commissions}</h2>
<p style="margin-top:15px;">{$general_current_earnings}</p>
</div>
</div>
</div>-->

<!--Note: Arranging all boxes in 1 row-->
<!--
{if !isset($cp_page_width)}
</div>
<div class="row">
{/if}
-->

<!--<div class="col-sm-6 col-md-3">
<div class="widget stateBox" style="background:linear-gradient(to right, rgba(47, 47, 47, 0.41) 0%, rgba(0, 0, 0, 0) 100%), {$box_te_back}; color:{$box_te_text};">
<div class="body">
<div class="background-icon-right"><span class="fa fa-refresh fa-spin"></span></div>
<h2 class="heading">{$total_amount_earned} {$total_amount_earned_currency}</h2>
<p style="margin-top:15px;">{$account_earned_todate}</p>
</div>
</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="widget stateBox" style="background:linear-gradient(to right, rgba(47, 47, 47, 0.41) 0%, rgba(0, 0, 0, 0) 100%), {$box_uv_back}; color:{$box_uv_text};">
<div class="body">
<div class="background-icon-right"><span class="fa fa-child"></span></div>
<h2 class="heading">{$unchits}<span class="pull-right">{$perc}%</span></h2>
<p style="margin-top:15px;">{$general_traffic_unique}<span class="pull-right">{$general_traffic_ratio}</span></p>
</div>
</div>
</div>-->

{/if}

</div>

{if $linking_code == 'available'}

<div class="row">

<div class="col-md-6">
<div class="portlet" style="border-color:{$portlet_2};">
<div class="portlet-heading" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$portlet_2};"><div class="portlet-title" style="color:{$portlet_2_text};"><h4>{$progress_title} {$eligible_percent}% {$progress_complete}</h4></div></div>
<div class="portlet-body">
<div class="progress no-rounded progress-striped active">
<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{$eligible_percent}" aria-valuemin="0" aria-valuemax="100" style="width: {$eligible_percent}%"></div>
</div>
{$eligible_info}
</div>
</div>
</div>

<div class="col-md-6">
<div class="portlet" style="border-color:{$portlet_2};">
<div class="portlet-heading" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$portlet_2};"><div class="portlet-title" style="color:{$portlet_2_text};"><h4>{$account_standard_linking_code}</h4></div></div>
<div class="portlet-body">
<textarea rows="2" class="form-control">{$box_code}</textarea>
</div>
</div>
</div>

</div>


{/if}

<div class="row">
<div class="col-md-12">
<div class="portlet" style="border-color:{$portlet_2};">
<div class="portlet-heading" style="background:{$portlet_2};"><div class="portlet-title" style="color:{$portlet_2_text};"><h4>{$comdetails_title}</h4></div></div>
<div class="portlet-body">
<table class="table table-bordered">
<tr>
<td width="25%">{$current_comm_details}</td>
<td width="75%">{$current_style}</td>
</tr>
<tr>
<td width="25%">{$current_comm_pay}</td>
<td width="75%">{$current_level}</td>
</tr>
</table>
</div>
</div>
</div>
</div>

{*if isset($traffic_exists)*}
<div class="row">

<div class="col-md-12">
<div class="portlet" style="border-color:{$portlet_3};">
<div class="portlet-heading" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0) 100%), {$portlet_3};"><div class="portlet-title" style="color:{$portlet_3_text};"><h4>{$general_last_30_days_activity}</h4></div></div>
<div class="portlet-body">
<div id="area-affiliate"></div>
</div>
</div>
</div>
</div>

{literal}
<script type="text/javascript">

Morris.Bar({
  element: 'area-affiliate',
  data: [
    {/literal}
	{$chart_array}
	{literal}
  ],
  xkey: 'd',
  ykeys: ['a', 'b'],
  labels: ['{/literal}{$general_last_30_days_activity_traffic}{literal}', '{/literal}{$general_last_30_days_activity_commissions}{literal}']
});

</script>
{/literal}
{*/if*}

{include file='file:account_notes.tpl'}