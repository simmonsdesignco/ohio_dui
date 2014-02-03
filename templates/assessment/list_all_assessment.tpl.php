<?php
/**
 * @file
 * list_all_assessment.tpl.php
 */

// function defined to load the content type third party request
$val = get_all_assessment();
//print_r($val);
//echo $val[0]->nid;
$nid_array = array();
foreach ($val as $data) {
  $nid_array[] = $data->nid;
}

//  load the node data
$result = node_load_multiple($nid_array);
//dpm($result);
?>

<div class="table_wrap">
  <table class="schedule_table">
    <tr class="bkg_b">
      <th>Assessment Details</th>
      <th> Rush Order Services <br />
        <div class="subcontent">
          <div class="subcontent-left" style="width: 45%;"> Title </div>
          <div class="subcontent-left"> Cost </div>
          <div class="subcontent-right"> Status </div>
        </div>
      </th>
      <th>Online Questionnaire?</th>
      <th>Action</th>
    </tr>
    <?php $total_count = count($result);
    foreach($result as $rec) {
      $service_title = $rec->title;
      $service_tid = $rec->field_primary_service['und'][0]['tid'];
      $service_status = $rec->field_assessment_status['und'][0]['value'];
      $questionnaire = $rec->field_online_questionnaire['und'][0]['value'];
    ?>
    <tr>
      <td>
      <?php print $service_title . '<br>';
        print '<b>Cost:</b> $' . get_service_amount($service_tid) . '<br>';
        print '<b>Status:</b> ' . $service_status; ?>
      </td>

      <td>
      <?php
      if (isset($rush_one_title)) { ?>
        <div class="subcontent">
          <div class="subcontent-left" style="width: 60%;">
            <?php print $rush_one_title; ?>
          </div>
          <div class="subcontent-left">
            <?php print '$'.get_service_amount(
              $rec->field_rush_order_service_one['und'][0]['tid']
            ); ?>
          </div>
          <div class="subcontent-right">
            <?php
              print $rec->field_rush_order_status_one['und'][0]['value']; ?>
          </div>
        </div>
        <br>
      <?php } ?>
      <?php
      if (isset($rush_two_title)) { ?>
        <div class="subcontent">
          <div class="subcontent-left" style="width: 60%;">
            <?php print $rush_two_title; ?>
          </div>
          <div class="subcontent-left">
            <?php print '$'.get_service_amount(
              $rec->field_rush_order_service_two['und'][0]['tid']
            ); ?>
          </div>
          <div class="subcontent-right">
            <?php
              print $rec->field_rush_order_status_two['und'][0]['value']; ?>
          </div>
        </div>
        <br>
      <?php } ?>
      <?php if (isset($rush_three_title)) { ?>
        <div class="subcontent">
          <div class="subcontent-left" style="width: 60%;">
            <?php print $rush_three_title; ?>
          </div>
          <div class="subcontent-left">
            <?php print '$'.get_service_amount(
              $rec->field_rush_order_service_three['und'][0]['tid']
            ); ?>
          </div>
          <div class="subcontent-right">
            <?php
              print $rec->field_rush_order_status_three['und'][0]['value']; ?>
          </div>
        </div>
        <br>
      <?php } ?>
      <?php if (isset($rush_four_title)) { ?>
        <div class="subcontent">
          <div class="subcontent-left" style="width: 60%;">
            <?php print $rush_four_title; ?>
          </div>
          <div class="subcontent-left">
            <?php print '$'.get_service_amount(
              $rec->field_rush_order_service_four['und'][0]['tid']
            ); ?>
          </div>
          <div class="subcontent-right">
            <?php
              print $rec->field_rush_order_status_four['und'][0]['value']; ?>
          </div>
        </div>
      <?php } ?>
      </td>

      <td>
      <?php print $questionnaire; ?> <br>
      <?php if ($questionnaire == 'Available') {
        print l(
          t('View Questionnaire'),
          'questionnaire/preview/'.$rec->nid.'/trans/1/uid/1'
        );
      } ?>
      </td>

      <td>
      <?php $options = array(
        'query' => array(
          'destination' => 'admin/all/assessment'
        ),
        'attributes' => array(
          'class' => 'edit_icon'
        )
      );
      print l(
        t('Edit'),
        'node/'.$rec->nid.'/edit', $options
      ); ?>
      </td>
    </tr>
  <?php }
  if($total_count <= 0) { ?>
    <tr>
      <td class="txt_ac" colspan="5">Record not found.</td>
    </tr>
    <?php } ?>
  </table>
</div>
