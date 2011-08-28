##Simple Usage##

    require('../Crypt.php')  ;

    $options = array(
        'key'       => 'herp derp gerp lerp', # required
	    'mode'      => 'ecb',                 # optional
	    'algorithm' => 'blowfish',            # optional
	    'base64'    => true                   # optional default
    );

    $crypt = new Crypt($options);
    $data = $crypt->encrypt('TOP SECRET blah blah blah');
    echo $data; # 13Tt9Omi1uDsWlraXzuHUW6i2O1cySZ6U5dOO7FatCI= 
    echo $crypt->decrypt($data); # TOP SECRET blah blah blah
    echo $crypt->getMode(); # ecb
    echo $crypt->getAlgorithm(); # blowfish
    echo $crypt->getBase64Encoding(); # 1
    $crypt->close(); # Close

##Options##

    key        => string - (required) no default resized to fit appropriate key size
    mode       => must be a result of mcrypt_list_modes() - (optional) default: first result from mcrypt_list_modes()
    algorithm  => must be a result of mcrypt_list_algorithms() - (optional) default: first result from mcrypt_list_algorithms()
    base64     => bool sets encoding of input/output to base 64 - (optional) default: true

##Static Methods##

__bool__ `Crypt::extensionLoaded()`

__array__ `Crypt::listOptions()`

__array__ `Crypt::modes()`

__array__ `Crypt::algorithms()`


##Methods##

__bool__ `__construct(array $params)`
    
__string__ `encrypt(string $data)`
    
__string__ `decrypt(string $data)`

__void__ `close()`

__array__ `listModes()`
    
__string__ `getMode()`

__string__ `setMode(string $mode)`

__array__ `listAlgorithms()`

__string__ `getAlgorithm()`

__string__ `setAlgorithm(string $algorithm)`

__bool__ `getBase64Encoding()`

__bool__ `setBase64Encoding(bool $bool)`

__int__ `listKeySize()`

