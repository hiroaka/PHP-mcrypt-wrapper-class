<?php
class Crypt{
    
    private $key;
    private $resource;
    private $iv_size;
    private $iv;
    private $algorithms;
    private $algorithm;
    private $modes;
    private $mode;
    private $base64 = true;
    
    public function __construct($options){
        if(!extension_loaded('mcrypt')){ die('mcrypt is required for this script'); }
        if(!count(mcrypt_list_algorithms())){ die('there are no available algorithms'); }
        if(!count(mcrypt_list_modes())){ die('there are no available modes'); }
        if(!array_key_exists('key', $options)){
            die('- You Must Submit a Key - <pre>$crypt = new Crypt(array(\'key\' => \'this is my key...\'));</pre>');
        }
        $this->algorithms = mcrypt_list_algorithms();
        $this->algorithm = (isset($options['algorithm']) && in_array($options['algorithm'], $this->algorithms)) ? $options['algorithm'] : $this->algorithms[0];
        $this->modes = mcrypt_list_modes();
        $this->mode = (isset($options['mode']) && in_array($options['mode'], $this->modes)) ? $options['mode'] : $this->modes[0];
        $this->key = $options['key'];
        if(isset($options['base64']) && $options['base64'] === false){
         $this->base64 = false;
        }
        return $this->start();
    }
    
    private function start(){
        $this->resource = mcrypt_module_open($this->algorithm, '', $this->mode, '');
        $this->key = substr($this->key, 0, mcrypt_enc_get_key_size($this->resource));
        $this->iv_size = mcrypt_enc_get_iv_size($this->resource);
        $this->iv = mcrypt_create_iv($this->iv_size, MCRYPT_RAND);
        return mcrypt_generic_init($this->resource, $this->key, $this->iv);
    }
    
    public function encrypt($data){
        mcrypt_generic_init($this->resource, $this->key, $this->iv);
        if($this->base64){
            $encrypted = base64_encode(mcrypt_generic($this->resource, $data));
        }else{
            $encrypted = mcrypt_generic($this->resource, $data);
        }
        return $encrypted;
    }
    
    public function decrypt($data){
        mcrypt_generic_init($this->resource, $this->key, $this->iv);
        if($this->base64){
            $decrypted = mdecrypt_generic($this->resource, base64_decode($data));
        }else{
            $decrypted = mdecrypt_generic($this->resource, $data);
        }
        return $decrypted;
    }
    
    public function close(){
        @mcrypt_generic_deinit($this->resource);
        @mcrypt_module_close($this->resource);
    }
    
    public function listModes(){
        return $this->modes;
    }
    
    public function listAlgorithms(){
        return $this->algorithms;
    }
    
    public function getMode(){
        return $this->mode;
    }
    
    public function getAlgorithm(){
        return $this->algorithm;
    }

    public function getBase64Encoding(){
      return $this->base64;
    }
    
    public function setMode($mode){
        $this->mode = (in_array($mode, $this->modes)) ? $mode : $this->modes[0];
        $this->close();
        $this->start();
        return $this->mode;
    }
    
    public function setAlgorithm($algorithm){
        $this->algorithm = (in_array($algorithm, $this->algorithms)) ? $algorithm : $this->algorithms[0];
        $this->close();
        $this->start();
        return $this->algorithm;
    }

    public function setBase64Encoding($base64){
      $this->base64 = ($base64) ? true : false;
      return $this->base64;
    }
}
?>
