<?php

class View
{
    private $_file;
    private $_titre_page;

    public function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';
    }

    public function generate($data, $title_text)
    {
        $content = $this->generateFile($this->_file, $data);
        $view = $this->generateFile('views/template.php', array('title' => $this->_titre_page, 'content' => $content, 'title_text' => $title_text));
        echo $view;
    }

    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else
            throw new Exception('Fichier '.$file.' introuvable');
    }
}