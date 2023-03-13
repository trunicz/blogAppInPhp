<?php
  
namespace Trnx\Blog\model;

class Url{
  
  public static function getRootPath(){
    return substr(__DIR__, 0, strpos(__DIR__,'/model'));
  }
}
