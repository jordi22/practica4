<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function shortcode_gracias() {
  return '<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Html5 canvas 0</title>
</head>

<body>
	<canvas id="sketchpad" width="300" height="300" style="background-color: green;"></canvas>
	<p>
    <button  id="dibujar">DIBUJAR</button>
  	
    <button id="limpiar"> LIMPIAR</button>

	</p>
	<script type="text/javascript" charset="utf-8">
		var tam;
        var a;
        var b;
        var c;
        var d;
		function getMousePos(canvas, evt) {
				var rect = canvas.getBoundingClientRect();
				return {
					x: evt.clientX - rect.left,
					y: evt.clientY - rect.top
				};
			}
            
        function dibuja(context) {
			context.fillStyle = "rgb(0,0,255)";
           	tam=Math.random()*100;
            a=(Math.floor(Math.random()*300));
            b=(Math.floor(Math.random()*300));
            c=tam
            d=tam
			context.fillRect(a,b,c, d);
            
		}
		
		function limpiar(context) {
			canvas = document.querySelector("#sketchpad");
			context = canvas.getContext("2d");
			context.clearRect(0, 0, canvas.width, canvas.height);
		}

		function DibujaEnRaton(context, coors) {
			context.fillStyle = "rgb(255,0,0)";
			context.fillRect(a, b, c, d);

				
			}
		function ready() {
        
			var canvas = document.querySelector("#sketchpad");
			context = canvas.getContext("2d");
			canvas.addEventListener("click",function(evt){
				coors=getMousePos(canvas, evt);
				DibujaEnRaton(context, coors) ;
			})
			
		document.querySelector("#dibujar").addEventListener("click", function () {
				dibuja(context);
			});	document.querySelector("#limpiar").addEventListener("click", function () {
				limpiar(context);
			});
			
		}
		ready();
	</script>
</body>

</html>';
}
add_shortcode('juego0', 'shortcode_gracias');
function load_my_widget() {
	register_widget( 'my_widget1' );
}
add_action( 'widgets_init', 'load_my_widget' );

// Creamos el widget 
class my_widget1 extends WP_Widget {

public function __construct() {
		$widget_ops = array( 
			'classname' => 'my_widget',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'my_widget1', 'My Widget1', $widget_ops );
	}	


// Creamos la parte pÃºblica del widget

public function widget( $args, $instance ) {
$title= apply_filters( 'widget_title', "Nombre de la tienda" );
$NombreTienda= apply_filters( 'widget_text', $instance['NombreTienda'] );
$title2= apply_filters( 'widget_title', "Dirección de la tienda" );
$DireccionTienda= apply_filters( 'widget_text', $instance['DireccionTienda'] );


// los argumentos del antes y despues del widget vienen definidos por el tema
echo $args['before_widget'];
if ( ! empty( $NombreTienda) )
echo $args['before_title'] . $title . $args['after_title'];
echo $NombreTienda;
if ( ! empty( $DireccionTienda) )
echo $args['before_title'] . $title2 . $args['after_title'];
echo $DireccionTienda;
echo $args['before_title'] ;
echo $args['after_title'];

print'<aside><iframe style="border: 1;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3061.3178450265364!2d-0.08334838461440137!3d39.88951547942992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6004059ac3ec0b%3A0x612c5900a978ac95!2sCalle+San+Isidro%2C+12530+Burriana%2C+Castell%C3%B3n!5e0!3m2!1ses!2ses!4v1544614071819" width="400" height="250" frameborder="0" allowfullscreen="allowfullscreen"><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start">﻿</span><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start">﻿</span></iframe></aside>';

// AquÃ­ es donde debemos introducir el cÃ³digo que queremos que se ejecute
echo $args['after_widget'];
}
		
// Backend  del widget
public function form( $instance ) {
if ( isset( $instance[ 'NombreTienda' ] ) ) {
$NombreTienda= $instance[ 'NombreTienda' ];
$DireccionTienda= $instance['DireccionTienda'];


}
else {
$title = __( 'NombreTienda', 'my_widget_domain' );
}
// Formulario del backend
 ?>
<p>
<label for="<?php echo $this->get_field_id( 'NombreTienda' ); ?>"><?php _e( 'Nombre de la Tienda:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'NombreTienda' ); ?>" name="<?php echo $this->get_field_name( 'NombreTienda' ); ?>" type="text" value="<?php echo esc_attr( $NombreTienda); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'DireccionTienda' ); ?>"><?php _e( 'Direccion de la Tienda:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'DireccionTienda' ); ?>" name="<?php echo $this->get_field_name( 'DireccionTienda' ); ?>" type="text" value="<?php echo esc_attr( $DireccionTienda); ?>" />
</p>
<?php	
}
// Actualizamos el widget reemplazando las viejas instancias con las nuevas
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['NombreTienda'] = ( ! empty( $new_instance['NombreTienda'] ) ) ? strip_tags( $new_instance['NombreTienda'] ) : '';
$instance['DireccionTienda'] = ( ! empty( $new_instance['DireccionTienda'] ) ) ? strip_tags( $new_instance['DireccionTienda'] ) : '';

return $instance;
}
} // La clase wp_widget termina aqui


//WIDGET DE GALERIA.//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function load_my_widget2()
{
	register_widget('my_galeria');
}
add_action('widgets_init', 'load_my_widget2');

// Creamos el widget 
class my_galeria extends WP_Widget
{
	public function __construct()
	{
		$widget_ops = array(
			'classname' => 'my_widget',
			'description' => 'My Widget for galeries.',
		);
		parent::__construct('my_galeria', 'My Galeria', $widget_ops);
	}	


// Creamos la parte pública del widget

	public function widget($args, $instance)
	{



// los argumentos del antes y despues del widget vienen definidos por el tema
		


		$current_user = wp_get_current_user();
		$user_email = $current_user->user_email;
                $user_login = $current_user->user_login;

		if (current_user_can('manage_options') or $user_email == '') {
		} else {
echo $args['before_widget'];

echo $args['before_title'] .'Amigos de '. $user_login . $args['after_title'];

$table = 'A_GrupoCliente';
		$MP_pdoSportRunner = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

		$a = array();
		$foto = 'foto_file';
		$campo = 'clienteMail';
		$query = "SELECT     $foto FROM  $table      WHERE $campo =?";
		$a = array($user_email);
		$consult = $MP_pdoSportRunner->prepare($query);
		$a = $consult->execute($a);
		$rows = $consult->fetchAll(PDO::FETCH_ASSOC);

		if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
			print '<div><table class="tablaAmigos">';
			foreach ($rows as $row) {
				print "<tr>";
				foreach ($row as $key => $val) {
					if ($key == "foto_file") {
						echo "<td>", "<img src='$val' width=100 height=100>", "</td>";
					} else {
						echo "<td>", $val, "</td>";
					}
				}
				print "</tr>";
			}
			print "</table></div>";
		}
echo $args['after_widget'];
		}


		

// Aquí es donde debemos introducir el código que queremos que se ejecute
		

	}

// Backend  del widget
	public function form($instance)
	{

// Formulario del backend
	}
// Actualizamos el widget reemplazando las viejas instancias con las nuevas

} // La clase wp_widget termina aqui
?>