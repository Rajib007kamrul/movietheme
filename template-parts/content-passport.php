<?php
global $post;
$passport_name = get_post_meta($post->ID,'passport_name',true);
$passport_number = get_post_meta($post->ID,'passport_number',true);
$passport_comment = get_post_meta($post->ID,'passport_comment',true);
$passport_service = get_post_meta($post->ID,'passport_service',false);
$passport_gender = get_post_meta($post->ID,'passport_gender',true);
$passport_area = get_post_meta($post->ID,'passport_area',false);

?>
<tr>
  <td><?php //echo $passport_name;    ?></td>
  <td><?php echo $passport_number;  ?></td>
  <td><?php echo $passport_comment; ?></td>
  <td><?php echo $passport_gender; ?> </td>
  <td><?php echo implode(",",$passport_area);   ?></td>
  <td><?php // echo implode(" ",$passport_service);   ?></td>
</tr>