<div id="id="dashboard-widgets-wrap"">
	<h1 class="hndle ui-sortable-handle">Documentación de <?php echo \WP_Utils::TITLE;?></h1>
	<div id="normal-sortables" class="meta-box-sortables ui-sortable">
		<div id="dashboard_right_now" class="postbox">
			<h2 class="main">Funciones de <?php echo \WP_Utils::TITLE;?></h2>
		</div>
		<div id="dashboard_right_now" class="postbox">
			<div class="inside">
				<h3 class="main">Función limit_words</h3>
				<div class="main">
					<ul>
						<li>limit_words : Corta una cadena de texto en una determinada
							cantidad de palabras</li>
						<li>Ej: <code>&lt;?php echo limit_words($string, $int); ?></code>
						</li>
						<li>$string : cadena de texto (ej: get_the_content())</li>
						<li>$int : cantidad de palabras a mostrar (numero entero)</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="dashboard_right_now" class="postbox">
			<div class="inside">
				<h3 class="main">Función getNameDaySpanish</h3>
				<div class="main">
					<ul>
						<li>getNameDaySpanish : Devuelve el nombre del dia en español</li>
						<li>Ej: <code>&lt;?php echo getNameDaySpanish(date('d')); ?></code></li>
						<li>$d : fecha del dia => date('d')</li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="dashboard_right_now" class="postbox">
			<div class="inside">
				<h3 class="main">Función getNameMonthSpanish</h3>
				<div class="main">
					<ul>
						<li>getNameMonthSpanish : Devuelve el nombre del mes en español</li>
						<li>Ej: <code>&lt;?php echo getNameMonthSpanish(date('m')); ?></code></li>
						<li>$m : número del mes => date('m')</li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="dashboard_right_now" class="postbox">
			<div class="inside">
				<h3 class="main">Función addHttp</h3>
				<div class="main">
					<ul>
						<li>addHttp : Agregar el http a los dominio o url</li>
						<li>Ej: <code>&lt;?php echo addHttp($url); ?></code></li>
						<li>$url : url sin protocolo (http)</li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="dashboard_right_now" class="postbox">
			<div class="inside">
				<h3 class="main">Función addHttps</h3>
				<div class="main">
					<ul>
						<li>addHttps : Agregar el https a los dominio o url</li>
						<li>Ej: <code>&lt;?php echo addHttps(url); ?></code></li>
						<li>$url : url con protocolo (https)</li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="dashboard_right_now" class="postbox">
			<div class="inside">
				<h3 class="main">Función cortarTexto</h3>
				<div class="main">
					<ul>
						<li>cortarTexto : Corta una cadena de texto en una determinada cantidad de caracteres</li>
						<li>Ej: <code>&lt;?php echo cortarTexto($txt,$nr,$abrev); ?></code></li>
						<li>$txt : cadena de texto / $nr : número de caracteres</li>
						<li> $abrev : texto a concatenar ej : '...' (no es obligatorio)</li>
					</ul>
				</div>
			</div>
		</div>
		<p id="wp-version-message">
			<span id="wp-version">Plugin <?php echo \WP_Utils::TITLE;?> , desarrollador por <a
				href="https://renzotejada.com/" target="_blank">Renzo Tejada</a>.
			</span>
		</p>
		<p></p>
	</div>
</div>
