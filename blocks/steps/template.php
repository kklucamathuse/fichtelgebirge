<?php
// Get name of the current element.
$element = basename(__DIR__);

// Get block ID.
$id = $block['id'];

// Path to Block-Element
$blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
$path = "data-blockpath='$blockPath'";

// ACF Fields
$presentation = get_field('presentation');
$projectSteps = get_field('steps');
$stepsCounter        = 1;
$hideBlockFrontend = get_field('hide_block_frontend');

// Custom Classes.
$kkBlock = " block-" . $element;
$classes = $kkBlock;

if (isset($block['data']['block-preview'])) {?>
    <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
<?php } else { ?>

	<?php if (!$hideBlockFrontend) { ?>
		<section class="block<?php echo $classes; ?> px-6 md:px-9 lg:px-12" <?php if (current_user_can('administrator')) { echo " " . $path;} ?>>
			<div class="wrapper">
				<div class="steps-container steps-<?php echo $presentation; ?>">
					<div class="steps-inner relative sm:before:content-[''] sm:before:block sm:before:w-1 sm:before:h-full sm:before:absolute sm:before:bottom-0 sm:before:left-1/2 sm:before:bg-gray-100">
						<ul class="steps-list relative space-y-16 md:space-y-24">
							<?php foreach ($projectSteps as $step) {
								$number    = $step['number'];
								$image       = $step['img'];
								$headline  = $step['headline'];
								$text      = $step['text'];
							?>

								<li class="step-item step-item-<?php echo $stepsCounter; ?> relative group">
									<div class="step-inner flex flex-row flex-wrap-reverse items-center w-full sm:flex-wrap group-odd:flex-row-reverse">
										<div class="text-content relative w-full md:w-1/2 md:group-even:pr-16 xl:group-even:pr-24 md:group-odd:pl-16 xl:group-odd:pl-24">
											<div class="text relative">
												<?php if (!empty($number)) { ?>
													<div class="number mb-4 sm:absolute sm:-top-6 sm:-left-8 sm:text-9xl sm:opacity-20 sm:z-10"><?php echo $number; ?></div>
												<?php } ?>
												<?php if (!empty($headline)) { ?>
													<h3><?php echo $headline; ?></h3>
												<?php } ?>
												<?php if (!empty($text)) { ?>
													<p><?php echo $text; ?> </p>
												<?php } ?>
											</div>
										</div>

										<div class="image-container relative w-full mb-8 md:w-1/2 md:group-even:pl-16 xl:group-even:pl-24 md:group-odd:pr-16 xl:group-odd:pr-24 md:before:block md:before:w-1 md:before:h-24 md:before:absolute md:before:top-1/2 md:before:bg-primary md:before:-translate-y-1/2 md:before:rotate-90 md:group-even:before:left-12 md:group-odd:before:right-12">
											<?php
												$pictureClass = "relative block pt-[70%] lg:pt-[56.25%]";
												$imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
												include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
											?>
										</div>
									</div>
								</li>

								<?php $stepsCounter++; ?>
							<?php } ?>
						</ul>
					</div>

				</div>
			</div>
		</section>
	<?php } ?>

<?php } ?>
