<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

// Load Joomla's Bootstrap styles
HTMLHelper::_('bootstrap.framework');
HTMLHelper::_('stylesheet', 'administrator/templates/atum/css/template.css', ['version' => 'auto'], ['relative' => true]);
?>

<div class="container">
	<div class="row">
		<div class="col-md-3 mb-4"> <!-- Spacing added with mb-4 -->
			<div class="card h-100"> <!-- Added h-100 for equal card height -->
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=products'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Products</h3>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=brands'); ?>">
						<i class="icon-book" style="font-size: 2rem;"></i>
						<h3>Manage Brands</h3>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=thicknesses'); ?>">
						<i class="icon-book" style="font-size: 2rem;"></i>
						<h3>Manage Thickness</h3>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=effects'); ?>">
						<i class="icon-cart" style="font-size: 2rem;"></i>
						<h3>Manage Effects</h3>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=areas'); ?>">
						<i class="icon-cart" style="font-size: 2rem;"></i>
						<h3>Manage Areas</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=designs'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Designs</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=colors'); ?>">
						<i class="icon-palette" style="font-size: 2rem;"></i>
						<h3>Manage Colors</h3>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=types'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Types</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=sizes'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Sizes</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=surfaces'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Surfaces</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=facetiles'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Facetiles</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=groutcolors'); ?>">
						<i class="icon-list" style="font-size: 2rem;"></i>
						<h3>Manage Grout Colors</h3>
					</a>
				</div>
			</div>
		</div>

		<div class="col-md-3 mb-4">
			<div class="card h-100">
				<div class="card-body text-center">
					<a href="<?php echo Route::_('index.php?option=com_bookpro&view=contrasts'); ?>">
						<i class="icon-cog" style="font-size: 2rem;"></i>
						<h3>Color Contrast</h3>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>