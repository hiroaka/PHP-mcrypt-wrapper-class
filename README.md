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

    int Crypt::extensionLoaded() Input None Output bool

    true if mcrypt extension is loaded

    false if mcrypt extension is not loaded

    array Crypt::listOptions() Input None Output string

    Outputs a list of options for the constructor

    array Crypt::modes() Input None Output array

    array of modes supported by php/mcrypt

    same as output from $class->listModes() & mcrypt_list_modes()

    array Crypt::algorithms() Input None Output array

    array of algorithms supported by php/mcrypt

    same as output from $class->listAlgorithms() & mcrypt_list_algorithms()

##Methods##

    bool __construct(array $params) Input array

    key        => string - (required) no default resized to fit appropriate key size

    mode       => must be a result of mcrypt_list_modes() - (optional) default: first result from mcrypt_list_modes()

    algorithm  => must be a result of mcrypt_list_algorithms() - (optional) default: first result from mcrypt_list_algorithms()

    base64     => true|false sets encoding of input/output to base 64 - (optional) default: true

    Output bool

    true on success of mcrypt_generic_init()

    false on fail of mcrypt_generic_init()

    die on no extension, modes, algorithms loaded or on lack of key param

    string encrypt(string $data) Input string

    plain text

    Output string

    encrypted string if base64 is false

    base64_encoded encrypted string if base64 is true

    string decrypt(string $data) Input string

    encrypted string if base64 is false

    base64_encoded encrypted string if base64 is true

    Output string

    plain text

    void close() Input None Output None
    array listModes() Input None Output array

    array of modes supported by php/mcrypt

    same as output from Crypt::modes() & mcrypt_list_modes()

    string getMode() Input None Output string

    string current mode

    string setMode(string $mode) Input string Output string

    string current mode. If setting failed it keeps & returns previous setting.

    Setting must be inside of array provided by $class->listModes() or Crypt::modes() or mcrypt_list_modes()

    array listAlgorithms() Input None Output array

    array of algorithms supported by php/mcrypt

    same as output from Crypt::algorithms() & mcrypt_list_algorithms()

    string getAlgorithm() Input None Output string

    string current algorithm

    string setAlgorithm(string $algorithm) Input string Output string

    string current algorithm. If setting failed it keeps & returns previous setting.

    Setting must be inside of array provided by $class->listAlgorithms() or Crypt::algorithms() or mcrypt_list_algorithms()

    bool getBase64Encoding() Input None Output bool

    bool current base64 setting

    bool setBase64Encoding(bool $bool) Input Output bool

    bool current base64 setting (default === true)

    int listKeySize() Input None Output int

    int key size for mode/algorithm combination


