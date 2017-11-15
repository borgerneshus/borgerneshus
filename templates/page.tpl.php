<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<script>
</script>
    <!-- Navigation -->

    <nav id="top-nav" class="navbar navbar-inverse hidden-print" role="navigation">
        <div id="nav-info-header" class="hidden-xs">
            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-top:10px;font-size:15px;">
                <?php
             if (!empty($page['top-left'])):
             echo render($page['top-left']); 
             endif;
             ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 text-right" style="padding-top:10px;">
             <?php
             if (!empty($page['top-right'])):
             echo render($page['top-right']); 
             endif;
             ?>
            </div>
        </div>
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
                
        <?php if ($logo): ?>
       <div id="absolute_center"  style="top:5px;"> 
      <a class="logo navbar-btn " href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
            </div>
      <?php endif; ?>

      <?php if (!empty($site_name)): ?>
            <div id="absolute_center"> 
      <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
      </div>
      <?php endif; ?>

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php print render($primary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
      </div>
    <?php endif; ?>
  </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     <!-- Navigation END -->

<div id="frontpage_carousel" class="">
<div id="site-content" class="container noSwipe" style="">
   <!-- Carousel -->
   <!-- Carousel END-->
  <div class="row"  >

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <div<?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
    </div>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>
    <div class="row"  >

    </div>
</div>

</div>
<footer id="footer" class="hidden-print footer <?php echo drupal_is_front_page() ?  'footer-nonstick' :  'footer-nonstick' ?> col-md-12">
    <div class="col-md-12">
      <?php if (!empty($page['footer-left']) || !!empty($page['footer-middle']) || !empty($page['footer-rigth']) ) {?>
        <div class="col-md-12">
            <div class=" col-md-4"></div>
            <div class=" col-md-4 ">
                <div class=" col-md-4">
                     <?php if (!empty($page['footer-left'])): ?>
                        <?php print render($page['footer-left']); ?>
                     <?php endif; ?>
                </div>
                <div class=" col-md-4">                   
                     <?php if (!empty($page['footer-middle'])): ?>
                        <?php print render($page['footer-middle']); ?>
                     <?php endif; ?></div>
                <div class=" col-md-4">
                     <?php if (!empty($page['footer-rigth'])): ?>
                        <?php print render($page['footer-rigth']); ?>
                     <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4 "></div>
        </div>
      <?php } ?>
        <div class="col-xs-12 col-sm-12 col-md-8 footer_logos" >
             <?php
             if (!empty($page['bottom-left'])):
             echo render($page['bottom-left']); 
             endif;
             ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 footer_social_logos text-right">
            <?php
             if (!empty($page['bottom-right'])):
             echo render($page['bottom-right']); 
             endif;
            ?>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 footer_address">
            <?php
             if (!empty($page['address-bottom'])):
             echo render($page['address-bottom']); 
             endif;
            ?>
        </div>
    </div>
</footer>
<!--- 
Dialogs
---!>
<?php if(module_exists('gtranslate')){ ?>

<!-- Modal -->
<div id="gtranslate" class="modal fade hidden-print" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Translate </h4>
      </div>
      <div class="modal-body">
        <?php
        $block = module_invoke('gtranslate', 'block_view', 'gtranslate');
        print render($block['content']);
        ?>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<?php }?>