<?php
// php-html-parser
// DOM構造をチェックし、styleタグとscriptタグの削除を行う.
require_once(__DIR__ . '/../constants.php');
require_once(VENDOR_PATH);

use PHPHtmlParser\Dom;
use PHPHtmlParser\Options;

$options = new Options();
$options->setEnforceEncoding('utf8');

function sanitize_html($textElements){
  $dom = new Dom;
  try{
    $dom->setOptions((new Options())->setStrict(true));
    $dom->loadStr($textElements);
    $elements = $dom->find("");
    foreach($elements as $element) {
        if(empty($element->getAttribute("style")) == False) {
            $element->setAttribute("style", "");
        }
    }
    return $dom->outerHtml;
  }catch(Exception $e){
    return false;
  }
}

