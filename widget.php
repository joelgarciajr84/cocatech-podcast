<?php
class CocatechPodcast extends WP_Widget
{
  function CocatechPodcast()
  {
    $widget_ops = array('classname' => 'CocatechPodcast',
                        'description' => 'Displays the 5 last Episodes'
      );
    $this->WP_Widget('CocatechPodcast', 'Cocatech Podcast', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => 'Episódios Cocatech' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
      #Conteudo do Widget
      RSSImport(5,'http://feeds.cocatech.com.br/cocatech', 
      '',false, '',  true, 200, ' ... ', 
      '', ' ... ', 
      ' <small>', '</small>', 
      ' <small>','</small>', 
      '<ul>','</ul>', 
      '<li>','</li>' 
    );
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("CocatechPodcast");') );

#Should be worked like a Charm =)
?>