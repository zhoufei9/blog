<?php
class Excel_XML
{
		//导出excel
        private $header = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

        private $footer = "</Workbook>";

        private $lines = array();

        private $sEncoding;
        
        private $bConvertTypes;
        
        private $sWorksheetTitle;

        public function __construct($sEncoding = 'UTF-8', $bConvertTypes = false, $sWorksheetTitle = 'Table1')
        {
                $this->bConvertTypes = $bConvertTypes;
        	$this->setEncoding($sEncoding);
        	$this->setWorksheetTitle($sWorksheetTitle);
        }
        
        public function setEncoding($sEncoding)
        {
        	$this->sEncoding = $sEncoding;
        }

        public function setWorksheetTitle ($title)
        {
                $title = @preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);
                $title = substr ($title, 0, 31);
                $this->sWorksheetTitle = $title;
        }

        private function addRow ($array)
        {
        	$cells = "";
                foreach ($array as $k => $v):
                        $type = 'String';
                        if ($this->bConvertTypes === true && is_numeric($v)):
                                $type = 'Number';
                        endif;
                        $v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
                        $cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n"; 
                endforeach;
                $this->lines[] = "<Row>\n" . $cells . "</Row>\n";
        }

        public function addArray ($array)
        {
                foreach ($array as $k => $v)
                        $this->addRow ($v);
        }

       //强制下载开关 $isForceDownload
        public function generateXML ($filename = 'excel-export',$isForceDownload=false)
        {
                $filename = @preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);
    	
                header("Content-Type: application/vnd.ms-excel; charset=" . $this->sEncoding);
                header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");
                if($isForceDownload){
                    header("Content-Type: application/force-download");
                    header("Content-Type: application/octet-stream");
                    header("Content-Type: application/download");
                    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Pragma: no-cache");
                }

            echo stripslashes (sprintf($this->header, $this->sEncoding));
                echo "\n<Worksheet ss:Name=\"" . $this->sWorksheetTitle . "\">\n<Table>\n";
                foreach ($this->lines as $line)
                        echo $line;

                echo "</Table>\n</Worksheet>\n";
                echo $this->footer;
        }

}

?>