<?php
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//					   	   ___            _               _      _                                                         //
	//					   	  / _ \__ _ _   _| | ___   /\   /(_) ___| |_ ___  _ __ 			/	   /  \                        //
	//					   	 / /_)/ _` | | | | |/ _ \  \ \ / / |/ __| __/ _ \| '__|		   /	  /    \                       //
	//					   	/ ___/ (_| | |_| | | (_) |  \ V /| | (__| |_ (_) | |   		   \     /     /                       //
	//					   	\/    \__,_|\__,_|_|\___/    \_/ |_|\___|\__\___/|_|   			\   /	  /                        //
	//					   																									   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////                   System made by Paulo Victor - Skype: traindesign                   ////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	include 'Radio.class.php';

    $Radio = new Radio();

	$array = $Radio->Connection();

	$speaker = $array->speaker;

	$program = $array->program;

	$listeners = $array->listeners;

	$music = $array->music;

	$get = (int) isset($_GET['get']) ? strip_tags($_GET['get']) : 1;

	if($get == 1):

		$data = array(

			'speaker' => $speaker,

			'program' => $program,

			'listeners' => $listeners,

			'music' => $music,

		);

		echo json_encode($data);

		header("Content-type: application/json");

	elseif($get == 2):

		$type = isset($_GET['type']) ? strip_tags($_GET['type']) : '';

		switch ($type){

			case 'speaker':
				echo $speaker;
				break;

			case 'program':
				echo $program;
				break;

			case 'listeners':
				echo $listeners;
				break;

			case 'music':
				echo $music;
				break;	

		}

	endif;

?>