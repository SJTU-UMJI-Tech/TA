<?php include 'header.php'; ?>

<link href="/ji_style/ta/application/student/stu_app_apply.css" type="text/css" rel="stylesheet"/>
<script src="/ji_js/ta/application/student/stu_app_apply.js"></script>


<div class="apply" align="center">
	<table width="100%">
		<tr class="first">
			<td width="13%">Course ID</td>
			<td width="38%">Course Name</td>
			<td width="31%">Professor Name</td>
			<td width="18%">Application Status</td>
		</tr>
		<?php foreach ($open_list as $item): ?>
			<? /** @var $item Course_application_obj */ ?>
			<tr class="apply-list" lid="<?=$item->id ?>">
				<td class="KCDM"><?= $item->KCDM ?></td>
				<td><?= $item->KCZWMC ?></td>
				<td><?= $item->XM ?></td>
				<td><?= $item->state == 0 ? 'open' : 'close'; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
</body>
</html>