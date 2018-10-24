<?php

class CSVisualizer
{
    private $csv_file;
    private $csv_delimiter; 

    public function __construct($csv_path,$delimiter=','){
        $this->csv_file = $csv_path;
        $this->csv_delimiter = $delimiter;
    }

    public function csv_to_array()
    {
        $csv_file = $this->csv_file;
        $csv_delimiter = $this->csv_delimiter;
        if(!file_exists($csv_file) || !is_readable($csv_file))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($csv_file, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $csv_delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public function add_new_line(array $data){
        $csv_file = $this->csv_file;
        $csv_delimiter = $this->csv_delimiter;

        echo file_exists($csv_file);
        echo is_readable($csv_file);
        
        if(file_exists($csv_file) == false || is_readable($csv_file) == false){
            return false;
        }

        $text = "";
        for($i = 0; $i < count($data);$i++){
            if($i == 0) $text .= $data[i];
            else $text .= ",".$data[i];
        }

        file_put_contents($csv_file,$text);
        return true;
    }
}
