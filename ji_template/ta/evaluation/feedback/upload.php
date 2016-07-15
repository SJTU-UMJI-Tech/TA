<link rel="stylesheet" href="/ji_style/cropper/cropper.min.css">
<link rel="stylesheet" href="/ji_style/cropper/css/avatar.css">

<style>
	.avatar-view {
		display: block;
		height: 305px;
		width: auto;
		margin-bottom: 15px;
		border: 3px solid #fff;
		border-radius: 5px;
		box-shadow: 0 0 5px rgba(0,0,0,.15);
		cursor: pointer;
		overflow: hidden;
	}
</style>

<div id="crop-avatar">

	<!-- Current avatar -->
	<div class="avatar-view" title="Upload a picture">
		<img id="avatar-view-img">

	</div>

	<!-- Cropping modal -->
	<div class="modal fade" id="avatar-modal" aria-hidden="true"
	     aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="avatar-form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="avatar-modal-label">Upload a picture</h4>
					</div>
					<div class="modal-body">
						<div class="avatar-body">

							<!-- Upload image and data -->
							<div class="avatar-upload">
								<input type="hidden" class="avatar-src" name="avatar_src">
								<input type="hidden" class="avatar-data" name="avatar_data">
								<label for="avatarInput">Local upload</label>
								<input type="file" class="avatar-input" id="avatarInput"
								       name="avatar_file">
							</div>

							<div class="avatar-wrapper"></div>

							<div class="avatar-btns">
								<button type="submit"
								        class="btn btn-primary btn-block avatar-save">Done
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->

	<!-- Loading state -->
	<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>


<script src="/ji_js/cropper/cropper.min.js"></script>
<script src="/ji_js/ta/upload.js"></script>
