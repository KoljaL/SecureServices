<!DOCTYPE html>
<html lang="de">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?=$pagename?>
	</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" type="image/svg+xml" href="assets/umuk.svg">
	<link rel="alternate icon" href="favicon.ico">
	<link rel="stylesheet" href="assets/style.css">
	<style>
		<?= pprint_css() ?>
		<?php color($color_set,'get_container_colors','') ?>
		<?php color($color_set, 'get_site_colors','') ?>
		<?=$edit_css ?>
	</style>
	
</head>

<body id="body" <?= $onloadURL2POST ?>>
	<div class="wrapper">
		<div class="header">
			<h1><a href="<?= $url ?>"><?=$pagename?></a></h1>
			<!-- ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾ USER_LINKS ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾ -->
			<div class="user_links">
				<div class="search">
					<input type="text" title="search" name="item_search" id="item_search" placeholder="search" oninput="item_search()">
					<fieldset id="search_frame">
						<legend>Results</legend>
						<div class="noscrollbar">
							<div id="search_results"></div>
						</div>
					</fieldset>
				</div>
				<?php if(isset($user_ID)): ?>
				<label class="header_button" for='new_entry' title="new Entry">&#9998;</label>
				<form action="<?= $url ?>" method="POST">
					<button name="show_edit_json" value="1" class="header_button" title="edit JSON Array" style="font-weight:bold;padding-bottom:4px">&#119973;</button>
				</form>
				<div>
					<form action="<?= $url ?>" method="post">
						<button name="logout" value="true" class="header_button" title="logout <?=$name?>" style="font-weight:bold;padding-bottom:2px">&#10008;</button>
					</form>
				</div>
				<?php else: ?>
				<label class="header_button" for="login_form">&#9998;</label>
				<input type="checkbox" id="login_form" class="hidden">
				<div class="login_form hidden">
					<form action="<?= $url ?>" method="POST">
						<input type="text" placeholder="name" name="u_name" value="">
						<input type="password" placeholder="password" name="u_password" value="">
						<button class="header_button">&#10004;</button>
					</form>
				</div>
				<?php endif ?>
				<div class="colorset">
					<form method="post" title="choose Colorset">
						<select name="colors" onchange="this.form.submit();">
							<option style='color: grey' value='Colors' disabled>Colors</option>
							<?= color($color_set, 'get_colorsets', ''); ?>
						</select>
					</form>
				</div>
				<form action="<?= $url ?>" method="POST">
					<input type="hidden" name="grid_style" value="<?= $grid_style_next ?>">
					<button class="header_button" title="toggle Grid-Style" style="font-weight:bold;padding-bottom:2px">#</button>
				</form>
				<div class="git_icon">
					<a href="https://github.com/KoljaL/SecureServices" target="_blank">
						<svg class=" " height="20" viewBox="0 0 16 16" version="1.1" width="20" aria-hidden="true">
							<path   fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
						</svg>
					</a>
				</div>
			</div>	
			<span id="timer"></span>

			<!-- _________________________________________________ USER_LINKS _________________________________________________ -->
		</div>
		<div class="message">
			<?= $message ?>
				<?php //pprint($debug_array, 0, 0, 0) ?>
				<?php //pprint($data_array, 0, 0, 1) ?>
				<?php //pprint($data, 0, 0, 0) ?>
				<?php //pprint($_POST, 0, 0, 0) ?>
		</div>
		<div class="content">
			<?php if($show_edit_json==true): ?>
			<div class="edit_json">
				<form action="<?= $url ?>" method="POST">
					
					<input type="text" name="searchin_json" placeholder="search" onkeydown="return event.key != 'Enter';" oninput="search_in_json()" id="searchin_json">
					<input type="button" class="header_button" style="font-weight: bold; padding-bottom: 4px;" id="dwn-btn" value="&#x2193;"/>
					<button class="header_button" style="font-weight: bold; padding-bottom: 4px;">&#x1F5AB;</button>
					<textarea id="edit_json" class="noscrollbar" name="edit_json" wrap="off" rows=30 cols=129></textarea>
				</form>
			</div>
			<?php endif ?>
			<div class="<?= $grid_style ?>" id="mansory">
				<!-- ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾ NEW_ENTRY_FORM ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾ -->
				<?php if(isset($user_ID)): ?>
				<input type="checkbox" id="new_entry" class="hidden" <?=$checked ?>>
				<section class="new_item_form hidden">
					<fieldset class="change_color">
						<legend class="change_color">
							<?=$entry_text?>
						</legend>
						<label class="close_new_item icon brighter" for='new_entry'>&#10008;</label>
						<form method="post" action="<?= $url ?>" onsubmit="return validateForm()" class="new_entry">
							<input type="checkbox" id="container_extra" class="hidden" <?=$container_extra_checkbox ?>>
							<input type="checkbox" id="item_extra" class="hidden" <?=$item_extra_checkbox ?>>
							<input type="hidden" id="c_id" name="container[id]" value="<?= $c_id ?>" class="hidden">
							<input type="hidden" id="i_id" name="item[id]" value="<?= $i_id ?>" class="hidden">
							<input type="hidden" id="form_case" name="form_case" value="<?= $form_case ?>" class="hidden">
							<div tabindex="0" id="container">
								<label for="container_select" class="change_color">Container</label>
								<label class="icon icon_more" for="container_extra">[...]</label>
								<label class="checkbox_del">
									<input type="checkbox" id="container_del" name="container[del]" class="icon_del brighter" value="1">
								</label>
								<input type="text" name="container[name]" id="container_input" value="<?= $c_name ?>" required />	<span class="dropdown">&nbsp;</span>
								<select class="container_select" name="container[id2]" id="container_select">
									<!-- name="container_select" -->
									<option disabled selected>select Container</option>
                                    <?php foreach ($data_array as $container=>$item): 
                                    if($container === 'config_params')continue; 
                                    $name = $item['name']; 
                                    $selected = ($name == $c_name) ? 'selected="selected"' : ''; 
                                    echo "<option id='{$item['color']}' style='color: {$item['color_hex']}' value='$name' onclick=\"setColor('$name','{$item['color_hex']}','{$item['id']}')\" $selected>$name</option>"; 
                                    endforeach ?>
                                </select>
							</div>
							<div tabindex="4" id="submit">
								<button>Send</button>
							</div>
							<div id="position">
								<label for="position_select" class="change_color">Position</label>
								<select name="container[position]" id="position_select">
									<option style="color: grey" value="1">first</option>
                                    <?php foreach ($data_array as $container=>$item): 
                                    if($container === 'config_params')continue; 
                                    $selected = ($c_pos == $item['position']) ? 'selected="selected"' : ''; 
                                    $next_position = $item['position'] + 4; 
                                    echo "<option style='color: {$item['color_hex']}' value='$next_position' $selected>{$item['name']} &#8680;</option>"; 
                                    endforeach ?>
                                </select>
							</div>
							<div tabindex="1" id="color">
								<label for="color_select" class="change_color">Color</label>
								<select name="container[color]" id="color_select">
									<option class='grey' value='Grey'>Grey</option>
									<?php color($color_set, 'container_color',$c_color_name); ?>
								</select>
							</div>
							<div id="hr" class="change_color"></div>
							<div id="name">
								<label for="name_input" class="change_color">Name</label>
								<label class="icon icon_more" for="item_extra">[...]</label>
								<label class="checkbox_del">
									<input type="checkbox" id="item_del" name="item[del]" class="icon_del brighter" value="1">
								</label>
								<input type="text" name="item[name]" id="name_input" value="<?= $i_name ?>" />
							</div>
							<div id="url">
								<label for="url_input" class="change_color">Link</label>
								<input type="text" name="item[url]" id="url_input" value="<?= $i_url ?>" />
							</div>
							<div id="user">
								<label for="user_input" class="change_color">User</label>
								<input type="text" name="item[user]" id="user_input" value="<?= $i_user ?>" />
							</div>
							<div id="password">
								<label for="password_input" class="change_color">Password</label>
								<input type="text" name="item[password]" id="password_input" value="<?= $i_pw ?>" />
							</div>
							<div id="post_data">
								<label for="post_data_text" class="change_color">POST Data</label>
								<textarea id="post_data_textarea" name="item[post_data_text]" placeholder="key: 'value',\nkey: 'value'"><?=$i_post_data ?></textarea>
							</div>
							<div id="notes">
								<label for="notes_text" class="change_color">Notes</label>
								<textarea id="notes_textarea" name="item[notes_text]"><?=$i_notes?></textarea>
							</div>
						</form>
					</fieldset>
				</section>
				<?php endif ?>
				<!-- _________________________________________________ NEW_ENTRY_FORM _________________________________________________ -->
				<!--<a href="#" onclick="URL2post('< ?php echo $param['url'] ?>', {< ?php echo $param['post_data'] ?>});">< ? php echo $param['name'] ?></a>-->
				<!-- ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾ CONTAINER ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾ -->
				<?php foreach ($data_array as $container=>$value): ?>
				<?php if($container==='config_params')continue; ?>
				<div class="container <?= $data_array[$container]['color'] ?>">
					<fieldset class="<?= $data_array[$container]['color'] ?>">
						<legend>
							<?=$data_array[$container]['name'] ?>
							<!-- < ?=$data_array[$container]['position'] ?> -->
						</legend>
						<div class="noscrollbar">
							<?php foreach ($value as $item=>$param): ?>
							<?php if(substr($item,0,2) !='I_')continue; ?>
							<!-- ITEMS  -->
							<div class="item task"  data-id="<?= $param['id'] ?>" >
								<?php if(!empty($param['icon']) and (exif_imagetype($param['icon']))): ?>
								<img title="<?= $param['icon'] ?>" src="<?= $param['icon'] ?>" width="16" height="16" />
								<?php else: ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="-2 -2 84 84" version="1.1">
									<path fill="transparent" stroke="<?= $data_array[$container]['color_hex'] ?>" stroke-width="3" d="M 80 40 A 40 40 90 1 0 0 40 M 80 40 A 40 40 90 1 1 0 40 M 40 80 A 48 40 90 0 1 40 0 M 40 80 A 48 40 90 0 0 40 0 M 7.5 17 L 72.5 17 M 0 40 L 80 40 M 7.5 63 L 72.5 63" /> 
								</svg>
								<?php endif ?> 
								<div class="item_link">
						            <?php if(!empty($param['post_data'])): ?>
						     		<form class="url2post" method="post">
									     <input type="hidden" name="url2post" value="<?= $param['id'] ?>">
									     <a href="#" onclick="document.getElementById('url2post').submit();"><?= $param['name'] ?></a>
									</form>
									<?php else: ?>
						                <a href="<?= $param['url'] ?>"target="_blank" > <?= $param['name'] ?> </a>
					                <?php endif ?>
								</div> 

								
								<div class="no_touch_device" style="visibility:hidden">		 
									<label class="tooltip icon" onmousedown="show_tooltip('<?= $param['id'] ?>');">&nbsp; &#8801;</label>
									<div class="<?= $data_array[$container]['color'] ?> tooltip" id="<?= $param['id'] ?>"> <?= trim( $param['notes']) ?> </div>
									<?php if(isset($user_ID)): ?>
									<div class="edit_item_icon">
										<form action='' method='post'>
											<button type='submit' name='edit' value='<?= $param['id'] ?>' class='icon'>✎</button>
										</form>
									</div>
									<?php endif ?>
								</div>

							</div>
							<!-- ITEMS  -->
							<?php endforeach; ?>
						</div>
					</fieldset>
				</div>
				<?php endforeach ?>
				<nav id="context-menu" class="context-menu">
					<!-- <ul class="context-menu__items">
						<li class="context-menu__item">
							<a href="#" class="context-menu__link" data-action="View"><i class="fa fa-eye"></i></a>
						</li>
					</ul> -->
				</nav>

				<!-- _________________________________________________ CONTAINER _________________________________________________ -->
			</div>
			<!--MANSORY-->
		</div>
		<!--CONTENT-->
	</div>
	<!--WRAPPER-->
	<?=$URL2POST ?>
		<script>
			// sessiontime for counter
			var count = <?= $session_lenght ?>;
		</script>
		<script src="assets/functions.js"></script>
		<script>
			// JSON Object for edit json in textarea
			 var myJsObj = <?= json_encode($edit_json_data) ?>;
			 <?= $edit_json_call ?>
		</script>
</body>

</html>