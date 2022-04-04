<a id="s-chat">
    <?php 
      seed_icon('s-' . get_theme_mod('buttons_icon', 'chat'));
      $buttons_icon_message = get_theme_mod('buttons_icon_message', 'Message us');
      if ($buttons_icon_message) {
        echo '<div class="c-desc">' . $buttons_icon_message . '</div>';
      }
      echo '<span>';
      seed_icon('x');
      echo '</span>';
    ?>
</a>

<?php
  $channels = get_theme_mod( 'buttons_channels', array( 'messenger', 'line', 'mobile' ) );
  echo '<ul id="s-chat-panel">';
  $chat_plugin = false;
  foreach ( $channels as $channel ) {
    if($channel == 'messenger' && get_theme_mod('buttons_use_chat_plugin', 0)) {
      $chat_plugin = true;

      if($chat_plugin) {
        echo '<li class="c-tip -chat-plugin">';
        echo '<div class="fb-customerchat" attribution=setup_tool page_id="' . trim(get_theme_mod( 'buttons_messenger_id' , '')) . '" minimized="true"></div>';
        echo '<div class="c-desc">' . get_theme_mod('buttons_' . $channel . '_tooltip', ucfirst($channel)) .'</div>';
        ?>
        <div id="fb-root"></div>
        <script>
          window.fbAsyncInit = function() {
              FB.init({
                  xfbml: true,
                  version: 'v9.0'
              });
          };
          (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s);
              js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        </script>
        <?php
        echo '</li>';
    }




    } else {
      s_chat_output($channel);
    }
  }
  echo '</ul>';
  
  
?>

<?php 
function s_chat_output($channel) {
  $link_prefix = '';
  $tooltip = '';
  if ($channel == 'email') {
    $link_prefix = 'mailto:';
  } elseif ($channel == 'mobile' || $channel == 'phone') {
    $link_prefix = 'tel:';
    $tooltip = ': ' . get_theme_mod('buttons_' . $channel . '_url', '');
  }
  echo '<li class="c-tip -' . $channel . '"><a href="' . $link_prefix . get_theme_mod('buttons_' . $channel . '_url', '#') . '" target="_blank">';
  seed_icon('s-chat-' . $channel);
  echo '<div class="c-desc">' . get_theme_mod('buttons_' . $channel . '_tooltip', ucfirst($channel)) . $tooltip .'</div>';
  echo '</a></li>';
}
?>