<?php
	//HEADER
	$header = [
		'alg' => 'HS256',
		'typ' => 'JWT'
	];

	//PAYLOAD
	$payload = [
		'first_name' => 'Eduardo',
		'last_name' => 'Mattos',
		'email' => 'qwerty@gmail.com'
	];

	$header = json_encode($header);
	$payload = json_encode($payload);

	echo "header: ".$header;
	echo "\n";
	echo "payload: ".$payload;
	echo "\n";

	$header = base64_encode($header);
	$payload = base64_encode($payload);

	echo "header -  base64: ".$header;
	echo "\n";
	echo "payload - base64: ".$payload;
	echo "\n";


	//SIGNATURE
	$key = "lkjsdhas889fashf8884jhds98";

	$signature = hash_hmac('sha256', "$header.$payload", $key, true);

	echo "signature: ".$signature;
	echo "\n";

	$signature = base64_encode($signature);
	echo "signature - base64: ".$signature;
	echo "\n\n\n";

	//TOKEN
	echo "$header.$payload.$signature";

?>