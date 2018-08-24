<?php
class curl
{   
	var $cookie_file;  // ����Cookie�ļ�����·�����ļ���  
	function __construct()  
	{  

	}  
	// ģ���ȡ���ݺ���               
	function get($url)
	{      
		$curl = curl_init(); // ����һ��CURL�Ự      
		curl_setopt($curl, CURLOPT_URL, $url); // Ҫ���ʵĵ�ַ                  
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // ����֤֤����Դ�ļ��      
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // ��֤���м��SSL�����㷨�Ƿ����      
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // ģ���û�ʹ�õ������      
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		}   
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // �Զ�����Referer      
		curl_setopt($curl, CURLOPT_HTTPGET, 1); // ����һ�������Post����      
		curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file); // ��ȡ�����������Cookie��Ϣ      
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // ���ó�ʱ���Ʒ�ֹ��ѭ��      
		curl_setopt($curl, CURLOPT_HEADER, 0); // ��ʾ���ص�Header��������      
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ��ȡ����Ϣ���ļ�������ʽ����      
		$tmpInfo = curl_exec($curl); // ִ�в���      
		if (curl_errno($curl)) {      
		 echo 'Errno'.curl_error($curl);      
		}
		curl_close($curl); // �ر�CURL�Ự      
		return $tmpInfo; // ��������      
	}      
	 // ģ���ύ���ݺ���               
	function post($url,$data)
	{     
		$curl = curl_init(); // ����һ��CURL�Ự      
		curl_setopt($curl, CURLOPT_URL, $url); // Ҫ���ʵĵ�ַ                  
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // ����֤֤����Դ�ļ��      
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // ��֤���м��SSL�����㷨�Ƿ����      
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // ģ���û�ʹ�õ������      
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		}    
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // �Զ�����Referer      
		curl_setopt($curl, CURLOPT_POST, 1); // ����һ�������Post����      
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post�ύ�����ݰ�      
		curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file); // ��ȡ�����������Cookie��Ϣ      
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // ���ó�ʱ���Ʒ�ֹ��ѭ��      
		curl_setopt($curl, CURLOPT_HEADER, 0); // ��ʾ���ص�Header��������      
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ��ȡ����Ϣ���ļ�������ʽ����      
		$tmpInfo = curl_exec($curl); // ִ�в���      
		if (curl_errno($curl)) {      
		 return curl_error($curl);      
		}      
		curl_close($curl); // �ؼ�CURL�Ự      
		return $tmpInfo; // ��������      
	}
	function request($url, $method= 'GET', $post_fields = null, $time_out = 15, $header = null, $cookie = null,$useCert=false)
	{
		if (!function_exists('curl_init'))
		{
			exit('CURL not support');
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, $time_out);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		}
		if($useCert == true){
			//����֤��
			//ʹ��֤�飺cert �� key �ֱ���������.pem�ļ�
			curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLCERT, SSLCERT_PATH);
			curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLKEY, SSLKEY_PATH);
		}
		if('POST'==strtoupper($method)){
			curl_setopt($curl, CURLOPT_POST, TRUE);
		} else if('GET'==strtoupper($method)){
			curl_setopt($curl, CURLOPT_HTTPGET, true);
		} else{
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
		}
		if ($post_fields)
		{
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLINFO_HEADER_OUT, TRUE);
		if (isset($header) AND is_array($header))
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}

		if (substr($url, 0, 8) == 'https://')
		{
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			//curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		}

		if ($cookie AND is_array($cookie))
		{
			curl_setopt($curl, CURLOPT_COOKIE, urldecode(http_build_query($cookie, '', '; ')));
		}

		$response = curl_exec($curl);

		curl_close($curl);

		return $response;
	}
}