<?php
/* HINWEIS
 *
 * Manche Benunngen für Varibalen Namen sind von WordPress reseviert und können daher nicht als id, value, oder name für ein Feld genutzt werden.
 * Eine Liste mit allen NONOs findet ihr hier: https://codex.wordpress.org/Reserved_Terms
 *
 * CSV.Dateien
 * Bitte achtet drauf, dass diese immer leer sind (bis auf die Kopfzeilen).
*/
?>

<?php
  // Get name of the current element.
  $element = basename(__DIR__);

  // Get block ID.
  $id = $block['id'];

  // Path to Block-Element
  $blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
  $path = "data-blockpath='$blockPath'";


  // Classes.
  $kkBlock = " block-" . $element;
  $classes = $kkBlock;

  // ACF Fields
  $presentation = get_field('presentation');
  $headline      = get_field('headline_clone');
  $receiver      = get_field('receiver');
  $dsvLink      = get_field('dsv-link');
  $text          = get_field('text');
  $hideBlockFrontend = get_field('hide_block_frontend');


  if (isset($block['data']['block-preview'])) { ?>
    <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
  <?php } else {
?>


	<?php if (!$hideBlockFrontend) { ?>
		<section class="block<?php echo $classes; ?> px-6 md:px-9 lg:px-12" <?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
			<div class="wrapper !max-w-5xl">
				<div class="content-container">
					<?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php";  ?>

					<div class="text">
						<?php echo $text; ?>
					</div>
				</div>

				<div class="form-container form-<?php echo $presentation; ?>">
					<?php include 'form.php' ?>
				</div>
			</div>
		</section>
	<?php } ?>

<?php } ?>
