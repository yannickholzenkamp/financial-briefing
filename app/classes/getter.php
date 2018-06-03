<?php

class Getter {
    
    protected $instance;
    protected $data;
    private $message;

    function init($instance) {
        $this->instance = $instance;
        $this->message = new Alexa_Message();  
        $this->getDataFromFile();
    }

    function build() {
        $this->getMessage()->init(utf8_encode($this->getInstance()->getUid()));
        $this->getMessage()->setTitleText(utf8_encode($this->getInstance()->getTitle()));
        $this->getMessage()->setMainText(utf8_encode($this->getMainTextInternal()));
    }

    protected function getMainText() {}

    protected function getMainTextInternal() {
        if ($this->getData() == null) {
            return '';
        }
        return $this->getMainText();
    }

    public function get() {
        return $this->message->get();
    }

    protected function getData() {
        return $this->data;
    }

    protected function getMessage() {
        return $this->message;
    }

    protected function getInstance() {
        return $this->instance;
    }

    private function getFileName() {
        $fn = $this->getInstance()->getFileName();
        return "app/data/json/$fn.json";
    }

    private function getDataFromFile() {
        $file = json_decode(file_get_contents($this->getFileName()), true);
        $this->data = $file['data'];
    }

}

?>
