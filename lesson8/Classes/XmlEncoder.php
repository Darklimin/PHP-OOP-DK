<?php

declare(strict_types=1);

namespace MyProject\Classes;

use MyProject\Interfaces\DataEncoderInterface;
use SimpleXMLElement;

class XmlEncoder implements DataEncoderInterface
{
    public function encodeData(array $content): string
    {
        function array_to_xml($array, &$xml_user_info) {
            foreach($array as $key => $value) {
                if(is_array($value)) {
                    if(!is_numeric($key)){
                        $subnode = $xml_user_info->addChild("$key");
                        array_to_xml($value, $subnode);
                    }else{
                        $subnode = $xml_user_info->addChild("item$key");
                        array_to_xml($value, $subnode);
                    }
                }else {
                    $xml_user_info->addChild("$key",htmlspecialchars("$value"));
                }
            }
        }
        $xml_user_info = new SimpleXMLElement("<root></root>");
        array_to_xml($content,$xml_user_info);
        return $xml_user_info->asXML();
    }
}
