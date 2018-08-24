<?php
/**
 * Memcache ������
 *
 * ��config�ļ��� ���
     ��Ӧ����(����չΪ��memcache server)
    define('$this->memcache['host']', '10.35.52.33');
    define('$this->memcache['port']', 11211);
    define('$this->memcache['expiration']', 0);
    define('$this->memcache['prefix']', 'licai');
    define('$this->memcache['compression']', FALSE);
    demo:
        $cacheObj = new framework_base_memcached();        
        $cacheObj -> set('keyName','this is value');
        $cacheObj -> get('keyName');
        exit;
 * @access  public
 * @return  object
 * @date    2012-07-02
 */
class memcache{
 
	private $local_cache = array();
    private $m;
    private $client_type;
    protected $errors = array();
    protected $memcache=array();
     
    public function __construct($memcache)
    {
        $this->client_type = class_exists('Memcache') ? "Memcache" : (class_exists('Memcached') ? "Memcached" : FALSE);
        $this->memcache=$memcache;
        if($this->client_type)
        {
            // �ж���������
            switch($this->client_type)
            {
                case 'Memcached':
                    $this->m = new Memcached();
                    break;
                case 'Memcache':
                    $this->m = new Memcache();
                    // if (auto_compress_tresh){
                        // $this->setcompressthreshold(auto_compress_tresh, auto_compress_savings);
                    // }
                    break;
            }
            $this->auto_connect();  
        }
        else
        {
            echo 'ERROR: Failed to load Memcached or Memcache Class (��_��)';
            exit;
        }
    }
     
    /**
     * @Name: auto_connect
     * @param:none
     * @todu ����memcache server
     * @return : none
     * add by cheng.yafei
    **/
    private function auto_connect()
    {
        $configServer = array(
                                'host' => $this->memcache['host'],
                                'port' => $this->memcache['port'],
                                'weight' => 1,
                            );
        if(!$this->add_server($configServer)){
            echo 'ERROR: Could not connect to the server named '.$this->memcache['host'];
        }else{
            //echo 'SUCCESS:Successfully connect to the server named '.$this->memcache['host'];  
        }
    }
     
    /**
     * @Name: add_server
     * @param:none
     * @todu ����memcache server
     * @return : TRUE or FALSE
     * add by cheng.yafei
    **/
    public function add_server($server){
        extract($server);
        return $this->m->addServer($host, $port, $weight);
    }
     
    /**
     * @Name: add_server
     * @todu ���
     * @param:$key key
     * @param:$value ֵ
     * @param:$expiration ����ʱ��
     * @return : TRUE or FALSE
     * add by cheng.yafei
    **/
    public function add($key = NULL, $value = NULL, $expiration = 0)
    {
        if(is_null($expiration)){
            $expiration = $this->memcache['expiration'];
        }
        if(is_array($key))
        {
            foreach($key as $multi){
                if(!isset($multi['expiration']) || $multi['expiration'] == ''){
                    $multi['expiration'] = $this->memcache['expiration'];
                }
                $this->add($this->key_name($multi['key']), $multi['value'], $multi['expiration']);
            }
        }else{
            $this->local_cache[$this->key_name($key)] = $value;
            switch($this->client_type){
                case 'Memcache':
                    $add_status = $this->m->add($this->key_name($key), $value, $this->memcache['compression'], $expiration);
                    break;
                     
                default:
                case 'Memcached':
                    $add_status = $this->m->add($this->key_name($key), $value, $expiration);
                    break;
            }
             
            return $add_status;
        }
    }
     
    /**
     * @Name   ��add����,���������д˼�ֵʱ�Կ�д���滻
     * @param  $key key
     * @param  $value ֵ
     * @param  $expiration ����ʱ��
     * @return TRUE or FALSE
     * add by cheng.yafei
    **/
    public function set($key = NULL, $value = NULL, $expiration = NULL)
    {
        if(is_null($expiration)){
            $expiration = $this->memcache['expiration'];
        }
        if(is_array($key))
        {
            foreach($key as $multi){
                if(!isset($multi['expiration']) || $multi['expiration'] == ''){
                    $multi['expiration'] = $this->config['config']['expiration'];
                }
                $this->set($this->key_name($multi['key']), $multi['value'], $multi['expiration']);
            }
        }else{
            $this->local_cache[$this->key_name($key)] = $value;
            switch($this->client_type){
                case 'Memcache':
                    $add_status = $this->m->set($this->key_name($key), $value, $this->memcache['compression'], $expiration);
                    break;
                case 'Memcached':
                    $add_status = $this->m->set($this->key_name($key), $value, $expiration);
                    break;
            }
            return $add_status;
        }
    }
     
    /**
     * @Name   get ���ݼ�����ȡֵ
     * @param  $key key
     * @return array OR json object OR string...
     * add by cheng.yafei
    **/
    public function get($key = NULL)
    {
        if($this->m)
        {
            if(isset($this->local_cache[$this->key_name($key)]))
            {
                return $this->local_cache[$this->key_name($key)];
            }
            if(is_null($key)){
                $this->errors[] = 'The key value cannot be NULL';
                return FALSE;
            }
             
            if(is_array($key)){
                foreach($key as $n=>$k){
                    $key[$n] = $this->key_name($k);
                }
                return $this->m->getMulti($key);
            }else{
                return $this->m->get($this->key_name($key));
            }
        }else{
            return FALSE;
        }      
    }
     
    /**
     * @Name   delete
     * @param  $key key
     * @param  $expiration ����˵ȴ�ɾ����Ԫ�ص���ʱ��
     * @return true OR false
     * add by cheng.yafei
    **/
    public function delete($key, $expiration = NULL)
    {
        if(is_null($key))
        {
            $this->errors[] = 'The key value cannot be NULL';
            return FALSE;
        }
         
        if(is_null($expiration))
        {
            $expiration = $this->memcache['expiration'];
        }
         
        if(is_array($key))
        {
            foreach($key as $multi)
            {
                $this->delete($multi, $expiration);
            }
        }
        else
        {
            unset($this->local_cache[$this->key_name($key)]);
            return $this->m->delete($this->key_name($key), $expiration);
        }
    }
     
    /**
     * @Name   replace
     * @param  $key Ҫ�滻��key
     * @param  $value Ҫ�滻��value
     * @param  $expiration ����ʱ��
     * @return none
     * add by cheng.yafei
    **/
    public function replace($key = NULL, $value = NULL, $expiration = NULL)
    {
        if(is_null($expiration)){
            $expiration = $this->memcache['expiration'];
        }
        if(is_array($key)){
            foreach($key as $multi) {
                if(!isset($multi['expiration']) || $multi['expiration'] == ''){
                    $multi['expiration'] = $this->config['config']['expiration'];
                }
                $this->replace($multi['key'], $multi['value'], $multi['expiration']);
            }
        }else{
            $this->local_cache[$this->key_name($key)] = $value;
             
            switch($this->client_type){
                case 'Memcache':
                    $replace_status = $this->m->replace($this->key_name($key), $value, $this->memcache['compression'], $expiration);
                    break;
                case 'Memcached':
                    $replace_status = $this->m->replace($this->key_name($key), $value, $expiration);
                    break;
            }
             
            return $replace_status;
        }
    }
     
    /**
     * @Name   replace ������л���
     * @return none
     * add by cheng.yafei
    **/
    public function flush()
    {
        return $this->m->flush();
    }
     
    /**
     * @Name   ��ȡ�������������з������İ汾��Ϣ
    **/
    public function getversion()
    {
        return $this->m->getVersion();
    }
     
     
    /**
     * @Name   ��ȡ�������ص�ͳ����Ϣ
    **/
    public function getstats($type="items")
    {
        switch($this->client_type)
        {
            case 'Memcache':
                $stats = $this->m->getStats($type);
                break;
             
            default:
            case 'Memcached':
                $stats = $this->m->getStats();
                break;
        }
        return $stats;
    }
     
    /**
     * @Name: ������ֵ�Զ�ѹ��
     * @param:$tresh ���ƶ��ֵ�����Զ�ѹ������ֵ��
     * @param:$savings ָ������ѹ��ʵ�ʴ洢��ֵ��ѹ���ʣ�ֵ������0��1֮�䡣Ĭ��ֵ0.2��ʾ20%ѹ���ʡ�
     * @return : true OR false
     * add by cheng.yafei
    **/
    public function setcompressthreshold($tresh, $savings=0.2)
    {
        switch($this->client_type)
        {
            case 'Memcache':
                $setcompressthreshold_status = $this->m->setCompressThreshold($tresh, $savings=0.2);
                break;
                 
            default:
                $setcompressthreshold_status = TRUE;
                break;
        }
        return $setcompressthreshold_status;
    }
     
    /**
     * @Name: ����md5���ܺ��Ψһ��ֵ
     * @param:$key key
     * @return : md5 string
     * add by cheng.yafei
    **/
    private function key_name($key)
    {
        return md5(strtolower($this->memcache['prefix'].$key));
    }
     
    /**
     * @Name: ���Ѵ���Ԫ�غ�׷������
     * @param:$key key
     * @param:$value value
     * @return : true OR false
     * add by cheng.yafei
    **/
    public function append($key = NULL, $value = NULL)
    {
			$this->local_cache[$this->key_name($key)] = $value;
             
            switch($this->client_type)
            {
                case 'Memcache':
                    $append_status = $this->m->append($this->key_name($key), $value);
                    break;
                 
                default:
                case 'Memcached':
                    $append_status = $this->m->append($this->key_name($key), $value);
                    break;
            }
             
            return $append_status;
    }//END append
 
 
}// END class

?>