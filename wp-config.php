<?php
define('WP_HOME', 'http://info:6062/mag/');
// define('WP_SITEURL', 'http://info:6062/mag/');
define('WP_SITEURL', 'http://adm-info:6062/mag/');
// define('WP_HOME','https://info.hp-sorimachi.mym.sorimachi.biz/mag');
// define('WP_SITEURL','https://adm-hp-info.apn.mym.sorimachi.biz/mag');
// define('WP_HOME', 'http://mag:8383');
// define('WP_SITEURL', 'http://mag:8383');
// define( 'WP_LANG_DIR', $_SERVER['HOME'] .'/files/languages/wpml' );
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */

define('DB_NAME', 'cms_info_db');
// define('DB_NAME', 'mag_r');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'root');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', '');

/** MySQL のホスト名 */
define('DB_HOST', '127.0.0.1');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
// define('DB_COLLATE', '');

// define( 'DB_NAME', 'cms_info_db' );

// /** MySQL データベースのユーザー名 */
// define( 'DB_USER', 'cms_info_user' );

// /** MySQL データベースのパスワード */
// define( 'DB_PASSWORD', 'cms_info_pass' );

// // * MySQL のホスト名 
// define( 'DB_HOST', '192.168.3.215' );

// /** データベースのテーブルを作成する際のデータベースの文字セット */
// define( 'DB_CHARSET', 'utf8mb4' );

// /** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
// define( 'DB_COLLATE', '' );

// define( 'DB_NAME', 'cms_info_db' );

// /** MySQL データベースのユーザー名 */
// define( 'DB_USER', 'cms_info_db_write' );

// /** MySQL データベースのパスワード */
// define( 'DB_PASSWORD', 'daisuki60' );

// /** MySQL のホスト名 */
// define( 'DB_HOST', 'mdb-hp-wp.apn.mym.sorimachi.biz' );

// /** データベースのテーブルを作成する際のデータベースの文字セット */
// define( 'DB_CHARSET', 'utf8' );

// /** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
// define( 'DB_COLLATE', '' );
/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?UqL$A9f}HX``2nsXa}k[/fF,!p/2O/S=eqaYPAw.;P;[BJv^-,Y7C0&Xs_NmHmF' );
define( 'SECURE_AUTH_KEY',  'z=$CB_X9:U+n3 }-&n0]AvOr4}><E{V9MJ7Ui(3t[5#Soy1X%5]L}oMBRbLxzUDq' );
define( 'LOGGED_IN_KEY',    'yGYDBHm7E|cuVIKlI_^XBOi`GRyyY>OUBzl$Rqa?9Jn8;l?[$*FqqxP<^PN<>~G.' );
define( 'NONCE_KEY',        'sscoUz{[v<P^PiY34ffN7E6S&Gy*uWR{]UgPyJ;~+&}c~r:B9@%p&=9gL6d1_S0`' );
define( 'AUTH_SALT',        '@^VkgnEQ;+#}2?9IJ*w-l%qiG{bU>;vF8sc0T{>&WH;tmlR n+4?Mu~v,9H$9[fR' );
define( 'SECURE_AUTH_SALT', '2t#9 PxpFxq+)7WPDI=9n*.PWB%T},Bn{bh_45k-LsTjQZ&?QD?kS}$QuSfFNex;' );
define( 'LOGGED_IN_SALT',   'X2FFI)p|E9tEd)j~{]!%?hx4Fn*}NAL6Pp$({r$.`Lfe~?6Jb9P^ j|B?y/-Lz<k' );
define( 'NONCE_SALT',       '67oFSO 7H-Q#SRQAT6kM]KO*C76DJI<=OF0=H4N^U!SC@S!+(bk1%!ngw8 yeN{Y' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'mag_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
