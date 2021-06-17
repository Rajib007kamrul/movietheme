<?php

$feature_groups = array(
    'bedroom' => __('Bedroom', 'my_plugin'),
    'living' => __('Living room', 'my_plugin'),
    'kitchen' => __('Kitchen', 'my_plugin')
);

$List_feature_groups = array(
    'bedroom1' => __('Bedroom1', 'my_plugin'),
    'living1' => __('Living room1', 'my_plugin'),
    'kitchen1' => __('Kitchen1', 'my_plugin')
);


add_action( 'category_add_form_fields', 'add_feature_group_field', 10, 2 );
function add_feature_group_field($taxonomy) {
    global $feature_groups;
    global $List_feature_groups;
    ?><div class="form-field term-group">
  <label for="featuret-group"><?php _e('Feature Group', 'my_plugin'); ?></label>
  <select class="postform" id="equipment-group" name="feature-group">
    <option value="-1"><?php _e('none', 'my_plugin'); ?></option>
    <?php foreach ($feature_groups as $_group_key => $_group) : ?>
    <option value="<?php echo $_group_key; ?>" class="">
      <?php echo $_group; ?></option>
    <?php endforeach; ?>
  </select>
</div>

<div class="form-field term-group">
  <label for="List Featur-group"><?php _e('List Feature Group', 'my_plugin'); ?></label>
  <select class="postform" id="equipment-group" name="list-Feature-group">
    <option value="-1"><?php _e('none', 'my_plugin'); ?></option>
    <?php 
    foreach ($List_feature_groups as $_group_key => $_group) : ?>
    <option value="<?php echo $_group_key; ?>" class="">
      <?php echo $_group; ?></option>
    <?php endforeach; ?>
  </select>
</div>

<?php
}

add_action( 'created_category', 'save_feature_meta', 10, 2 );

function save_feature_meta( $term_id, $tt_id ){
    if( isset( $_POST['feature-group'] )){
        $group = sanitize_title( $_POST['feature-group'] );
        add_term_meta( $term_id, 'feature-group', $group, true );
    }
    if( isset( $_POST['list-feature-group'] )){
        $group = sanitize_title( $_POST['list-feature-group'] );
        add_term_meta( $term_id, 'list-feature-group', $group, true );
    }
}

add_action( 'category_edit_form_fields', 'edit_feature_group_field', 10, 2 );

function edit_feature_group_field( $term, $taxonomy ){
    global $feature_groups;
    // get current group
    $feature_group = get_term_meta( $term->term_id, 'feature-group', true );

    ?><tr class="form-field term-group-wrap">
  <th scope="row"><label for="feature-group"><?php _e( 'Feature Group', 'my_plugin' ); ?></label></th>
  <td><select class="postform" id="feature-group" name="feature-group">
      <option value="-1"><?php _e( 'none', 'my_plugin' ); ?></option>
      <?php foreach( $feature_groups as $_group_key => $_group ) : ?>
      <option value="<?php echo $_group_key; ?>" <?php selected( $feature_group, $_group_key ); ?>>
        <?php echo $_group; ?></option>
      <?php endforeach; ?>
    </select></td>
</tr>
<?php 

global $List_feature_groups;
// get current group
$list_feature_group = get_term_meta( $term->term_id, 'list-feature-group', true );

?>
<tr class="form-field term-group-wrap">
  <th scope="row"><label for="list-feature-group"><?php _e( 'List Feature Group', 'my_plugin' ); ?></label></th>
  <td><select class="postform" id="list-feature-group" name="list-feature-group">
      <option value="-1"><?php _e( 'none', 'my_plugin' ); ?></option>
      <?php foreach( $List_feature_groups as $_group_key => $_group ) : ?>
      <option value="<?php echo $_group_key; ?>" <?php selected( $list_feature_group, $_group_key ); ?>>
        <?php echo $_group; ?></option>
      <?php endforeach; ?>
    </select></td>
</tr>ss

<?php
}

add_action( 'edited_category', 'update_feature_meta', 10, 2 );

function update_feature_meta( $term_id, $tt_id ){

    if( isset( $_POST['feature-group'] ) ){
        $group = sanitize_title( $_POST['feature-group'] );
        update_term_meta( $term_id, 'feature-group', $group );
    }
     if( isset( $_POST['list-feature-group'] ) ){
        $group = sanitize_title( $_POST['list-feature-group'] );
        update_term_meta( $term_id, 'list-feature-group', $group );
    }
}

add_filter('manage_edit-category_columns', 'add_feature_group_column' );

function add_feature_group_column( $columns ){
    $columns['feature_group'] = __( 'Group', 'my_plugin' );
    return $columns;
}

add_filter('manage_category_custom_column', 'add_feature_group_column_content', 10, 3 );

function add_feature_group_column_content( $content, $column_name, $term_id ){
    global $feature_groups;

    if( $column_name !== 'feature_group' ){
        return $content;
    }

    $term_id = absint( $term_id );
    $feature_group = get_term_meta( $term_id, 'feature-group', true );

    if( !empty( $feature_group ) ){
        $content .= esc_attr( $feature_groups[ $feature_group ] );
    }

    return $content;

    global $list_feature_groups;

    if( $column_name !== 'list_feature_group' ){
        return $content;
    }

    $term_id = absint( $term_id );
    $list_feature_group = get_term_meta( $term_id, 'list-feature-group', true );

    if( !empty( $list_feature_group ) ){
        $content .= esc_attr( $list_feature_groups[ $list_feature_group ] );
    }

    return $content;
}














add_filter( 'manage_edit-category_sortable_columns', 'add_feature_group_column_sortable' );

function add_feature_group_column_sortable( $sortable ){
    $sortable[ 'feature_group' ] = 'feature_group';
    return $sortable;
}

$args = array(
    'hide_empty' => false, // also retrieve terms which are not used yet
    'meta_query' => array(
        array(
           'key'       => 'feature-group',
           'value'     => 'kitchen',
           'compare'   => 'LIKE'
        )
    )
);

$terms = get_terms( 'house_feature', $args );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    echo '<ul>';
    foreach ( $terms as $term ) {
        echo '<li>' . $term->name . ' (' . get_term_meta( $term->term_id, 'feature-group', true ) . ')' . '</li>';
    }
    echo '</ul>';
}


?>