<?php
/**
 * Implements hook_preprocess_HOOK().
 */
function borgerneshus_preprocess_print(&$variables) {
  $node = $variables['node'];
  $variables['content'] = strstr($node->content, '</h2>');
}
/*
 * In here we will handle custom backgrounds.
 */
function borgerneshus_preprocess_html(&$vars) {   
 borgerneshus_oc_custom_backgrounds();
 $path = drupal_get_path_alias();
 $path_parts = explode('/', $path);
 
 drupal_add_css(drupal_get_path('theme', 'borgerneshus') . '/css/responsive-sd.css');
 drupal_add_css(drupal_get_path('theme', 'borgerneshus') . '/css/responsive-md.css');
 //drupal_add_css(drupal_get_path('theme', 'borgerneshus.dk') . '/css/view-hp-news-frontpage.css');
  /* @var $path_parts type */
  if (isset($path_parts[0]) && $path_parts[0] == 'hp-lokationer' || $path_parts[0] == 'mit' || $path_parts[0] == 'nyheder') {
     drupal_add_css(drupal_get_path('theme', 'borgerneshus') . '/css/view-hp-events.css');
  } elseif ($path_parts[0] == 'events' && $path_parts[1] == 'aktiviteter') {
    drupal_add_css(drupal_get_path('theme', 'borgerneshus') . '/css/view-hp-events-glokationer.css');
}

 if (isset($path_parts[0]) && $path_parts[0] == 'hp-lokationer') {
    drupal_add_js(drupal_get_path('theme', 'borgerneshus') . '/js/jquery.fastLiveFilter.min.js', array('weight' => 999));
  }

  drupal_add_css(drupal_get_path('theme', 'borgerneshus') . '/css/view-hp-events/view-hp-events.media.css');
  if(drupal_is_front_page())
    {
    $meta_description = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'content' => 'borgerneshus.dk',
      'name' =>  'description',
    )
  );
      //drupal_add_html_head($meta_description, 'meta_description');

    /*
    * Frontpage full page slide hacks.
    */
        drupal_add_css('.bootstrap-twocol-stacked .row:nth-child(1) {height: 90vh !important;} .bootstrap-twocol-stacked .row:nth-child(2) {background-color: url("/sites/all/themes/oc_harrypotter/images/transparent_black.png"");}', 'inline');
    }
    drupal_add_js(drupal_get_path('theme', 'borgerneshus') . '/js/p2b_ticket_status_ajax.js');
    
    
}
/*
 * Modify page variables
 */
function borgerneshus_preprocess_page(&$variables) {
     $variables['secondary_nav'] = menu_tree('menu-menu-right');
     $variables['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
}
/**
 * Helper function; Load node by title
 */
function borgerneshus_node_load_by_title($title, $node_type) {
  $query = new EntityFieldQuery();
  $entities = $query->entityCondition('entity_type', 'node')
      ->propertyCondition('type', $node_type)
      ->propertyCondition('title', $title)
      ->propertyCondition('status', 1)
      ->range(0, 1)
      ->execute();
  if (!empty($entities)) {
    $load = array_keys($entities['node']);
    return node_load(array_shift($load));
  }

}

/*
 * Helpers
 */
function borgerneshus_oc_custom_backgrounds()
{
  $path = drupal_get_path_alias();
  $front = "*";
  $events = "events/*";
  $news = "nyheder/*";
  $statisk = "statisk/*";

  $path_parts = explode('/', $path);
  /* @var $path_parts type */
  if (isset($path_parts[1]) && ($path_parts[0] == 'hp-lokationer' || $path_parts[0] == "arrangementer")) {
     $node = menu_get_object();
     if($node == null)
     {
         //we might be viewing a term ?
         $node = menu_get_object('taxonomy_term', 2);
     }
  }
  elseif (drupal_match_path($path, $events)) {
    $node = borgerneshus_node_load_by_title('arrangementer baggrund', 'background');
  }
  elseif (drupal_match_path($path, $news)) {
    $node = borgerneshus_node_load_by_title('nyheder baggrund', 'background');
  }
  elseif (drupal_match_path($path, $statisk)) {
    $node = borgerneshus_node_load_by_title('statisk baggrund', 'background');
  }
  elseif (drupal_match_path($path, $front)) {
    $node = borgerneshus_node_load_by_title('forside baggrund', 'background');
  }

  if (!empty($node) && !empty($node->field_min_1600px) && !empty($node->field_min_1200px)) {
    $bg1200 = file_create_url($node->field_min_1200px[LANGUAGE_NONE][0]['uri']);
    $bg1600 = file_create_url($node->field_min_1600px[LANGUAGE_NONE][0]['uri']);
    drupal_add_js(array('oc_harrypotter' => array('img_src' => $node->field_min_1200px[LANGUAGE_NONE][0]['field_foto_kilde_'][LANGUAGE_NONE][0]['value'])), 'setting');
    drupal_add_css(
        '@media screen and (max-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
  background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1200 . ');} }', 'inline'
    );
    drupal_add_css(
        '@media screen and (min-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
  background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1600 . ');} }', 'inline'
    );
  }elseif (!empty($node) && !empty($node->field_title_image) && !empty($node->field_title_image_1200_px_)) {
    $bg1200 = file_create_url($node->field_title_image_1200_px_[LANGUAGE_NONE][0]['uri']);
    $bg1600 = file_create_url($node->field_title_image[LANGUAGE_NONE][0]['uri']);
    drupal_add_js(array('oc_harrypotter' => array('img_src' => $node->field_title_image_1200_px_[LANGUAGE_NONE][0]['field_foto_kilde_'][LANGUAGE_NONE][0]['value'])), 'setting');
    drupal_add_css(
        '@media screen and (max-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
  background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1200 . ');} }', 'inline'
    );
    drupal_add_css(
        '@media screen and (min-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
  background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1600 . ');} }', 'inline'
    );
  }elseif(!empty(node) && !empty($node->field_min_1200px) && !empty($node->field_location_min_1600px))
  {
        $bg1200 = file_create_url($node->field_min_1200px[LANGUAGE_NONE][0]['uri']);
        $bg1600 = file_create_url($node->field_location_min_1600px[LANGUAGE_NONE][0]['uri']);
        drupal_add_js(array('oc_harrypotter' => array('img_src' => $node->field_min_1200px[LANGUAGE_NONE][0]['field_foto_kilde_'][LANGUAGE_NONE][0]['value'])), 'setting');
        drupal_add_css(
            '@media screen and (max-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
      background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1200 . ');} }', 'inline'
        );
        drupal_add_css(
            '@media screen and (min-width: 1200px) { body { -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;
      background-size: cover; background-repeat: no-repeat; background-position:center center; background-attachment: fixed; background-image:url(' . $bg1600 . ');} }', 'inline'
        );
  }
  
}

/**
 * Implements hook_preprocess_node().
 *
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function borgerneshus_preprocess_node(&$variables, $hook) {

  if (isset($variables['content']['field_place2book_tickets']['#bundle']) && $variables['content']['field_place2book_tickets']['#bundle'] == 'events') {

    $event_location = $variables['content']['field_location'][0]['#address']['name_line'] . ', ' . $variables['content']['field_location'][0]['#address']['thoroughfare'];
    $event_location_no_name = $variables['content']['field_location'][0]['#address']['thoroughfare'];


    $variables['oc_harrypotter_event_location'] = $event_location;
    /*
     * Having name on breaks the links to external maps!!!!
     */
    $variables['oc_harrypotter_event_location_no_name'] = $event_location_no_name;
    // Set a flag for existence of field_place2book_tickets
    $variables['oc_harrypotter_place2book_tickets'] = (isset($variables['content']['field_place2book_tickets'])) ? 1 : 0;
    
  }

  //added open graph meta tags for facebook.
  $site_name = variable_get('site_name');
  $og_title = $variables['node']->title . ($site_name ? ' | ' . $site_name : '');
  if ($variables['type'] == 'news' || $variables['type'] == 'page') {
    $og_description = isset($variables['node']->field_lead[LANGUAGE_NONE][0]) ? drupal_substr(check_plain(strip_tags($variables['node']->field_lead[LANGUAGE_NONE][0]['safe_value'])), 0, 100) . '..' : '';
    $og_image = isset($variables['node']->field_title_image[LANGUAGE_NONE][0]) ? file_create_url($variables['node']->field_title_image[LANGUAGE_NONE][0]['uri'], array('absolute' => TRUE)) : '';

    drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:title',
      'content' => $og_title,
    ),
      ), 'node_' . $variables['node']->nid . '_og_title');
  drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:description',
      'content' => $og_description,
    ),
      ), 'node_' . $variables['node']->nid . '_og_description');

  drupal_add_html_head(array(
    '#tag' => 'meta',
    '#attributes' => array(
      'property' => 'og:image',
      'content' => $og_image,
    ),
      ), 'node_' . $variables['node']->nid . '_og_image');
  }
  // Add ddbasic_byline to variables
  $variables['oc_harrypotter_byline'] = t('By: ');

  /**
   * @TODO Use date-formats defined in the backend, do not hardcode formats...
   *       ever
   */
  // Add updated to variables.
  $variables['oc_harrypotter_updated'] = t('Updated: !datetime', array('!datetime' => format_date($variables['node']->changed, 'custom', 'l j. F Y')));

  // Modified submitted variable
  if ($variables['display_submitted']) {
    $variables['submitted'] = t('Submitted: !datetime', array('!datetime' => format_date($variables['created'], 'custom', 'l j. F Y')));
  }

}
/**
 * Implements hook_preprocess_panels_pane().
*
*/
function borgerneshus_preprocess_panels_pane(&$vars) {
  // Suggestions base on sub-type.
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . str_replace('-', '__', $vars['pane']->subtype);

  // Suggestions on panel pane
  $vars['theme_hook_suggestions'][] = 'panels_pane__' . $vars['pane']->panel;
    }

/**
 * Implementing the ticketsinfo theme function (support for ding_place2book module)
 *
 * @TODO: Markup should not be hardcode into theme function as it makes it very
 *        hard to override.
 *
 */
function borgerneshus_place2book_ticketsinfo($variables) {
      $output = '';
  $place2book_id = $variables['place2book_id'];
  $url = $variables['url'];
  $type = $variables['type'];

  switch ($type) {
    case 'event-over':
      $output = '<div class="btn-warning btn-large">' . t('The event has already taken place') . '</div>';
      break;
    case 'closed-admission':
      $output = '<div class="btn-warning btn-large">' . t('The event is closed for admission') . '</div>';
      break;
    case 'sale-not-started':
      $output = '<div class="btn-warning btn-large">' . t('Ticket sale has not yet started for this event') . '</div>';
      break;
    case 'sale-not-started':
      $output = '<div class="btn-warning btn-large">' . t('Ticket sale has not yet started for this event') . '</div>';
      break;
    case 'no-tickets-left':
      $output = '<div class="btn-warning btn-large">' . t('Sold out') . '</div>';
      break;
    case 'order-link':
      $output = l(t('Book a ticket'), $url, array('attributes' => array('class' => array('btn', 'btn-primary', 'btn-large') , 'target' => '_blank')));
      break;
    default:
      $output = '';
      break;
  }

  return $output;
}
/*
 * Make pictures outputtet via views responsive
 */
function borgerneshus_preprocess_image(&$variables) {
   if(isset($variables['style_name'])) {
       // this is an image style used in drupal's image styles
    if($variables['style_name'] == "hp_event_list_thumbnail" || $variables['style_name'] == "hp_event_glokationer_thumbnail")  {
     //$variables['class']['img-responsive'][] = "true";
     $variables['attributes']['class'][] = "img-responsive";
   }
  }
 }
/*
 * Alter gallery captions
 */
 function borgerneshus_juicebox_image_data_alter(&$data)
 {
     if(!empty($data['caption']))
     {
        $data['caption'] = "<p>Foto: " . strip_tags($data['caption']) . "</p>";
     }     
 }