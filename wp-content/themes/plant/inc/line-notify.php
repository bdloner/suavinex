<?php

/**
 * Send Line Notify
 */
function line_notify_massage( $massage, $image_path, $token ){
	$api_url = 'https://notify-api.line.me/api/notify';
	if( $image_path != '' ) {
		$massage_push = array(
			'imageFile' => curl_file_create( $image_path ),
			'message' => $massage
		);
	} else {
		$massage_push = array(
			'message' => $massage
		);	
	}
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, $api_url );
	curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'POST' );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $massage_push );
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: multipart/form-data',
		'Authorization: Bearer ' . $token
	) );
	$result_callback = curl_exec( $curl );
	if( curl_errno( $curl ) ){
		wp_die( __( curl_error( $curl ) ), __( 'Error' ), array( 'response' => 403 ) );
	}
	curl_close( $curl );
}

/**
 * Send Line after submission
 */

add_action( 'forminator_form_after_handle_submit', 'sp_send_line', 10, 2 );
add_action( 'forminator_form_after_save_entry', 'sp_send_line', 10, 2 );

function sp_send_line($form_id, $response) {

	if ( !$response['success'] ) return;	

	// เริ่มเก็บข้อมูล
	$vars 		= filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$page_id 	= $vars['page_id'];
	$token 		= get_field('line_notify_token', $page_id);

	// ถ้าไม่ใส่ Line Token ก็ไม่ต้องส่ง
	if ( !$token  ) return;

	$fields 	= explode(',', get_field('fields', $page_id));
	$fields 	= array_map('trim', $fields);
	$labels 	= explode(',', get_field('labels', $page_id));
	$labels 	= array_map('trim', $labels);
	
	if (!$fields) {
		$fields = ['textarea-1', 'radio-1', 'name-1', 'email-1', 'number-2', 'upload-1', 'textarea-2'];
	}
	if (!$labels) {
		$labels = ['คำสั่งซื้อ', 'ช่องทางการชำระเงิน', 'ชื่อ', 'อีเมล', 'เบอร์โทร', 'สลิป', 'ที่อยู่'];
	}

	$entries = Forminator_API::get_entries( $form_id );
	$count = 0;
	
	foreach( $entries as $entry ): 

		$count++;
		$meta = (array) $entry->meta_data;

		// เช็คว่าข้อมูลที่ Post ตรงกับรายการสั่งซื้อใน Entry นี้
		if ( $vars['email-1'] == $meta['email-1']['value'] &&  $vars['number-2'] == $meta['number-2']['value']) {

			$massage = "#" . $entry->entry_id;
			foreach( $meta as $key => $value ) {
				if( in_array( $key, $fields ) ) {
					$label = $labels[array_search( $key , $fields)];
					if (isset( $key )) {
						if(  $key != 'upload-1' ) {
							// ไม่ใช่ไฟล์
							$massage .= "\n" . $label .": " . $value['value'];
						} else {
							// เป้นไฟล์แนบ
							$file_path =  $value['value']['file']['file_path'][0];
							if (strpos($file_path,'.png') || strpos($file_path,'.jpg') || strpos($image_path,'.jpeg')) {
								// เป็นรูปภาพ
								$image_path = $file_path;
							} else {
								// เป็นไฟล์ชนิดอื่น เช่น PDF
								$massage .= "\n" . $label .": " . $value['value']['file']['file_url'][0];
							}
						}
					}
				}
			}

			break;
		} 

		// ค้นหาแค่ 5 รายการล่าสุดเท่านั้น เพื่อไม่ให้ระบบโหลดเกินไป
		if( $count > 5 ) break;

	endforeach;

	// ส่งไลน์
	line_notify_massage( $massage, $image_path, $token );
}