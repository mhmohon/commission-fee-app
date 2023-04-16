<?php

namespace App\Actions;

use SplFileObject;

class ParseCsvFile
{
    public function handle(string $filePath): array
    {
        $file = new SplFileObject($filePath);
        $file->setFlags(SplFileObject::READ_CSV);

        $values = [];
        foreach ($file as $row) {
            $values[] = [
                'date' => $row[0],
                'id' => $row[1],
                'type' => $row[2],
                'action' => $row[3],
                'amount' => $row[4],
                'currency' => $row[5],
            ];
        }

        return $values;
    }
}