<?php

namespace App\Manager;

class FileManager {
    
    public function getDataFromFile($filePath, $name)
    {
        $containTab = $containtDataArray = [];
        
        if(is_null($name)) {
            throw new \Error("Le nom du service à utiliser n'est pas défini.");
        }

        // Get the contains of the file in string format
        $data = file_get_contents($filePath);

        if(in_array($name, ["medicament", "composition", "prescription", "page-link", "asmr", "smr", "info_important", "group_generique"])) {
            $containtDataArray = explode("\r\n", $data);
        } elseif(in_arrau($name, ["presentation"])) {
            $containtDataArray = explode("\n", $data);
        }
        
        // Convert the contain of each index to array
        foreach($containtDataArray as $key => $value) {
            array_push($containTab, explode("\t", utf8_encode($value)));
        }

        return $containTab;
    }
}