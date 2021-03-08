<?php
namespace MikhailovIgor\Lib;

use MikhailovIgor\Lib\Product;
use \Exception;
use \XMLWriter;
use MikhailovIgor\Lib\Logger;

class ExportProduct extends \MikhailovIgor\Lib\Export implements \MikhailovIgor\Interfaces\iExportFormats {
    private function __construct()
    {
        
    }

    public static function initLogger(){
        parent::$logger = Logger::getInstance();
        parent::$logger->setPathToLogFile($_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/logs/export_log.txt");
    }

    public static function makeExportInCSV($productList)
    {
        $csvStr = "Name;Cost;Count\n";
        if (is_array($productList) && !empty($productList)) {          
            foreach($productList as $product) {
                if ($product instanceof Product) {
                    $csvStr .= ($product->getName() ? $product->getName() : "NULL") . ";" . ($product->getCost() ? $product->getCost() : "NULL") . ";" . ($product->getCount() ? $product->getCount() : "NULL") . "\n";
                } else {
                    self::$logger->createLog("Получен тип данных отличный от Product, запись была пропущена");
                    continue;
                }
            }
        } else if ($product instanceof Product) {
            $csvStr .= ($product->getName() ? $product->getName() : "NULL") . ";" . ($product->getCost() ? $product->getCost() : "NULL") . ";" . ($product->getCount() ? $product->getCount() : "NULL") . "\n";
        } else {
            self::$logger->createLog("Получен тип данных отличный от Product, запись была пропущена");
        }
        $fileName = "ProductExport.csv";
        self::sendFileToDownload($fileName, $csvStr);
    }

    public static function makeExportInXML($productList)
    {
        $xmlObj = new XMLWriter();
        $xmlObj->openMemory();
        $xmlObj->setIndent(2);
        $xmlObj->startDocument();
        if (is_array($productList) && !empty($productList)) {
            foreach($productList as $product) {
                if ($product instanceof Product) {
                    $xmlObj->startElement('Product');
                    $name = $product->getName();
                    $xmlObj->writeAttribute('Name', $name ? $name : "NULL");
                    $cost = $product->getCost();
                    $xmlObj->writeAttribute('Cost', $cost ? $cost : "NULL");
                    $count = $product->getCount();
                    $xmlObj->writeAttribute('Count', $count ? $count : "NULL");
                    $xmlObj->endElement();
                } else {
                    self::$logger->createLog("Получен тип данных отличный от Product, запись была пропущена");
                    continue;
                }
            }
        } else if ($productList instanceof Product) {
            $xmlObj->startElement('Product');
            $name = $productList->getName();
            $xmlObj->writeAttribute('Name', $name ? $name : NULL);
            $cost = $productList->getCost();
            $xmlObj->writeAttribute('Cost', $cost ? $cost : NULL);
            $count = $productList->getCount();
            $xmlObj->writeAttribute('Count', $count ? $count : NULL);
            $xmlObj->endElement();
        } else {
            self::$logger->createLog("Получен тип данных отличный от Product, запись была пропущена");
        }
        $xmlObj->endDocument();
        $xmlStr = $xmlObj->flush();
        $fileName = "ProductExport.xml";
        self::sendFileToDownload($fileName, $xmlStr);
    }

    public static function makeExportInJSON($productList)
    {
        $newObj = [];
        if (is_array($productList) && !empty($productList)) {
            foreach($productList as $product) {
                if ($product instanceof Product) {
                    $name = $product->getName();
                    $cost = $product->getCost();
                    $count = $product->getCount();
                    $newObj[] = [
                        "name" => $name ? $name : "NULL",
                        "cost" => $cost ? $cost : "NULL",
                        "count" => $count ? $count : "NULL",
                    ];
                } else {
                    if(self::$logger){
                        self::$logger->createLog("Получен тип данных отличный от Product, запись была пропущена");
                    }
                    continue;
                }
            }
        } else if ($productList instanceof Product) {
            $newObj[] = [
                "name" => $productList->getName(),
                "cost" => $productList->getCost(),
                "count" => $productList->getCount(),
            ];
        } else {
            if(self::$logger){
                self::$logger->createLog("Получен тип данных отличный от Product, запись была пропущена");
            }
        }
        $jsonStr = json_encode($newObj);
        $fileName = "ProductExport.json";
        self::sendFileToDownload($fileName, $jsonStr);
    }
}