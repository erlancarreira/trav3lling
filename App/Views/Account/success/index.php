<div class="container">
	<div class="alert alert-success" role="alert">
	  <h4 class="alert-heading">Hey <?= $viewData['name']; ?></h4>
		<?php if(!empty($msg)): ?>
		   <p><?= $msg; ?></p>
		   <a class="btn btn-primary btn-sm" href="<?= BASE; ?>account/">BACK</a>
		<?php endif; ?>
	</div>
</div>