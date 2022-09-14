<?php

declare(strict_types=1);

$categories = [
    'fruits' => [
        'type' => 'category',
        'items' => [
            'apple' => [
                'count' => 5,
                'price' => 0.15,
            ],
            'pear' => [
                'count' => 5,
                'price' => 0.15,
            ],
        ],
    ],
    'vegetables' => [
        'type' => 'category',
        'items' => [
            'carrot' => [
                'count' => 100,
                'price' => 0.01,
            ],
            'tomato' => [
                'count' => 45,
                'price' => 0.5,
            ],
        ],
    ],
    'seafood' => [
        'type' => 'category',
        'items' => [
            'seabass' => [
                'count' => 15,
                'price' => 5.5,
            ],
        ],
    ],
    'alcohol' => [
        'type' => 'category',
        'items' => [
            'beer_bottle' => [
                'count' => 22,
                'price' => 1.3,
            ],
            'wine_bottle' => [
                'count' => 4,
                'price' => 8,
            ],
        ],
    ],
    'milk' => [
        'type' => 'category',
        'items' => [
            'cheese' => [
                'count' => 1,
                'price' => 4.5,
            ],
            'yoghurt' => [
                'count' => 13,
                'price' => 0.99,
            ],
        ],
    ],
    'bread' => [
        'type' => 'category',
        'items' => [
            'brown_bread' => [
                'count' => 11,
                'price' => 2.1,
            ],
            'white_bread' => [
                'count' => 110,
                'price' => 1.3,
            ],
        ],
    ],
];

interface DataEncoderInterface
{
    public function encodeData(array $content): string;

}

interface DataOutputHandlerInterface
{
    public function processData(string $input): void;
}

class JsonEncoder implements DataEncoderInterface
{

    public function encodeData(array $content): string
    {

        return json_encode($content, JSON_PRETTY_PRINT);
    }
}

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
        $xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");
        array_to_xml($content,$xml_user_info);
        return $xml_user_info->asXML();
    }
}
//xml example
//<root><fruits><type>category</type><items><apple><count>5</count><price>0.15</price></apple><pear><count>5</count><price>0.15</price></pear></items></fruits><vegetables><type>category</type><items><carrot><count>100</count><price>0.01</price></carrot><tomato><count>45</count><price>0.5</price></tomato></items></vegetables><seafood><type>category</type><items><seabass><count>15</count><price>5.5</price></seabass></items></seafood><alcohol><type>category</type><items><beer_bottle><count>22</count><price>1.3</price></beer_bottle><wine_bottle><count>4</count><price>8</price></wine_bottle></items></alcohol><milk><type>category</type><items><cheese><count>1</count><price>4.5</price></cheese><yoghurt><count>13</count><price>0.99</price></yoghurt></items></milk><bread><type>category</type><items><brown_bread><count>11</count><price>2.1</price></brown_bread><white_bread><count>110</count><price>1.3</price></white_bread></items></bread></root>

class TerminalOutputHander implements DataOutputHandlerInterface
{
    public function processData(string $input): void {
        var_dump($input);
    }
}

class FileOutputHandler implements DataOutputHandlerInterface
{
    public function processData(string $input): void {
        file_put_contents('./output.json', $input);
        echo 'Data to file was written';
    }

//file_put_contents('./data.xml', $xml->asXML());
}
class DataProcessor
{
    public function __construct(private array $data)
    {
    }
    public string $out = '';

    public function process (string $format, string $output): void {
        $a = new JsonEncoder();
        $b = new TerminalOutputHander();
        $c = new FileOutputHandler();
        $d = new XmlEncoder();

        if ($format === 'json') {
            $this->out = $a->encodeData($this->data);
        } elseif ($format === 'xml') {
            $this->out = $d->encodeData($this->data);
        } else throw new Exception('Wrong format command');

        if ($output === 'terminal') {
            $b->processData($this->out);
        } elseif ($output === 'file') {
            $c->processData($this->out);
        } else throw new Exception('Wrong output command');
    }

//    public string $out = '';
//
//    public function process(string $format, string $output): void
//    {
//
//        if ($format === 'json') {
//            $this->out = json_encode($this->data, JSON_PRETTY_PRINT);
//        }
//
//        if ($output === 'terminal') {
//            var_dump($this->out);
//        } elseif ($output === 'file') {
//            file_put_contents('./output.json', $this->out);
//            echo 'Data to file was written';
//        } else throw new Exception('Wrong output command');
//
//    }

//        if ($format === 'xml') {
//            $xml = new SimpleXMLElement('<Projects/>');
//            $this->array_to_xml($this->data, $xml);
////            var_dump($xml);
//
//        }
//        // encode data to $format (JSON or XML)
//        // output it to $output (file or terminal)
//    }
//
//    public function array_to_xml($array, &$xml):
//    {
//        foreach ($array as $key => $value) {
//            if (is_array($value)) {
//                if (!is_numeric($key)) {
//                    $subnode = $xml->addChild($key);
//                    array_to_xml($value, $subnode);
//                } else {
//                    array_to_xml($value, $subnode);
//                }
//            } else {
//                $xml->addChild($key, $value);
//            }
//        }
//    }
}

$dataProcessor = new DataProcessor($categories);
try {
    $dataProcessor->process('xml', 'file');
} catch (Exception $exception){
    echo $exception->getMessage();
}



//$dataProcessor->process('xml', 'terminal');

/*
Klasė DataProcessor suteikia mums galimybę užkoduoti duomenis tam tikru formatu (JSON arba XML) ir išvesti juos į failą
arba terminalą. Tai yra daroma kviečiant metodą 'process'.
1.1 Įgyvendinkite 'process' metodo logiką klasėje DataProcessor
1.2 Perkelkite metodo 'process' encodinimo ir išvesties logiką į atskiras klases, kurios būtų susietos interfeisais.
Galėtų būti šie interfeisai:
- DataEncoderInterface
    - JsonEncoder
    - XmlEncoder
- DataOutputHandlerInterface
    - TerminalOutputHander
    - FileOutputHandler
Daugiau apie XML formatą: https://www.w3schools.com/xml/xml_whatis.asp
*/