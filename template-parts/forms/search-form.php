<?php ?>

<form role="search" method="get" class="search_form SearchForm" action="<?php echo get_site_url(); ?>">
	<label class="search_form__label"></label>
	<input class="search_form__field SearchField" placeholder="Поиск…" value="" name="s" type="search">
	<div class="search_form__button_container">
		<input class="search_form__button_submit" value="" type="submit">
		<span class="search_form__button_icon">
			<svg><use href="#search"></use></svg>
		</span>
	</div>
</form>
