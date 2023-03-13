<?php
  
  namespace Trnx\Blog\model;
  use League\CommonMark\CommonMarkConverter;

  use Error;

  class Post{
    public function __construct(private string $file){
      $this->getFileName();
    }

    public function getContent(){ 
      $this->fixNameWithoutDash();
      if(file_exists($this->getFileName())){
        $stream = fopen($this->getFileName(), 'r');
        $content = fread($stream, filesize($this->getFileName()));
        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($content);
        echo $html;
      }else{
        throw new Error('File does not exist');
      }
    }

    public function getFileName(){
      $dir = Url::getRootPath();
      $fileName = "{$dir}/entries/{$this->file}";
      return $fileName;
    }

    public static function getPosts() : array {
      $posts = [];
      $files = scandir(Url::getRootPath() . '/entries');
      foreach ($files as $file) {
        if (strpos($file, '.md') > 0) {
          $post = new Post($file);
          array_push($posts, $post);
        }
      }
      return $posts;
    }

    public function getUrl() : string{
      $url = substr($this->file, 0, strpos($this->file, '.md'));
      $title = str_replace(' ', '-', $url);
      return "http://localhost:8888/?post=$title";
    }

    public function fixNameWithoutDash(){
      $title = str_replace('-',' ', $this->file);
      $this->file = $title;
    }

    public function getPostName() : string{
      $title = $this->file;
      $title = str_replace('-',' ', $this->file);
      $title = str_replace('.md','', $this->file);
      return $title;
    }
  }
  