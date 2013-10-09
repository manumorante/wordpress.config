<?php
/*
Plugin Name: MM Config
Plugin URI: http://www.estadologico.com
Description: WordPress Plugin. MM Config sets vars for different uses.
Author: Manuel Morante
Version: 2.0
Author URI: http://www.estadologico.com
*/

function config_admin_menu() {
	add_submenu_page('plugins.php', 'MM Config', 'MM Config', 1, __FILE__, 'config_pagina_opciones');
}
add_action('admin_menu', 'config_admin_menu');


// Begin Options
function config_pagina_opciones() {
	if (isset($_POST['config_cambios'])) {

		$opcion_bajo_menu_active = $_POST['mmc-banner-submenu-active'];
		$opcion_bajo_menu_image = $_POST['mmc-banner-submenu-image'];
		$opcion_bajo_menu_link = $_POST['mmc-banner-submenu-link'];
	
		update_option('mmc-banner-submenu-active', $opcion_bajo_menu_active);
		update_option('mmc-banner-submenu-link', $opcion_bajo_menu_link);
		update_option('mmc-banner-submenu-image', $opcion_bajo_menu_image);

		?>
        <div class="updated"><p>&iexcl;Bien!, has actualizado tu configuraci&oacute;n correctamente!</p></div>
		<?php
	}
?>
<form method="post">
<div class="wrap">
  <h2>Configura tu plantilla</h2>
  <h4>Mostrar y ocultar zonas y banners de la web:</h4>
  <table width="100%" class="widefat">
    <thead>
      <tr>
        <th width="200" scope="col">Banner submen&uacute;</th>
        <th scope="col"><br /></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Mostrar:</th>
        <td height="5">
        <input name="mmc-banner-submenu-active" type="radio" id="mmc-banner-submenu-active-1" value="1" <? if(get_option('mmc-banner-submenu-active')==1){?>checked="checked"<? }?> />
          <label for="mmc-banner-submenu-active-1">S&Iacute;</label>
          
          <input name="mmc-banner-submenu-active" type="radio" id="mmc-banner-submenu-active-0" value="0" <? if(get_option('mmc-banner-submenu-active')==0){?>checked="checked"<? }?> />
          <label for="mmc-banner-submenu-active-0">No</label></td>
      </tr>
      
        <tr>
        <th><label for="opcion_bajo_menu_link">Dirección de la image:</label></th>
        <td height="5" align="center">
        <input style="width:100%;" name="mmc-banner-submenu-link" id="mmc-banner-submenu-link" type="text" value="<?php echo get_option('mmc-banner-submenu-image') ?>" />
        </td>
      </tr>

      
      <tr>
        <th><label for="opcion_bajo_menu_image">Enlace:</label></th>
        <td height="5" align="center">
        <input style="width:100%;" name="mmc-banner-submenu-image" id="mmc-banner-submenu-image" type="text" value="<?php echo get_option('mmc-banner-submenu-link') ?>" />
        </td>
      </tr>


    </tbody>
  </table>

  <!--
  <h4>Duraci&oacute;n de la Cookie</h4>
  <p>Define el tiempo que debe pasar para mostrar nuevamente el popup a un visitante.</p>
  <p>Pr&oacute;ximamente</p>
  -->
  
  <div class="submit"><p><input type="submit" style="font-weight: bold;" value="Actualizar opciones &raquo;" name="config_cambios"/></p></div>
  
</div>
</form>
<?php
}

// Funcion de llamada en la Tamplate
function mm_config($action){
	
	// Banner bajo el menú
	switch ($action) {
    case "banner-submenu":
	
		if (get_option('mmc-banner-submenu-active')==1){
			?>
            <div class="mm-config banner-submenu">
            <a href="<?php echo get_option('mmc-banner-submenu-link'); ?>"><img src="<?php echo get_option('mmc-banner-submenu-image'); ?>"></a>
            </div>
            
            <?php // echo get_option('codigo_bajo_menu'); ?>
            
			<?
		}
		break;

	default:
       echo "La acción solicitado no se encuentra.";

	}
	
}

// add_action('wp_footer', 'mm_config', 3);
?>