<?php
namespace MikhailovIgor\Interfaces;

interface iExportFormats{
    public static function makeExportInCSV($productList);
    public static function makeExportInXML($productList);
    public static function makeExportInJSON($productList);
}