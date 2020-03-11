<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'clubedadireita' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3(u|)hSJv4X7C3UE|5!D{0m{MH>_Fk]douV>lVT2lOzGtUATBwK&{h:c{k-ha+M5' );
define( 'SECURE_AUTH_KEY',  'iL4mm0J;5u^-d-z~B^/(:j,j/jgO9|p|AP^,0?,5]X4nXflQqS0C^i3yWjDpx>UY' );
define( 'LOGGED_IN_KEY',    'EghMSvFGe2HsO^xiC?EOwZ9&hupB)$T^=iz~Q>Q3`lXW=7?.2?{1bCKV[Rb_SQEL' );
define( 'NONCE_KEY',        'FzR:)[U|[TPpy&u92#VFIkaDIzw$|Orajacr=`1Ze?JHZCI4Se34&|bNT3Bgn5Kv' );
define( 'AUTH_SALT',        'rsW,yNVfTlaN] G77T<VfgmZ~:8XreIhk|@OmEkxgrCac2?-|Y$75C-4 D35Ux9&' );
define( 'SECURE_AUTH_SALT', 'xCHOhF-I&ApqQ<}45qh2Xe8D45Jo@KV|.$k^RCSn9yTB (W0r4sTf&[xr^Q@GJMw' );
define( 'LOGGED_IN_SALT',   '8>OW$P6f!IOYRq53H{A/bn{T;:oU dzI!8XQ3{gz]MhLXoD%@h{jHb#q{7fl9GNt' );
define( 'NONCE_SALT',       'Z;>T[WSWMu]85y/S$LMC,yOoz?Jr_Tu`P6;ajsN6|<qL?=Zuwnugwk_C6&XoMXYg' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'cd_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');