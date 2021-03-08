<?php
namespace MikhailovIgor\Controllers;
use MikhailovIgor\Lib\Product;
use MikhailovIgor\Lib\ExportProduct;
use MikhailovIgor\Lib\Logger;
use Exception;

class ExportController extends \Core\Controller{

    private $productList = [];

    public function __construct()
    {
    }

    public function makeExport(String $exportFormat)
    {
        ExportProduct::initLogger();
        try {
            $this->productList = $this->getProductsFromModel();
            $exportFormat = mb_strtoupper($exportFormat);
            ExportProduct::initLogger();
            if ($exportFormat == "CSV") {
                ExportProduct::makeExportInCSV($this->productList);
            } else if ($exportFormat == "XML") {
                ExportProduct::makeExportInXML($this->productList);
            } else if ($exportFormat == "JSON") {
                ExportProduct::makeExportInJSON($this->productList);
            }
        } catch (Exception $e) {
            echo "Пользовательское исключение: ", $e->getMessage() , "\n";
            ExportProduct::$logger->createLog($e->getMessage());
        }
    }

    private function getProductsFromModel(){
        $this->loadModel("product", "Product");
        $productList = $this->product->getAll();
        $arrWithProductObj = [];
        if (is_array($productList) && !empty($productList)) {
            foreach ($productList as $product) {
                $arrWithProductObj[] = new Product($product["name"], $product["cost"], $product["count"]);
            }
        }
        return $arrWithProductObj;
    }

}