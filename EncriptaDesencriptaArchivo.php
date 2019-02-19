<?php
    // fuente: http://www.rephp.com/el-mejor-enfoque-para-encriptar-archivos-grandes-con-php.html
    $key = '3da541559918a808c2402bba5012f6c60b27661c'; // Your encryption key
    $filecrypt->encryptFileChunks('I-still-loooove-hula-hoop.gif', 'encrypted.gif', $key);
    $filecrypt->decryptFileChunks('encrypted.gif', 'decrypted.gif', $key);
 ?>



 <?php

   $filecrypt = new filecrypt();
    class filecrypt{
     var $_CHUNK_SIZE; function __construct(){ $this->_CHUNK_SIZE = 100*1024; // 100Kb
     }
     public function encrypt($string, $key){ $key = pack('H*', $key);
     if (extension_loaded('mcrypt') === true)
     return mcrypt_encrypt(MCRYPT_BLOWFISH, substr($key, 0, mcrypt_get_key_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB)), $string, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND));
     return false;
     }

     public function decrypt($string, $key){
      $key = pack('H*', $key);
       if (extension_loaded('mcrypt') === true) return mcrypt_decrypt(MCRYPT_BLOWFISH, substr($key, 0, mcrypt_get_key_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB)), $string, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND));
       return false;
     }

     public function encryptFileChunks($source, $destination, $key){
        return $this->cryptFileChunks($source, $destination, $key, 'encrypt');
      }

      public function decryptFileChunks($source, $destination, $key){
         return $this>cryptFileChunks($source, $destination, $key, 'decrypt');
       }
       private function cryptFileChunks($source, $destination, $key, $op){
       if($op != "encrypt" and $op != "decrypt") return false;
       $buffer = '';
       $inHandle = fopen($source, 'rb');
       $outHandle = fopen($destination, 'wb+');
       if ($inHandle === false) return false;
       if ($outHandle === false)  return false;
        while(!feof($inHandle)){
          $buffer = fread($inHandle, $this->_CHUNK_SIZE); if($op == "encrypt") $buffer = $this->encrypt($buffer, $key);
           elseif($op == "decrypt") $buffer = $this->decrypt($buffer, $key);
           fwrite($outHandle, $buffer);
         } fclose($inHandle);
         fclose($outHandle);
         return true;
       }

       public function printFileChunks($source, $key){
       $buffer = ''; $inHandle = fopen($source, 'rb');
        if ($inHandle === false) return false;
        while(!feof($inHandle))
        {
          $buffer = fread($inHandle, $this->_CHUNK_SIZE);
          $buffer = $this->decrypt($buffer, $key);
          echo $buffer;
        }
        return fclose($inHandle);
       }
     }
   ?>
