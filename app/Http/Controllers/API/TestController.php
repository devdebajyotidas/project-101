<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Qafeen\Aadhaar\Aadhaar;

require_once public_path().'/aadhaar/xmlseclibs/xmlseclibs.php';
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

class TestController extends Controller
{


    public function __construct()
    {
        date_default_timezone_set("Asia/Calcutta");

        global $globapublic_cert_path,$p12_file,$aadhaar_no,$api_version,$asa_licence_key,$lk,$ac,$sa,$txn,$tid,$private_key_path,$public_cert_path,$public_cert_path,$ts,$path;

        $path=public_path().'/aadhaar/';

        $globapublic_cert_path = $path.'certs/uidai_auth_stage.cer';
// certificate file locations

        $p12_file = $path.'certs/Staging_Signature_PrivateKey.p12';

// set variables
        $aadhaar_no = '999999990019';
        $api_version = "1.6";
        $asa_licence_key = "MG41KIrkk5moCkcO8w-2fc01-P7I5S-6X2-X7luVcDgZyOa2LXs3ELI";
        $lk = "MEaMX8fkRa6PqsqK6wGMrEXcXFl_oXHA-YuknI2uf0gKgZ80HaZgG3A";
        $ac = "public";
        $sa = "public";
        $tid = "public";
        $private_key_path = $path.'certs/public_key.cer';
        $private_cert_path = $path.'certs/private_cer.pem';
        $public_cert_path = $path.'certs/uidai_auth_stage.cer';
        $txn = "AuthDemoClient:public:".date("Ymdhms");
        $ts = date('Y-m-d').'T'.date('H:i:s');
    }

    function ping(){
        return response()->json(['status' => 'Ok'], 201);
    }

    function post_test(Request $request){
        return $request->all();
    }

    public static function testaadhaar(Request $request)
    {
        require_once public_path().'/aadhaar/aadhaar.php';
        try{
            return verification();
        }catch (\Exception $exception){
            dd($exception);
        }
    }





//    function testaadhaar(){
//        $output=new \stdClass();
//
//        global $ac,$lk,$sa,$txn,$aadhaar_no,$asa_licence_key,$api_version,$p12_file;
//
//// PID Block
/*        $pid_block='<?xml version="1.0"?><ns2:Pid ts="2016-10-20T04:55:53" xmlns:ns2="http://www.uidai.gov.in/authentication/uid-auth-request-data/1.0"><ns2:Demo><ns2:Pi ms="E" mv="100" name="Shivshankar Choudhury"/></ns2:Demo></ns2:Pid>';*/
//
//// generate aes-256 session key
//        $session_key = openssl_random_pseudo_bytes(32);
//
//// generate auth xml
/*        $auth_xml = '<?xml version="1.0"?><Auth ac="'.$ac.'" lk="'.$lk.'" sa="'.$sa.'" tid="'.$sa.'" txn="'.$txn.'" uid="'.$aadhaar_no.'" ver="'.$api_version.'" xmlns="http://www.uidai.gov.in/authentication/uid-auth-request/1.0" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><Uses bio="n" otp="n" pa="n" pfa="n" pi="y" pin="n"/><Meta fdc="NA" idc="NA" lot="P" lov="560094" pip="NA" udc="1122"/><Skey ci="'.$this->public_key_validity().'">'.$this->encrypt_session_key($session_key).'</Skey><Data type="X">'.$this->encrypt_pid($pid_block, $session_key).'</Data><Hmac>'.$this->calculate_hmac($pid_block, $session_key).'</Hmac></Auth>';*/
//
////    echo $auth_xml;
////    die();
//
//// xmldsig the auth xml
//        $doc = new \DOMDocument();
//        $doc->loadXML($auth_xml);
//        $objDSig = new XMLSecurityDSig();
//        $objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);
//        $objDSig->addReference(
//            $doc,
//            XMLSecurityDSig::SHA256,
//            array(
//                'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
//                'http://www.w3.org/2001/10/xml-exc-c14n#'
//            ),
//            array('force_uri' => true)
//        );
//        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array('type'=>'private'));
//        openssl_pkcs12_read(file_get_contents($p12_file), $key, "public");
//        $objKey->loadKey($key["pkey"]);
//        $objDSig->add509Cert($key["cert"]);
//        $objDSig->sign($objKey, $doc->documentElement);
//        $xml_string=urlencode($doc->saveXML());
//
//// make a request to uidai
//        try{
//            $ch =curl_init("http://auth.uidai.gov.in/$api_version/public/".$aadhaar_no[0]."/".$aadhaar_no[1]."/$asa_licence_key");
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                "Accept: application/xml",
//                "Content-Type: application/xml"
//            ));
//
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch, CURLOPT_POSTFIELDS,"eXml=A28".$xml_string);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//
//            $res= curl_exec($ch);
//
//            if(curl_error($ch))
//            {
//                return 'error:' . curl_error($ch);
//            }
//            else{
//                return $res;
//            }
//        }
//        catch (\Exception $exception){
//            return $exception->getMessage();
//        }
//
//    }
//    function encrypt_pid($pid_block, $session_key)
//    {
//        return $this->encrypt_using_session_key($pid_block, $session_key);
//    }
//
//    function encrypt_using_session_key($data, $session_key)
//    {
////    $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
//        $method = 'AES-256-CBC';
//        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
//        $blockSize = strlen(openssl_encrypt('', $method, '', OPENSSL_RAW_DATA, $iv));
//        $pad = $blockSize - (strlen($data) % $blockSize);
////    return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $session_key, $data . str_repeat(chr($pad), $pad), MCRYPT_MODE_ECB));
//        return base64_encode(strlen(openssl_encrypt($data . str_repeat(chr($pad), $pad), $method, $session_key, OPENSSL_RAW_DATA, $iv)));
//    }
//
//    function calculate_hmac($data, $session_key)
//    {
//        return $this->encrypt_using_session_key(hash('sha256', $data, true), $session_key);
//    }
//
//    function public_key_validity()
//    {
//        global $public_cert_path;
//        $certinfo = openssl_x509_parse(file_get_contents($public_cert_path));
//        return date('Ymd', $certinfo['validTo_time_t']);
//    }
//
//    function encrypt_session_key($session_key)
//    {
//        global $public_cert_path;
//        $pub_key = openssl_pkey_get_public(file_get_contents($public_cert_path));
//        $keyData = openssl_pkey_get_details($pub_key);
//        openssl_public_encrypt($session_key, $encrypted_session_key, $keyData['key'], OPENSSL_PKCS1_PADDING);
//        return base64_encode($encrypted_session_key);
//    }

}
