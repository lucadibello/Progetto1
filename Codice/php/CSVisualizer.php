<?php

class CSVisualizer
{
    public function csv_to_array($csv_file,$csv_delimiter=';')
    {
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
    public function csv_build_string(array $data){
        $text = "";
        for($i = 0; $i < count($data);$i++){
            if($i == 0) $text .= urldecode($data[$i]);
            else $text .= ";".urldecode($data[$i]);
        }

        $text .= "\n";
        return $text;
    }

    public function get_current_day_filename(){
        return "Registrazioni_". date('Y-m-d') . ".csv";
    }

    public function add_new_line($csv_file,array $data,$csv_delimiter=','){
        file_put_contents($csv_file,$this->csv_build_string($data),FILE_APPEND);
        return true;
    }
}
