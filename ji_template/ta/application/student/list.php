<?php include 'header.php'; ?>

<link href="/ji_style/stu_app_apply.css" type="text/css" rel="stylesheet" />
<script src="/ji_js/stu_app_apply.js"></script>


<div class="apply" align="center">
	<table width="100%">
		<tr class="first">
			<td width="13%">Course ID</td>
			<td width="38%">Course Name</td>
			<td width="31%">Professor Name</td>
			<td width="18%">Application Status</td>
		</tr>
		<?php foreach($list as $item): ?>
			<tr>
				<td class="KCDM"><?=ucfirst(strtolower($item->KCDM))?></td>
				<td><?=ucwords($item->KCZWMC)?></td>
				<td><?=ucwords($item->XM)?></td>
				<?php
				if ( $item->status == '1' ) {
					?>
					<td>Open</td>
					<?php
				}else{
					?>
					<td>Close</td>
					<?php
				}
				?>
			</tr>
		<?php endforeach;?>
	</table>
</div>
</body>
</html>