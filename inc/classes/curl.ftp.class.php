<?php

/*
 * To change this template, choose Tools | Templates
 * ftp curl����������
 */
class ftp{
    //FTP��������ַ
    public static $host = "114.215.139.175";
    //FTP�˿�
    public static $port = "21";
    //�ϴ���FTPĿ¼
    public static $uploaddir = "";
    //��ȡ��FTPĿ¼
    public static $readdir = "";
    //FTP�û���
    public static $usrname = "mukecms";
    //FTP����
    public static $pwd = "limengqi";
    /*
     * curl �������ļ��ϴ���FTP������
     * $filename�ϴ���FTP���ļ�����$uploadfile������Ҫ�ϴ��ļ��ĵ�ַ�����õľ���·����
     */
    public static function ftp_upload($filename,$uploadfile)
    {
        $url = "ftp://".self::$host.":".self::$port."/".self::$uploaddir."/".$filename;
        //��Ҫ�ϴ����ļ�
        $fp = fopen ($uploadfile, "r"); 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_VERBOSE, 1);  //�����ⷢ���򱨵� 
        curl_setopt($ch, CURLOPT_USERPWD, self::$usrname.':'.self::$pwd); //FTP��½�˺����룬ģ���½ 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_PUT, 1); //��HTTP�ϴ�һ���ļ� 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //����� 
        curl_setopt($ch, CURLOPT_INFILE, $fp); //Ҫ�ϴ����ļ� 
        $http_result = curl_exec($ch); //ִ�� 
        $error = curl_error($ch); 
        curl_close($ch); 
        fclose($fp);
        //�ɹ��ϴ��ļ� ����true
        if (!$error) 
        { 
            return true;
        }
     }
    /*
     * curl ��������ȡFTP�ļ��������ڱ���ʹ��
     * $filenameFTP�������ļ�����$filepath ���浽���أ�����������Ŀ¼
     */    
    public static function ftp_read($filename,$filepath)
    {       
        $curl = curl_init(); 
        
        $target_ftp_file = "ftp://".self::$host.":".self::$port."/".self::$readdir."/".$filename;//����·��
        curl_setopt($curl, CURLOPT_URL,$target_ftp_file);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_FTP_USE_EPSV, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 300); // times out after 300s
        curl_setopt($curl, CURLOPT_USERPWD,self::$usrname.':'.self::$pwd);//FTP�û���������
        // Sets up the output file
        //���ر���Ŀ¼
        if(is_dir($filepath)){
         $outfile = fopen($filepath.$filename, 'w');//���浽���ص��ļ���
         curl_setopt($curl,CURLOPT_FILE,$outfile);
         // Executes the cURL 
         $info = curl_exec($curl);
         fclose($outfile);
         $error_no = curl_errno($curl);
         curl_close($curl);
         //�ɹ���ȡ�ļ������� true
         if($info){
             return true;
         }
        }        
     }
}
?>
