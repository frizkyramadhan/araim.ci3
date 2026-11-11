<?php
$hero_employee_id = isset($hero_employee_id) ? $hero_employee_id : '';
$error = isset($error) ? $error : '';
?>
<?php if ($error !== ''): ?>
<div class="control-group">
	<div class="controls">
		<div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
	</div>
</div>
<?php endif; ?>
<div class="control-group">
	<label class="control-label">Arka Hero</label>
	<div class="controls">
		<input type="text" class="span6" id="hero-search" placeholder="Name or current NIK" autocomplete="off" />
		<input type="hidden" name="hero_employee_id" id="hero_employee_id" value="<?php echo htmlspecialchars($hero_employee_id, ENT_QUOTES, 'UTF-8'); ?>" />
		<p class="help-block">Search by name or the NIK that is current in Arka Hero. The saved link is the Hero employee id. The NIK field below is only ARAIM's copy and can stay stale.</p>
		<p id="hero-picked">
			<?php if ($hero_employee_id !== ''): ?>
			Stored Hero employee id: <?php echo htmlspecialchars($hero_employee_id, ENT_QUOTES, 'UTF-8'); ?>
			<?php endif; ?>
		</p>
		<ul id="hero-results" class="unstyled"></ul>
		<button type="button" class="btn btn-mini" id="hero-clear">Clear link</button>
	</div>
</div>
<script type="text/javascript">
(function ($) {
	var timer = null;
	var searchUrl = <?php echo json_encode(site_url('karyawan/search_hero')); ?>;

	function render(people) {
		var list = $('#hero-results');
		list.empty();
		if (!people || !people.length) {
			list.append($('<li/>').text('No matching Arka Hero person.'));
			return;
		}
		$.each(people, function (_, person) {
			var button = $('<button type="button" class="btn btn-mini"/>').text(person.name + ' — NIK ' + person.nik);
			button.on('click', function () {
				$('#hero_employee_id').val(person.id);
				$('#hero-picked').text('Linked to ' + person.name + ' (NIK ' + person.nik + '). Stored Hero employee id: ' + person.id);
				$('input[name="nik"]').val(person.nik);
				$('input[name="nama"]').val(person.name);
				list.empty();
			});
			list.append($('<li/>').append(button));
		});
	}

	$('#hero-search').on('keyup', function () {
		var q = $.trim($(this).val());
		clearTimeout(timer);
		if (q.length < 2) {
			$('#hero-results').empty();
			return;
		}
		timer = setTimeout(function () {
			$.getJSON(searchUrl, { q: q }, function (res) {
				render(res && res.data ? res.data : []);
			}).fail(function () {
				$('#hero-results').empty().append($('<li/>').text('Arka Hero search failed.'));
			});
		}, 300);
	});

	$('#hero-clear').on('click', function () {
		$('#hero_employee_id').val('');
		$('#hero-picked').text('No Hero employee linked.');
		$('#hero-results').empty();
	});
})(jQuery);
</script>
