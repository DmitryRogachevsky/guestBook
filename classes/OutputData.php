<?php
class OutputData extends DataProcessing{

	public function builtInputBlock(){
		$block = "";
		$block .= '
		<form action="" method="post" class="form" id="form__reviews" enctype="application/x-www-form-urlencoded">
		<p>Имя</p>
		<input type="text" id="input__name" name="user_name" value="">
		<p>Содержание</p>
		<textarea name="message" id="reviews"></textarea>;
		<input type="submit" id="button__send" value="Отправить" >
		</form>';	
		return $block;
	}

	public function buildOutputBlock($order){
		$block = "";
        $rows = parent::sortData($order);
		foreach ($rows as $row){		
			$block .= '
			<div class="item__reviews">
			<p class="name" id="name">' . $row['user_name'] . '</p>
			<p id="date">' . $row['date'] . '</p>
			<p id="textReviews">' . $row['message'] . '</p>
			</div>';
		}
		return $block;
	}


}
