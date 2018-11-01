<?php
/**
 * Questa classe si occupa di gestire i file csv di questo progetto in modo semplificato e veloce.
 */
class CSVisualizer
{
    /**
     * Questo metodo si occupa della lettura del file csv specificato, esso lo trasforma in un array
     * multi-dimensionale associativo.
     * @param string $csv_file Path del file csv da leggere.
     * @param string $csv_delimiter Separatore delle colonne del file csv, di default è il carattere ';'.
     * @return boolean|array Ritorna false quando c'è un errore di lettura (manca header, file non esiste, eccetera)
     * e ritorna un array multi-dimensionale associativo il quale contiene tutti i dati di tutte le righe del file
     * se non incombe in nessun errore.
     */
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

    /**
     * Questo metodo si occupa di formattare un array di dati in una stringa pronta per essere aggiunta al file csv.
     * @param array $data Array di dati da formattare in una stringa adatta per un file csv.
     * @param string $csv_delimiter Separatore delle colonne del file csv, di default è il carattere ';'.
     * @return string Stringa formattata pronta per essere utilizzata in un file csv.
    */
    public function csv_build_string(array $data,$delimiter=";"){
        $text = "";
        for($i = 0; $i < count($data);$i++){
            $data[$i] = strtolower($data[$i]);
            if($i == 0) $text .= urldecode($data[$i]);
            else $text .= $delimiter.urldecode($data[$i]);
        }

        $text .= "\n";
        return $text;
    }

    /**
     * Questa funzione si occupa di prendere il nome del file csv della giornata corrente.
     * @return string Nome del file csv della giornata corrente.
     */
    public function get_current_day_filename(){
        return "Registrazioni_". date('Y-m-d') . ".csv";
    }

    /**
     * Questo metodo si occupa di aggiungere un record al file csv specificato.
     * @param string $csv_file Path del file csv nel quale verrà inserita la stringa.
     * @param array $data Array contenente i dati da inserire nel file csv.
     * @param string $csv_delimiter Separatore delle colonne del file csv, di default è il carattere ';'.
     */
    public function add_new_line($csv_file,array $data,$csv_delimiter=';'){
        file_put_contents($csv_file,$this->csv_build_string($data),FILE_APPEND);
        return true;
    }
}
